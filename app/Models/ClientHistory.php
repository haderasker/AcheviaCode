<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId', 'actionId',
    ];

    protected $table = 'client_history';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
