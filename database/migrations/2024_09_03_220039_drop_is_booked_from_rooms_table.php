<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropIsBookedFromRoomsTable extends Migration
{
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('is_booked');
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->boolean('is_booked')->default(false)->after('image');
        });
    }
}
