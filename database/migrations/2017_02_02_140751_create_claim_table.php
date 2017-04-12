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
            $table->timestamp('created_at')->nullable(true)->useCurrent();
            $table->unsignedInteger('customer_id');
            $table->string('product_style', 11);
            $table->unsignedInteger('damage_code_id');
            $table->string('ship_to', 20);
            $table->string('tracking_number', 40)->nullable();
            $table->unsignedInteger('repair_center_id');
            $table->date('date_closed')->nullable()->default(NULL);
            $table->boolean('replaced')->default(0);
            $table->unsignedInteger('email_sent')->default(0);
            $table->boolean('part_needed');
            $table->string('parts_needed', 200)->nullable;
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
