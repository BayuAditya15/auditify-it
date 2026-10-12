<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cobit_objectives', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();        // EDM01, APO01, BAI01, DSS01, MEA01
            $table->string('domain', 3)->index();        // EDM | APO | BAI | DSS | MEA
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('purpose')->nullable();
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cobit_objectives');
    }
};
