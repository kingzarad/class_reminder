<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    protected $table = "schedule";
    protected $fillable = [
        'title',
        'course_id',
        'subject_id',
        'room_id',
        'instructor_id',
        'description',
        'date',
        'start_time',
        'end_time'
    ];

    use HasFactory;

    public function course()
    {
        return $this->belongsTo(course::class, 'course_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(subject::class, 'subject_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(room::class, 'room_id', 'id');
    }
    public function instructor()
    {
        return $this->belongsTo(instructor::class, 'instructor_id', 'id');
    }
}
