<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->timestamp('user_id')->nullable(); // Přidání sloupce "datum"
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('datum'); // Odstranění sloupce při rollbacku
        });
    }

};
