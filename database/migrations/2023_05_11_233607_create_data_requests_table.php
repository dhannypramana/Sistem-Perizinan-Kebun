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
        Schema::create('data_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->string('license_number')->default("");
            $table->string('data_number')->unique();
            $table->string('status')->default('Menunggu Konfirmasi');
            $table->boolean('is_reviewed')->default(false);
            $table->string('admin_message')->default("");

            $table->string('category');
            $table->string('title');
            $table->string('purpose');
            $table->string('agency');
            $table->string('agency_license')->default("")->unique();
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
        Schema::dropIfExists('data_requests');
    }
};
