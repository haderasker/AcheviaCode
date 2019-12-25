<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignMarketersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_marketers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('marketerId');
            $table->unsignedBigInteger('campaignId');
            $table->timestamps();
            $table->foreign('campaignId')->references('id')->on('campaigns');
            $table->foreign('marketerId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_marketers');
    }
}
