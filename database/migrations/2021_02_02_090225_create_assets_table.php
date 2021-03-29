<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('purchased_date');
            $table->string('condition');
            $table->string('serial_number');
            $table->string('product_number');
            $table->string('location');
            $table->string('activity');
            $table->unsignedBigInteger('receiving_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->boolean('status')->default(0);
            $table->timestamps();

            $table->foreign('receiving_id')->references('id')->on('receivings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
