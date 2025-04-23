<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('ticket_purchases', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('card_number');
        });
    }

    public function down()
    {
        Schema::table('ticket_purchases', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
