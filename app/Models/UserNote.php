<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNote extends Model
{
    protected $fillable = [
        'userId', 'note'
    ];

    protected $table = 'users_notes';
}
