<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RotationAuto extends Model
{
    protected $fillable = [
        'type'
    ];

    protected $table = 'rotations_auto';
}
