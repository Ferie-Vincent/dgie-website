<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->boolean('is_featured')->default(false)->after('read_time');
            $table->integer('featured_position')->nullable()->after('is_featured');
            $table->foreignId('dossier_id')->nullable()->after('category_id')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['dossier_id']);
            $table->dropColumn(['is_featured', 'featured_position', 'dossier_id']);
        });
    }
};
