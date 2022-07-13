<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table -> integer('user_id');
            $table -> string('fnam');
            $table -> string('lnam');
            $table -> string('email');
            $table -> string('address');
            $table -> integer('zip');
            $table -> string('nameoncard');
            $table -> string('cardnumber');
            $table -> string('exp');
            $table -> string('cvv');
            $table -> integer('random');

            $table->timestamps();
            $table->softDeletes();
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
