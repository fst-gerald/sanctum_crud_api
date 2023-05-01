<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dateTime('start_date')->default(Carbon::now())->after('details');
            $table->dateTime('end_date')->default(Carbon::now()->addDays(3))->after('start_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contents', function($table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }
};
