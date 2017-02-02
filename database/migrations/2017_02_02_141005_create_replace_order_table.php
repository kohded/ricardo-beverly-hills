<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplaceOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replace_order', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('date_shipped')->nullable();
            $table->unsignedInteger('customer_id');
            $table->string('product_style', 11);
            $table->unsignedInteger('repair_center_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replace_order');
    }
}
