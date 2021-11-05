<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGezMedischeGegevensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gez_medische_gegevens', function (Blueprint $table) {
            $table->id();
            $table->string('allergieën');
            $table->string('medicijnen_gebruik');
            $table->string('medicijnen_niet');
            $table->string('dieet');
            $table->string('vaccinatie');
            $table->string('syndroom');
            $table->foreignId('gez_form_id')->contrained('gez_forms')->delete('cascade');
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
        Schema::dropIfExists('gez_medische_gegevens');
    }
}
