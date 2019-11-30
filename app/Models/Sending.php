<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sending extends Model
{
    protected $fillable = [
        'sendingTypeId','body','active','type','senderId'
    ];

    protected $table = 'sending';
}
