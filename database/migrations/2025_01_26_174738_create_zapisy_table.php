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
        Schema::create('zapisy', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID uživatele
            $table->date('den'); // Den zápisu
            $table->text('obsah'); // Obsah zápisu
            $table->timestamps(); // Čas vytvoření a úpravy
        });
    }

    public function down()
    {
        Schema::dropIfExists('zapisy');
    }

};
