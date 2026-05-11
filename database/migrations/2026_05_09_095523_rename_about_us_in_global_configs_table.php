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
            $table->renameColumn('about_us', 'short_about_us');
            $table->text('long_about_us')->nullable()->after('reader');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('global_configs', function (Blueprint $table) {
            $table->renameColumn('short_about_us', 'about_us');
            $table->dropColumn('long_about_us');
        });
    }
};
