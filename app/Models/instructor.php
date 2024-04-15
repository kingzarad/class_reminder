<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instructor extends Model
{
    protected $table = "instructor";
    protected $fillable = [
        'name'
    ];

    use HasFactory;
}
