<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title'); // e.g. "Directeur Général"
            $table->string('role')->nullable(); // ministre, dg, directeur
            $table->string('photo')->nullable();
            $table->text('quote')->nullable(); // citation/message
            $table->text('bio')->nullable();
            $table->enum('type', ['ministre', 'dg', 'directeur', 'autre'])->default('autre');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
