<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->index('status');
            $table->index('published_at');
            $table->index('section');
        });

        Schema::table('evenements', function (Blueprint $table) {
            $table->index('status');
            $table->index('event_date');
            $table->index('section');
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->index('status');
            $table->index('email');
        });

        Schema::table('flash_infos', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('newsletter_subscribers', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('position');
        });

        Schema::table('galerie_albums', function (Blueprint $table) {
            $table->index('status');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['published_at']);
            $table->dropIndex(['section']);
        });

        Schema::table('evenements', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['event_date']);
            $table->dropIndex(['section']);
        });

        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['email']);
        });

        Schema::table('flash_infos', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('newsletter_subscribers', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('partners', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['position']);
        });

        Schema::table('galerie_albums', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['type']);
        });
    }
};
