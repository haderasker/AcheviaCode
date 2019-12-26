<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_history', function (Blueprint $table) {
            $table->unsignedBigInteger('viaMethodId')->nullable();
            $table->string('summery')->nullable();
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->string('state')->nullable();
            $table->foreign('createdBy')->references('id')->on('users');
            $table->foreign('viaMethodId')->references('id')->on('via_methods');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_history');
    }
}
