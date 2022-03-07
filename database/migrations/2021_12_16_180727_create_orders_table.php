<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unique();
            $table -> string('fnam');
            $table -> string('lnam');
            $table -> string('email');
            $table -> string('address');
            $table -> integer('zip');
            $table -> string('nameoncard');
            $table -> string('cardnumber');
            $table -> string('exp');
            $table -> integer('cvv');
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
        Schema::dropIfExists('orders');
    }
}
