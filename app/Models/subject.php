<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    protected $table = "subject";
    protected $fillable = [
        'name'
    ];
    use HasFactory;
}
