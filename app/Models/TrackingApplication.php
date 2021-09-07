<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'tracking_id',
        'application_id',
        'content',
    ];

    public function app()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }
}
