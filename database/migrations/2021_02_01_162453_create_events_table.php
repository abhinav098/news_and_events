<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->timestamp('start_date');
			$table->timestamp('end_date');
			$table->time('time');
			$table->string('title');
			$table->text('description');
			$table->string('location');
			$table->string('file_path')->nullable();
			$table->timestamps();

			$table->foreign('user_id')
				  ->references('id')
				  ->on('users')
				  ->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('events');
	}
}
