<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dateTime('start_time')->nullable()->after('status');
            $table->dateTime('end_time')->nullable()->after('start_time');
            $table->string('venue')->nullable()->after('end_time');
            $table->decimal('price', 8, 2)->default(0)->after('venue');
            $table->integer('ticket_limit')->default(0)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['start_time', 'end_time', 'venue', 'price', 'ticket_limit']);
        });
    }
};
