<?php

namespace App\Models;

use App\Models\student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $table = "event";
    protected $fillable = [
        'student_id',
        'event',
        'date',
        'status',
        'status_msg'
    ];

    public function routeNotificationFor()
    {
        return $this->student->email;
    }


    public function student()
    {
        return $this->belongsTo(student::class, 'student_id', 'id');
    }

}
