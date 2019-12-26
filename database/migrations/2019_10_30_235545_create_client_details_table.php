<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('projectId')->nullable();
            $table->unsignedBigInteger('viaMethodId')->nullable();
            $table->unsignedBigInteger('actionId')->nullable();
            $table->string('projectCity')->nullable();
            $table->string('space')->nullable();
            $table->string('jobTitle')->nullable();
            $table->string('address')->nullable();
            $table->string('notes')->nullable();
            $table->boolean('gender')->nullable();
            $table->date('newActionDate')->nullable();
            $table->time('newActionTime')->nullable();
            $table->string('clientAgeRange')->nullable();
            $table->string('summery')->nullable();
            $table->string('interestsUserProjects')->nullable();
            $table->integer('typeClient')->nullable(); //0 client , 1 duplicated
            $table->string('ZipCode')->nullable();
            $table->string('ip')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->boolean('canView')->nullable();
            $table->string('linkView')->nullable();
            $table->integer('limitView')->nullable();
            $table->string('addedClientFrom')->nullable();
            $table->string('addedClientPlatform')->nullable();
            $table->string('addedClientLink')->nullable();
            $table->unsignedBigInteger('assignToSaleManId')->nullable();
            $table->time('assignedTime')->nullable();
            $table->date('assignedDate')->nullable();
            $table->time('notificationTime')->nullable();
            $table->date('notificationDate')->nullable();
            $table->integer('transferred')->default(0); // 1 transferred 0 no
            $table->timestamps();
            $table->foreign('projectId')->references('id')->on('projects');
            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('actionId')->references('id')->on('actions');
            $table->foreign('viaMethodId')->references('id')->on('via_methods');
            $table->foreign('assignToSaleManId')->references('id')->on('users');
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
