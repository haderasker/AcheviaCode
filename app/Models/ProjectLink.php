<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLink extends Model
{
    protected $fillable = [
        'link','projectId',
    ];

    protected $table = 'project_links';
}
