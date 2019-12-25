<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email', '100')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('userName')->nullable();
            $table->string('phone', '30')->nullable()->unique();
            $table->unsignedBigInteger('roleId');
            $table->unsignedBigInteger('teamId')->nullable();
            $table->unsignedBigInteger('mangerId')->nullable();
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->boolean('userStatus')->nullable();
            $table->integer('duplicated')->default(1);
            $table->boolean('saleManPunished')->nullable();
            $table->boolean('saleManAssignedToClient')->nullable();
            $table->integer('saleManSendingMsgLimit')->nullable();
            $table->integer('active')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('roleId')->references('id')->on('roles');
            $table->foreign('teamId')->references('id')->on('users');
            $table->foreign('mangerId')->references('id')->on('users');
            $table->foreign('createdBy')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
