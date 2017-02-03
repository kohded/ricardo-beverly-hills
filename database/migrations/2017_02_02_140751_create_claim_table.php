<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('customer_id');
            $table->string('product_style', 11);
            $table->unsignedInteger('damage_code_id');
            $table->string('tracking_number', 40)->nullable();
            $table->unsignedInteger('repair_center_id');
            $table->date('date_closed')->nullable()->default(NULL);
            $table->boolean('replaced')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claim');
    }
}
