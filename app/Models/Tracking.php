<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_project_id',
        'total_time',
        'time_start',
        'time_stop'
    ];
}
