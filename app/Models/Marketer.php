<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
    protected $fillable = [
        'name', 'campaignId',
    ];

    protected $table = 'marketers';

    public function campaign()
    {
        return $this->belongsTo('App\Models\Campaign','campaignId');
    }
}
