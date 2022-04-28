<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('country_id_from')->nullable();
            $table->integer('city_id_from')->nullable();
            $table->integer('country_id_to')->nullable();
            $table->integer('city_id_to')->nullable();
            $table->integer('address_id_from')->nullable();
            $table->integer('address_id_to')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('is_active')->nullable();
            $table->boolean('is_custom')->nullable();
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
