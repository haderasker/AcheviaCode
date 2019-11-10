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
            $table->unsignedBigInteger('projectId');
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
            $table->integer('typeClient')->nullable();
            $table->string('ZipCode')->nullable();
            $table->string('ip')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->boolean('canView')->nullable();
            $table->string('linkView')->nullable();
            $table->integer('limitView')->nullable();
            $table->integer('addedClientFrom')->nullable();
            $table->string('addedClientPlatform')->nullable();
            $table->string('addedClientLink')->nullable();
            $table->unsignedBigInteger('assignToSaleManId')->default(0);
            $table->time('assignedTime')->nullable();
            $table->date('assignedDate')->nullable();
            $table->integer('lastAssigned')->nullable();
            $table->time('notificationTime')->nullable();
            $table->date('notificationDate')->nullable();
            $table->integer('transferred')->default(0); // 1 transferred 0 no
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
        Schema::dropIfExists('client_details');
    }
}
