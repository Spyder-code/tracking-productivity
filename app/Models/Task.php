<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_project_id',
        'name',
        'status',
    ];

    public function employeeProject()
    {
        return $this->belongsTo(EmployeeProject::class,'employee_project_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

}
