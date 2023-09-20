<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->string('license_number')->default("");
            $table->string('loan_number')->unique();
            $table->string('status')->default('Menunggu Konfirmasi');
            $table->boolean('is_reviewed')->default(false);
            $table->string('admin_message')->default("");

            $table->string('category');
            $table->string('title');
            $table->integer('quantity');
            $table->string('activity');
            $table->string('purpose');
            $table->date('start_time');
            $table->date('end_time');
            $table->string('agency_license')->default("")->unique();
            $table->string('reply')->nullable();
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
        Schema::dropIfExists('loans');
    }
};
