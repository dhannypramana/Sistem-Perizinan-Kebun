<?php

use App\Models\LicenseLetterhead;
use App\Models\LicenseSignature;
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
        Schema::create('license_formats', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('format_title');
            $table->string('title')->nullable();
            $table->string('signed')->nullable();
            $table->foreignIdFor(LicenseLetterhead::class)->nullable();
            $table->foreignIdFor(LicenseSignature::class)->nullable();
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
        Schema::dropIfExists('license_formats');
    }
};
