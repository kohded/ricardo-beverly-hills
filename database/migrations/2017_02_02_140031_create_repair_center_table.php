<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairCenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_center', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('address', 60);
            $table->string('city', 30);
            $table->string('state', 2);
            $table->string('zip', 5);
            $table->string('phone', 10);
            $table->string('email', 50);
            $table->string('contact_name', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repair_center');
    }
}
