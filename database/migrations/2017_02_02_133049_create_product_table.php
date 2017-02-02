<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->string('style', 40);
            $table->string('description', 80);
            $table->string('brand', 40);
            $table->tinyInteger('warranty_years');
            $table->string('color', 20);
            $table->string('class', 15);
            $table->string('class_description', 80);
            $table->date('launch_date');
            $table->date('discontinued')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
