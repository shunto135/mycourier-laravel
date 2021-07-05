<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
						$table->string('order_no',11);
						$table->bigInteger('order_status')->unsigned()->nullable();
						$table->BigInteger('product_id')->unsigned();
						$table->BigInteger('user_id')->unsigned();
						$table->Integer('is_requested')->unsigned()->nullable();
						$table->Integer('is_routed')->unsigned()->nullable();
						$table->Integer('is_delivered')->unsigned()->nullable();
						$table->Integer('is_canceled')->unsigned()->nullable();
						$table->BigInteger('employee_id')->unsigned();
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
        Schema::dropIfExists('orders');
    }
}
