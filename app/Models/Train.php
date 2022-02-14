<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class train extends Model
{
    use HasFactory;

    protected $table = 'trains';

    protected $fillable = [
        'line',
        'station',
        'build_year',
        'frequency',
        'manager',
        'active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
