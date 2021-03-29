<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->decimal('price', 19, 2);
            $table->date('date');
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
        Schema::dropIfExists('disposals');
    }
}
