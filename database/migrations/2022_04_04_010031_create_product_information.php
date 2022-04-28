<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_information', function (Blueprint $table) {
            $table->id();
            $table->user_id()->nullable();
            $table->string('name')->nullable();
            $table->integer('kg')->nullable(); //Вес
            $table->integer('H')->nullable(); //Длина
            $table->integer('L')->nullable(); //Высота
            $table->integer('S')->nullable(); //Глубина
            $table->integer('V')->nullable();
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
        Schema::dropIfExists('product_information');
    }
}
