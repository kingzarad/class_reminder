<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    protected $table = "room";
    protected $fillable = [
        'name'
    ];

    use HasFactory;
}
