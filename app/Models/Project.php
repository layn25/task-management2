<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function Owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
    public function Task()
    {
        return $this->hasMany(Task::class, 'project_id', 'project_id');
    }
}
