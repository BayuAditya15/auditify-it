<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed pengguna default untuk ketiga peran
        User::firstOrCreate(
            ['email' => 'auditor@auditify.test'],
            [
                'name' => 'Auditor Utama',
                'password' => bcrypt('password'),
                'role' => \App\Enums\Role::Auditor,
                'organization' => 'Kantor Audit IT',
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'auditee@auditify.test'],
            [
                'name' => 'Pimpinan IT (Auditee)',
                'password' => bcrypt('password'),
                'role' => \App\Enums\Role::Auditee,
                'organization' => 'PT Enterprise Sistem',
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'reviewer@auditify.test'],
            [
                'name' => 'Dosen Penguji (Reviewer)',
                'password' => bcrypt('password'),
                'role' => \App\Enums\Role::Reviewer,
                'organization' => 'Universitas',
                'is_active' => true,
            ]
        );

        // 2. Seed Master COBIT 2019
        $this->call(CobitSeeder::class);
    }
}
