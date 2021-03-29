<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reg_number')->unique();
            $table->string('model');
            $table->integer('capacity');
            $table->string('engine_number');
            $table->string('chassis_number');
            $table->date('manufacturing_date');
            $table->date('first_used_date');
            $table->integer('first_odometer');
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('asset_id');
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
        Schema::dropIfExists('vehicles');
    }
}
