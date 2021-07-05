<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
				Schema::create('products', function (Blueprint $table) {
						//
						$table->bigIncrements('id');
						$table->string('name', 50);
						$table->bigInteger('category_Id')->unsigned();
						$table->string('size');
						$table->bigInteger('height');
						$table->bigInteger('height_unit_id')->unsigned();
						$table->bigInteger('weight');
						$table->bigInteger('weight_unit_id')->unsigned();
						$table->bigInteger('qty');
						$table->string('delivery_zone', 50);
						$table->string('delivery_address', 250);
						$table->string('description', 500)->nullable();
						$table->Integer('is_requested')->unsigned()->nullable();
						$table->Integer('is_routed')->unsigned()->nullable();
						$table->Integer('is_delivered')->unsigned()->nullable();
						$table->Integer('is_canceled')->unsigned()->nullable();
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
				//
				Schema::dropIfExists('products');
		}
}
