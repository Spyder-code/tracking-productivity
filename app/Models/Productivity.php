<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'app_id',
        'category_id',
        'role_id',
        'output',
        'status'
    ];
}
