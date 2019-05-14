<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return  void
	 */
	public function up() {
		DB::beginTransaction();

		// Create table for storing roles
		Schema::create('roles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('display_name')->nullable();
			$table->string('description')->nullable();
			$table->timestamps();
		});

		// Create table for associating roles to users (Many-to-Many)
		Schema::create('role_user', function (Blueprint $table) {
			$table->integer('user_id')->unsigned();
			$table->integer('role_id')->unsigned();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('role_id')->references('id')->on('roles');
		});

		// Create table for storing permissions
		Schema::create('permissions', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('display_name')->nullable();
			$table->string('description')->nullable();
			$table->timestamps();
		});

		// Create table for associating permissions to roles (Many-to-Many)
		Schema::create('permission_role', function (Blueprint $table) {
			$table->integer('permission_id')->unsigned();
			$table->integer('role_id')->unsigned();

			$table->foreign('permission_id')->references('id')->on('permissions');
			$table->foreign('role_id')->references('id')->on('roles');

		});
		Schema::create('type_cinema', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name_type_cinema')->unique();
			$table->timestamps();
		});
		Schema::create('type_cinema_user', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('type_cinema_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('type_cinema_id')->references('id')->on('type_cinema');
			$table->timestamps();
		});

		//    DB::commit();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return  void
	 */
	public function down() {
		Schema::drop('permission_role');
		Schema::drop('permissions');
		Schema::drop('role_user');
		Schema::drop('roles');
		Schema::drop('type_cinema');
		Schema::drop('type_cinema_user');
	}
}
