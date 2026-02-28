<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('meta_title')->nullable()->after('meta_description');
            $table->string('og_image')->nullable()->after('meta_title');
            $table->string('hero_title')->nullable()->after('og_image');
            $table->string('hero_subtitle')->nullable()->after('hero_title');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['meta_title', 'og_image', 'hero_title', 'hero_subtitle']);
        });
    }
};
