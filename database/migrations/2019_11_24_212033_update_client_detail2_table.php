<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientDetail2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_details', function (Blueprint $table) {
            $table->string('property')->nullable();
            $table->string('propertyLocation')->nullable();
            $table->string('propertyUtility')->nullable();
            $table->integer('areaFrom')->nullable();
            $table->integer('areaTo')->nullable();
            $table->integer('budget')->nullable();
            $table->unsignedBigInteger('deliveryDateId')->nullable();
            $table->unsignedBigInteger('convertProject1')->nullable();
            $table->unsignedBigInteger('convertProject2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_details');

    }
}
