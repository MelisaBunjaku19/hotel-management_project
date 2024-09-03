<?php
// In database/migrations/xxxx_xx_xx_xxxxxx_create_rooms_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_title');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('wifi');
            $table->string('room_type');
            $table->string('image');
            $table->timestamps();
        });
    }        

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
