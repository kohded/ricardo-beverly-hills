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
            $table->string('product_style', 20);
            $table->unsignedInteger('damage_code_id');
            $table->string('ship_to', 20)->nullable();
            $table->string('tracking_number', 40)->nullable();
            $table->unsignedInteger('repair_center_id');
            $table->date('date_closed')->nullable()->default(NULL);
            $table->boolean('replace_order')->default(0);
            $table->unsignedInteger('email_sent')->default(0);
            $table->boolean('part_needed')->nullable();
            $table->string('parts_needed', 200)->nullable();
            $table->boolean('parts_available')->nullable()->default(NULL);
            $table->string('part_company_comment', 200)->nullable()->default(NULL);
        });

        DB::update("ALTER TABLE claim AUTO_INCREMENT = 1000;");
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
