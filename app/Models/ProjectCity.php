<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectCity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description',
    ];

    protected $table = 'project_cities';

    public function project()
    {
        return $this->hasMany('App\Models\Project','cityId');
    }
}
