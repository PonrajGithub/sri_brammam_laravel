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
        Schema::table('global_configs', function (Blueprint $table) {
            $table->string('youtube_url')->nullable()->after('login_url');
            $table->string('facebook_url')->nullable()->after('youtube_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('global_configs', function (Blueprint $table) {
            $table->dropColumn(['youtube_url', 'facebook_url']);
        });
    }
};
