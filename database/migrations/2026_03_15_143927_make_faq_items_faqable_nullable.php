<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faq_items', function (Blueprint $table) {
            $table->string('faqable_type')->nullable()->change();
            $table->unsignedBigInteger('faqable_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('faq_items', function (Blueprint $table) {
            $table->string('faqable_type')->nullable(false)->change();
            $table->unsignedBigInteger('faqable_id')->nullable(false)->change();
        });
    }
};
