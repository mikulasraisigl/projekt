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
        Schema::create('statistika', function (Blueprint $table) {
            $table->id();                            // Primární klíč
            $table->unsignedBigInteger('user_id');   // ID uživatele
            $table->string('typ_cviceni');           // Typ cvičení (běh, dřepy apod.)
            $table->float('vaha')->nullable();       // Váha, pokud je relevantní
            $table->integer('opakovani')->nullable(); // Počet opakování
            $table->time('cas')->nullable();         // Čas běhu/aktivity, pokud je relevantní
            $table->date('datum');                   // Datum cvičení
            $table->timestamps();                    // Časové informace vytvoření/změny

            // Index pro uživatele, propojení s tabulkou `users`
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistika');
    }

};
