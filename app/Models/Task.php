<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'task_id';

    public function Project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }
    public function Assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }
}
