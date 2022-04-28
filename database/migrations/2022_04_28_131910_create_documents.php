<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('to_courier_from')->nullable();
            $table->string('to_warehous_from')->nullable();
            $table->string('to_warehous_to')->nullable();
            $table->string('to_drive')->nullable();
            $table->string('to_courier_to')->nullable();
            $table->string('to_customs')->nullable();
            $table->string('to_received')->nullable();
            $table->string('score')->nullable();
            $table->string('payment')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
