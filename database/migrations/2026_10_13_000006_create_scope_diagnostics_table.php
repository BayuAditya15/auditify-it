<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scope_diagnostics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_project_id')->constrained('audit_projects')->cascadeOnDelete();
            $table->foreignId('cobit_objective_id')->constrained('cobit_objectives')->restrictOnDelete();

            $table->unsignedTinyInteger('importance')->nullable();   // 1-5
            $table->unsignedTinyInteger('performance')->nullable();  // 1-5
            $table->unsignedTinyInteger('risk_score')->nullable();   // 1-25, dihitung server
            $table->string('risk_level', 10)->nullable();            // low | medium | high

            $table->boolean('is_selected')->default(false);          // masuk scope audit
            $table->boolean('is_override')->default(false);          // diubah manual oleh auditor
            $table->text('override_reason')->nullable();
            $table->string('selection_reason')->nullable();          // contoh: Risk 20 >= 15
            $table->unsignedTinyInteger('target_level')->default(3); // 1-5
            $table->timestamps();

            $table->unique(['audit_project_id', 'cobit_objective_id']);
            $table->index(['audit_project_id', 'is_selected']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scope_diagnostics');
    }
};
