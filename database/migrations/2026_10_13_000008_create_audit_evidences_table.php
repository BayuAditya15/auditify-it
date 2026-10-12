<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_evidences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_project_id')->constrained('audit_projects')->cascadeOnDelete();
            $table->foreignId('audit_assessment_id')->constrained('audit_assessments')->cascadeOnDelete();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();

            $table->string('original_name');                          // nama asli, hanya untuk tampilan
            $table->string('stored_path');                            // evidences/{project_id}/{uuid}.pdf
            $table->string('disk', 20)->default('local');             // disk privat
            $table->string('mime_type', 100)->default('application/pdf');
            $table->unsignedInteger('size_bytes');
            $table->char('sha256', 64);                               // deduplikasi dalam satu proyek
            $table->string('page_reference', 50)->nullable();         // contoh: hal. 12-14
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['audit_project_id', 'sha256']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_evidences');
    }
};
