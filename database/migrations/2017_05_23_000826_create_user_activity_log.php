<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActivityLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activity_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('username');
            $table->string('user_role');
            $table->timestamp('created_at')->nullable(true)->useCurrent();
            $table->string('action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_activity_log');
    }
}
