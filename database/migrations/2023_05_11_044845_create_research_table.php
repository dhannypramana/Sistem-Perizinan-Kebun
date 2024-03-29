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
            $table->string('research_number')->unique();
            $table->tinyInteger('status')->default(0);
            $table->boolean('is_reviewed')->default(false);
            $table->string('admin_message')->default("");

            $table->string('location');
            $table->integer('personnel');
            $table->string('title');
            $table->date('start_time');
            $table->date('end_time');
            $table->string('facility');
            $table->string('research_supervisor')->nullable();
            $table->string('academic_supervisor')->nullable();
            $table->string('agency_license')->default("");

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
        Schema::dropIfExists('research');
    }
};
