<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'name', 'description','projectId'
    ];

    protected $table = 'campaigns';

    public function project()
    {
        return $this->belongsTo('App\Models\Project','projectId');
    }

    public function marketers()
    {
        return $this->belongsToMany('App\User','campaign_marketers','campaignId' , 'marketerId');
    }
}
