<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
			$table->boolean('isAdmin')->default(false);
			$table->boolean('isVaccinated')->default(false);
            $table->string('firstName');
			$table->string('lastName');
			$table->string('street')->nullable(); // nullable bc admins do not need to enter their address data etc
			$table->string('houseNo')->nullable();
			$table->string('city')->nullable();
			$table->string('zipCode', 4)->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('dateOfBirth')->nullable();
			$table->enum('gender', ['m', 'w', 'd'])->nullable();
            $table->string('password');
            $table->string('ssno', 10)->unique();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
