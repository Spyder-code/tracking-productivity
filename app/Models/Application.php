<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'application_type_id',
        'category_id',
        'name',
    ];

    public function content()
    {
        return $this->hasMany(TrackingApplication::class, 'application_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
