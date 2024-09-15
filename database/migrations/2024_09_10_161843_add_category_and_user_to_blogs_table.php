<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryAndUserToBlogsTable extends Migration
{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Add columns if they do not already exist
            if (!Schema::hasColumn('blogs', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('image');
            }
            if (!Schema::hasColumn('blogs', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('category_id');
            }
            if (!Schema::hasColumn('blogs', 'views')) {
                $table->integer('views')->default(0)->after('user_id'); // Track number of views
            }

            // Set up foreign key constraints
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Drop foreign keys and columns
            $table->dropForeign(['category_id']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['category_id', 'user_id', 'views']);
        });
    }
}
