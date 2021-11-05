<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGezFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gez_forms', function (Blueprint $table) {
            $table->id();
            $table->string('voornaam');
            $table->string('achternaam');
            $table->string('speltak');
            $table->date('geboortedatum');
            $table->string('tandarts_naam');
            $table->string('tandarts_nummer');
            $table->string('ziektekostenverzekering_maatschappij');
            $table->string('ziektekostenverzekering_polisnummer');
            $table->foreignId('user_id')->contrained('users')->delete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gez_forms');
    }
}
