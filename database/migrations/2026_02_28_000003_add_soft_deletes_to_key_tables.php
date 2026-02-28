<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('evenements', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('dossiers', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('galerie_albums', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('magazines', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('evenements', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('dossiers', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('galerie_albums', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('magazines', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
