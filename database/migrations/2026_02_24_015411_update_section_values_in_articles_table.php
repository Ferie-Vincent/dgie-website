<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First convert existing 'diaspora' values to 'investir'
        DB::table('articles')->where('section', 'diaspora')->update(['section' => 'general']);

        // Change enum for articles
        DB::statement("ALTER TABLE articles MODIFY COLUMN section ENUM('general','retour','investir','action-sociale') DEFAULT 'general'");

        // Change enum for evenements (keep 'diaspora' for backwards compat)
        DB::statement("ALTER TABLE evenements MODIFY COLUMN section ENUM('general','diaspora','retour','investir','action-sociale') DEFAULT 'general'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE articles MODIFY COLUMN section ENUM('general','diaspora') DEFAULT 'general'");
        DB::statement("ALTER TABLE evenements MODIFY COLUMN section ENUM('general','diaspora') DEFAULT 'general'");
    }
};
