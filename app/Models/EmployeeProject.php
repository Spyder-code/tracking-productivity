<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProject extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'employee_id',
        'total_time',
        'percentage',
        'status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function task()
    {
        return $this->hasMany(Task::class,'employee_project_id');
    }

    public function taskClear()
    {
        return $this->task()->where('status',2)->count();
    }
}
