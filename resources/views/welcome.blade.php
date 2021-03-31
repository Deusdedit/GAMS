@extends('layouts.master')

@section('content')

composer require spatie/laravel-activitylog
composer require barryvdh/laravel-dompdf
composer require doctrine/dbal

@stop

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UniqueReceiptVoucherToReceivings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receivings', function (Blueprint $table) {
            $table->string('receipt_vocher')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('receivings', function (Blueprint $table) {
            $table->string('receipt_vocher')->nullable(false)->change();
        });
    }
}
