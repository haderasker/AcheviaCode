<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sending', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sendingTypeId')->nullable();
            $table->string('body')->nullable();
            $table->integer('active')->default(1);
            $table->string('type')->nullable();
            $table->string('senderId')->nullable();
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
        Schema::dropIfExists('sending');
    }
}
