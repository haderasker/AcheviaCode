<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    protected $table = 'roles';

    public function users()
    {
        return $this->hasMany('App\User' , 'roleId');
    }
}
