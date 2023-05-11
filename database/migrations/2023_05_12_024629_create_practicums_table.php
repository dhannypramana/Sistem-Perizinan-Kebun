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
        Schema::create('practicums', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->string('license_number')->default("");
            $table->string('practicum_number');
            $table->string('status')->default('Menunggu Konfirmasi');
            $table->boolean('is_reviewed')->default(false);
            $table->string('admin_message')->default("");

            $table->string('location');
            $table->integer('personnel');
            $table->string('practicum_supervisor');
            $table->string('assistant');
            $table->string('subject');
            $table->string('class_supervisor')->nullable();
            $table->string('facility');
            $table->date('start_time');
            $table->date('end_time');
            $table->string('agency_license')->default("");
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
        Schema::dropIfExists('practicums');
    }
};
