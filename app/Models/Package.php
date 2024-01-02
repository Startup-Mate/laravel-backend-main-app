<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'permissions',
        'privileges',
        'price',
    ];

    protected $casts = [
        'permissions' => 'json',
        'privileges' => 'json',
    ];
}
