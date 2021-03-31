<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditChangesToReceivings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receivings', function (Blueprint $table) {
            $table->string('receipt_vocher')->nullable(false)->change();

            if (Schema::hasColumn('receivings', 'ledger_number'))
            {
                $table->dropColumn('ledger_number');
            }

            if (Schema::hasColumn('receivings', 'cost'))
            {
                $table->dropColumn('cost');
            }

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
            $table->string('receipt_vocher')->nullable()->change();
            $table->string('ledger_number');
            $table->decimal('cost', 19, 2);
        });
    }
}
