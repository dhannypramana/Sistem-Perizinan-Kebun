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
        Schema::create('research', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->string('license_number')->default("");
            $table->string('status')->default('Menunggu Konfirmasi');
            $table->string('admin_message')->default("");
            $table->boolean('is_reviewed')->default(false);
            $table->string('research_number')->unique();

            $table->string('location');
            $table->integer('personnel');
            $table->string('title');
            $table->date('start_time');
            $table->date('end_time');
            $table->string('facility');
            $table->string('research_supervisor');
            $table->string('academic_supervisor');
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
        Schema::dropIfExists('research');
    }
};
