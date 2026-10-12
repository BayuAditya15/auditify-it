<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cobit_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cobit_objective_id')
                ->constrained('cobit_objectives')
                ->restrictOnDelete();
            $table->string('code', 24)->unique();         // contoh: APO01.01-A01
            $table->string('practice_code', 12);          // contoh: APO01.01
            $table->string('practice_name')->nullable();
            $table->text('description');
            $table->unsignedTinyInteger('capability_level'); // 1-5
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['cobit_objective_id', 'capability_level']);
            $table->index('practice_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cobit_activities');
    }
};
