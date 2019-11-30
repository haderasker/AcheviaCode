<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendingTypes extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $table = 'sending_types';
}
