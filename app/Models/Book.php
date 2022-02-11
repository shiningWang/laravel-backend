<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // if the primary not int laravel v9
    protected $keyType = 'string';

    protected $table = 'books';

    protected $fillable = [
        'name',
        'author',
        'publisher',
    ];
}