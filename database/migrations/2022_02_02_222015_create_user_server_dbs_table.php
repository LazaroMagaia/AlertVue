<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserServerDbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_server_dbs', function (Blueprint $table) {
            $table->id();
            $table->string("url_name");
            $table->unsignedBigInteger("user_id");
            $table->boolean("status");
            $table->dateTime("date_up")->nullable();
            $table->dateTime("date_down")->nullable();
            $table->dateTime("date_time_reset");
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
        Schema::dropIfExists('user_server_dbs');
    }
}
