<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug')->nullable();
            $table->foreignId('dossier_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('context')->nullable(); // e.g. "Retournée depuis la Tunisie en 2021"
            $table->string('route')->nullable(); // parcours migratoire
            $table->string('return_year')->nullable();
            $table->text('quote');
            $table->string('avatar')->nullable();
            $table->json('tags')->nullable(); // e.g. ["Retour volontaire", "DAOSAR"]
            $table->enum('type', ['general', 'retour', 'success_story'])->default('general');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
