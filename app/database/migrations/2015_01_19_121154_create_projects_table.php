<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function($table) {
			$table->increments('id');
			$table->string('description');
			$table->string('docket')->index();
			$table->integer('customer_id')->unsigned()->index();
			$table->foreign('customer_id')->references('id')->on('customers');
			$table->string('quantity');
			$table->string('stock');
			$table->string('notes');
			$table->integer('rep_id')->unsigned()->index();
			$table->foreign('rep_id')->references('id')->on('users');
			$table->integer('pm_id')->unsigned()->index();
			$table->foreign('pm_id')->references('id')->on('users');
			$table->boolean('schedule')->default(0);
			$table->string('reference');
			$table->decimal('order_amount', 10, 2);
			$table->decimal('shipping', 10, 2);
			$table->timestamp('due_at');
			$table->timestamp('completed_at')->nullable();
			$table->timestamp('billed_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}
