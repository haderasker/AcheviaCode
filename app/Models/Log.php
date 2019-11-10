<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId', 'userName','actionView',
    ];

    protected $table = 'logs';


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
