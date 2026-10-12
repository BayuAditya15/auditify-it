<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('organization_name');
            $table->string('period_label', 50);           // contoh: Ganjil 2026/2027
            $table->date('period_start')->nullable();
            $table->date('period_end')->nullable();
            $table->foreignId('auditor_id')
                ->constrained('users')
                ->restrictOnDelete();
            $table->foreignId('previous_project_id')
                ->nullable()
                ->constrained('audit_projects')
                ->nullOnDelete();
            // draft (Fase 1) | assessment (Fase 2) | analysis (Fase 3) | archived
            $table->string('status', 20)->default('draft')->index();
            $table->timestamp('scope_locked_at')->nullable();
            $table->timestamp('assessment_locked_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['organization_name', 'period_label']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_projects');
    }
};
