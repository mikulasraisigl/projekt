<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Spuštění migrace - vytvoření tabulky `events`.
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // Primární klíč
            $table->string('title'); // Název události
            $table->dateTime('start'); // Datum a čas začátku
            $table->string('repeat')->nullable(); // Opakování (volitelné)
            $table->boolean('completed')->default(false); // Status dokončení (výchozí je false)
            $table->unsignedBigInteger('user_id'); // ID uživatele, který vlastní událost
            $table->timestamps(); // Přidání sloupců created_at a updated_at

            // Nastavení cizího klíče pro uživatele
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Vrácení migrace.
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
