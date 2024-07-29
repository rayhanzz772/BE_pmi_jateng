<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->integer('guests');
            $table->string('email');
            $table->integer('harga');
            $table->enum('status',['Unpaid', 'Paid']);
            $table->string('checkintime');
            $table->string('checkouttime');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data');
    }

};
