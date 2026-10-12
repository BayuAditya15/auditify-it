<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('capability_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_project_id')->constrained('audit_projects')->cascadeOnDelete();
            $table->foreignId('cobit_objective_id')->constrained('cobit_objectives')->restrictOnDelete();

            $table->unsignedTinyInteger('current_level')->default(0);   // 0-5
            $table->unsignedTinyInteger('target_level');                // salinan dari scope_diagnostics
            $table->tinyInteger('gap');                                 // target - current (boleh negatif)
            $table->json('level_achievements');                         // {"1":{"pct":78.5,"rating":"L"}, ...}
            $table->unsignedSmallInteger('activities_total');
            $table->unsignedSmallInteger('activities_assessed');
            $table->boolean('is_stale')->default(false);                // true jika rating berubah setelah dihitung
            $table->timestamp('calculated_at')->nullable();
            $table->timestamps();

            $table->unique(['audit_project_id', 'cobit_objective_id']);
            $table->index(['audit_project_id', 'gap']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('capability_results');
    }
};
