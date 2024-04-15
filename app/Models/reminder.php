<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reminder extends Model
{
    protected $table = "reminder";
    protected $fillable = [
        'schedule_id',
        'student_id',
        'status',
        'status_msg'
    ];

    use HasFactory;

    public function routeNotificationFor()
    {
        return $this->student->email;
    }

    public function student()
    {
        return $this->belongsTo(student::class, 'student_id', 'id');
    }

    public function schedule()
    {
        return $this->belongsTo(schedule::class, 'schedule_id', 'id');
    }



}
