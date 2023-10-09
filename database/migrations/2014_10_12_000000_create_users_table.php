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
            $table->uuid('id')->primary();

            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('student_number')->nullable()->unique();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('academic_program')->nullable();
            $table->string('major')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->string('photo')->nullable();

            $table->timestamp('email_verified_at')->nullable();
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
