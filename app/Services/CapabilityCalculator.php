<?php

namespace App\Services;

use App\Models\AuditProject;
use App\Models\CapabilityResult;
use Illuminate\Support\Facades\DB;

class CapabilityCalculator
{
    public function calculate(AuditProject $project): void
    {
        $targets = $project->scopeDiagnostics()
            ->where('is_selected', true)
            ->pluck('target_level', 'cobit_objective_id');

        $rows = DB::table('audit_assessments as s')
            ->join('cobit_activities as a', 'a.id', '=', 's.cobit_activity_id')
            ->where('s.audit_project_id', $project->id)
            ->whereIn('a.cobit_objective_id', $targets->keys())
            ->get(['a.cobit_objective_id as objective_id', 'a.capability_level as level', 's.rating']);

        DB::transaction(function () use ($project, $targets, $rows) {
            foreach ($rows->groupBy('objective_id') as $objectiveId => $items) {
                $achievements = [];

                foreach ($items->groupBy('level') as $level => $levelItems) {
                    $pct = $levelItems->avg(
                        fn ($r) => $r->rating ? config("audit.rating_scores.{$r->rating}", 0) : 0
                    );
                    $achievements[(int) $level] = [
                        'pct' => round((float) $pct, 1),
                        'rating' => $this->ratingFor((float) $pct),
                    ];
                }

                $current = $this->levelFrom($achievements);
                $target = (int) $targets[$objectiveId];

                CapabilityResult::updateOrCreate(
                    ['audit_project_id' => $project->id, 'cobit_objective_id' => $objectiveId],
                    [
                        'current_level' => $current,
                        'target_level' => $target,
                        'gap' => $target - $current,
                        'level_achievements' => $achievements,
                        'activities_total' => $items->count(),
                        'activities_assessed' => $items->whereNotNull('rating')->count(),
                        'is_stale' => false,
                        'calculated_at' => now(),
                    ]
                );
            }
        });
    }

    private function ratingFor(float $pct): string
    {
        foreach (config('audit.rating_bounds') as $rating => $upper) {
            if ($pct <= $upper) {
                return $rating;
            }
        }

        return 'F';
    }

    /** Level k tercapai jika rating k adalah L/F dan semua level di bawahnya F. */
    private function levelFrom(array $achievements): int
    {
        $current = 0;

        foreach (range(1, 5) as $k) {
            if (! isset($achievements[$k])) {
                continue; // level tanpa aktivitas dilewati
            }
            if (! in_array($achievements[$k]['rating'], ['L', 'F'], true)) {
                break;
            }
            $current = $k;
            if ($achievements[$k]['rating'] !== 'F') {
                break; // level di atasnya butuh level ini F
            }
        }

        return $current;
    }
}
