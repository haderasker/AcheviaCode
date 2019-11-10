<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','teamLeaderId',
    ];

    protected $table = 'teams';

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project' , 'project_team','teamId','projectId');
    }

    public function sales()
    {
        return $this->hasMany('App\User', 'teamId');
    }
}
