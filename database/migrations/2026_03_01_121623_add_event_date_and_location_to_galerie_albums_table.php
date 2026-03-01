<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('galerie_albums', function (Blueprint $table) {
            $table->date('event_date')->nullable()->after('description');
            $table->string('location', 255)->nullable()->after('event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galerie_albums', function (Blueprint $table) {
            $table->dropColumn(['event_date', 'location']);
        });
    }
};
