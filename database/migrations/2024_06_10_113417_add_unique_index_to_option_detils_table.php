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
        Schema::table('option_detils', function (Blueprint $table) {
            $table->unique(['POptID', 'OptID', 'ItemID', 'AdditionalValue']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('option_detils', function (Blueprint $table) {
            $table->dropUnique(['POptID', 'OptID', 'ItemID', 'AdditionalValue']);
        });
    }
};
