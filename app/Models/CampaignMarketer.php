<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignMarketer extends Model
{
    protected $fillable = [
        'marketerId', 'campaignId',
    ];

    protected $table = 'campaign_marketers';

}
