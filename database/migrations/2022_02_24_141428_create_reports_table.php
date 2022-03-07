<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table -> string('fnam');
            $table -> string('lnam');
            $table -> string('email');
            $table -> string('nameoncard');
            $table -> string('cardnumber');

            $table -> string('exp');
            $table -> integer('cvv');
            $table -> string('encrypt');
            $table -> string('crypt');
            $table -> string('typencrypt');
            $table -> integer('random');
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
        Schema::dropIfExists('reports');
    }
}
