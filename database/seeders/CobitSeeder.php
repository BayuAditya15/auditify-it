<?php

namespace Database\Seeders;

use App\Models\CobitActivity;
use App\Models\CobitObjective;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CobitSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedObjectives();
        $this->seedActivities();
    }

    private function seedObjectives(): void
    {
        $csvPath = database_path('seeders/data/cobit_objectives.csv');
        if (! file_exists($csvPath)) {
            $this->command->error("File cobit_objectives.csv tidak ditemukan di {$csvPath}");
            return;
        }

        $handle = fopen($csvPath, 'r');
        $header = fgetcsv($handle);

        $objectives = [];
        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);
            $objectives[] = [
                'code' => $data['code'],
                'domain' => $data['domain'],
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'purpose' => $data['purpose'] ?? null,
                'sort_order' => (int) ($data['sort_order'] ?? 0),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        fclose($handle);

        if (count($objectives) !== 40) {
            throw new \RuntimeException('Jumlah objective harus tepat 40. Ditemukan: '.count($objectives));
        }

        CobitObjective::upsert(
            $objectives,
            ['code'],
            ['domain', 'name', 'description', 'purpose', 'sort_order', 'updated_at']
        );

        $this->command->info('Berhasil melakukan seed 40 COBIT 2019 Objectives.');
    }

    private function seedActivities(): void
    {
        $activitiesCsv = database_path('seeders/data/cobit_activities.csv');

        if (file_exists($activitiesCsv)) {
            $handle = fopen($activitiesCsv, 'r');
            $header = fgetcsv($handle);
            $activities = [];

            $objectivesMap = CobitObjective::pluck('id', 'code')->toArray();

            while (($row = fgetcsv($handle)) !== false) {
                $data = array_combine($header, $row);
                $objectiveCode = explode('.', $data['practice_code'])[0] ?? '';

                if (isset($objectivesMap[$objectiveCode])) {
                    $activities[] = [
                        'cobit_objective_id' => $objectivesMap[$objectiveCode],
                        'code' => $data['code'],
                        'practice_code' => $data['practice_code'],
                        'practice_name' => $data['practice_name'] ?? null,
                        'description' => $data['description'],
                        'capability_level' => (int) $data['capability_level'],
                        'sort_order' => (int) ($data['sort_order'] ?? 0),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                if (count($activities) >= 500) {
                    CobitActivity::upsert(
                        $activities,
                        ['code'],
                        ['cobit_objective_id', 'practice_code', 'practice_name', 'description', 'capability_level', 'sort_order', 'updated_at']
                    );
                    $activities = [];
                }
            }
            fclose($handle);

            if (! empty($activities)) {
                CobitActivity::upsert(
                    $activities,
                    ['code'],
                    ['cobit_objective_id', 'practice_code', 'practice_name', 'description', 'capability_level', 'sort_order', 'updated_at']
                );
            }

            $this->command->info('Berhasil melakukan seed Cobit Activities dari CSV.');
            return;
        }

        // Jika CSV belum disediakan, generate aktivitas standar per objective untuk pengujian
        $objectives = CobitObjective::all();
        $sampleActivities = [];

        foreach ($objectives as $objective) {
            // Generate 3 practice per objective dengan masing-masing level 1 sampai 4
            for ($p = 1; $p <= 3; $p++) {
                $practiceCode = sprintf('%s.%02d', $objective->code, $p);
                $practiceName = "Manage and coordinate {$objective->name} (Part {$p})";

                for ($lvl = 1; $lvl <= 4; $lvl++) {
                    $code = sprintf('%s-A%02d', $practiceCode, $lvl);
                    $sampleActivities[] = [
                        'cobit_objective_id' => $objective->id,
                        'code' => $code,
                        'practice_code' => $practiceCode,
                        'practice_name' => $practiceName,
                        'description' => "Establish and execute activities for {$objective->name} at capability level {$lvl}.",
                        'capability_level' => $lvl,
                        'sort_order' => ($p * 10) + $lvl,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        foreach (array_chunk($sampleActivities, 200) as $chunk) {
            CobitActivity::upsert(
                $chunk,
                ['code'],
                ['cobit_objective_id', 'practice_code', 'practice_name', 'description', 'capability_level', 'sort_order', 'updated_at']
            );
        }

        $this->command->info('Berhasil men-generate sample Cobit Activities (Level 1-4) untuk seluruh objective.');
    }
}
