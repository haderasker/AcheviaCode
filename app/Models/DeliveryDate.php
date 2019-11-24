<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryDate extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $table = 'delivery_dates';
}
