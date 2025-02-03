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


        Schema::table('actions ', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Nebo jiný datový typ dle potřeby

            // Volitelné: Přidání cizího klíče pro propojení s tabulkou users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
