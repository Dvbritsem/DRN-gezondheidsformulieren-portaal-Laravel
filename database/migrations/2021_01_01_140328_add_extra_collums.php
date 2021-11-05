<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraCollums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gez_forms', function (Blueprint $table) {
            $table->string('magzwemmen');
            $table->string('zwemdiplomas');
            $table->string('heimwee');
            $table->string('opmerkingen')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gez_forms', function (Blueprint $table) {
            $table->dropColumn('magzwemmen');
            $table->dropColumn('zwemdiplomas');
            $table->dropColumn('heimwee');
            $table->dropColumn('opmerkingen');
        });
    }
}
