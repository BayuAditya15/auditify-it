<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_project_id')->constrained('audit_projects')->cascadeOnDelete();
            $table->foreignId('cobit_activity_id')->constrained('cobit_activities')->restrictOnDelete();

            $table->char('rating', 1)->nullable();                   // N | P | L | F (null = belum dinilai)
            $table->text('finding_note')->nullable();                // catatan temuan auditor

            $table->text('ai_recommendation')->nullable();           // draf dari model
            $table->string('ai_model', 50)->nullable();              // contoh: gpt-4o-mini
            $table->timestamp('ai_generated_at')->nullable();
            $table->text('final_recommendation')->nullable();        // hasil review/edit auditor
            $table->string('recommendation_status', 15)->default('none'); // none | draft | approved

            $table->foreignId('assessed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('assessed_at')->nullable();
            $table->timestamps();

            $table->unique(['audit_project_id', 'cobit_activity_id']);
            $table->index(['audit_project_id', 'rating']);
            $table->index(['audit_project_id', 'recommendation_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_assessments');
    }
};
