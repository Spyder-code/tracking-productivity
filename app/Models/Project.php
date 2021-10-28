<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'status',
        'code',
    ];

    public function employeeProject()
    {
        return $this->hasMany(Task::class,'project_id');
    }

    public function taskClear()
    {
        return $this->employeeProject()->where('status',2)->count();
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function employee_project()
    {
        return $this->hasMany(EmployeeProject::class);
    }
}
