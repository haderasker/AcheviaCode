<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description','cityId',
    ];

    protected $table = 'projects';

    public function teams()
    {
        return $this->belongsToMany('App\Models\Team','project_team','projectId','teamId');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\ProjectCity','cityId');
    }

    public function campaigns()
    {
        return $this->hasMany('App\Models\Campaign','projectId');
    }
}
