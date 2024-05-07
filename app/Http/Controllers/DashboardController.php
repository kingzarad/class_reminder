<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\room;
use App\Models\course;
use App\Models\Event;
use App\Models\student;
use App\Models\subject;
use App\Models\reminder;
use App\Models\schedule;
use App\Models\instructor;
use Illuminate\Http\Request;
use App\Notifications\reminderNotif;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;

class DashboardController extends Controller
{
    public function Dashboard()
    {
        $this->Send();
        $this->SendEvent();
        return response()->view(
            'components/dashboard',
            [
                'reminder_total' => reminder::where('status', 'on')->where('status_msg', '1')->count(),
                'student_total' => student::count(),
                'course_total' => course::count(),
                'subject_total' => subject::count(),
                'room_total' => room::count(),
                'instructor_total' => instructor::count(),
                'schedule_total' => schedule::count()
            ]
        )->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function Reminder()
    {
        $this->Send();
        return response()->view('components/reminder')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');

    }

    public function Student()
    {
        return response()->view('components/student')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function Course()
    {
        return response()->view('components/course')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function Subject()
    {
        return response()->view('components/subject')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function Room()
    {
        return response()->view('components/room')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function Instructor()
    {
        return response()->view('components/instructor')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function Time()
    {
        return response()->view('components/time')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function Event()
    {
        $this->SendEvent();
        return response()->view('components/event')->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function Send()
    {
        $reminder = reminder::all();
        $currentDate = Carbon::now();

        foreach ($reminder as $item) {
            $scheduleDate = Carbon::parse($item->schedule->date);

            // Check if the schedule date is one day ahead of the current date
            if ($currentDate->isSameDay($scheduleDate)  && $item->status == 'on' && $item->status_msg != 0) {
                $studentName = strtoupper($item->student->name);
                $startTime = date('g:i A', strtotime($item->schedule->start_time));
                $endTime = date('g:i A', strtotime($item->schedule->end_time));

                $details = [
                    'greeting' => "Hello, {$studentName}",
                    'body' => "Title: {$item->schedule->title} <br>
                               Subject: {$item->schedule->subject->name} <br>
                               Instructor: {$item->schedule->instructor->name} <br>
                               Room: {$item->schedule->room->name} <br>
                               Time: {$startTime} - {$endTime} <br>
                               Date:{$item->schedule->date} <br> Note:<br> {$item->schedule->description}",
                    'lastline' => '',
                    'regards' => "Regards, <strong>{$item->schedule->instructor->name}</strong>"
                ];
                $itemCopy = $item;
                Queue::push(function () use ($itemCopy, $details) {
                    Notification::send($itemCopy, new reminderNotif($details));
                    // Update the status_msg to 0 after successfully sending the email
                    $itemCopy->status_msg = 0;
                    $itemCopy->save();
                });
            }
        }
    }

    public function SendEvent()
    {
        $event = Event::all();
        $currentDate = Carbon::now();

        foreach ($event as $item) {
            $scheduleDate = Carbon::parse($item->date);
            $date = Carbon::parse($item->date)->format('F j, Y');



            // Check if the schedule date is one day ahead of the current date
            if ($currentDate->isSameDay($scheduleDate)  && $item->status == 'on' && $item->status_msg != 0) {
                $studentName = strtoupper($item->student->name);
                $eventName = strtoupper($item->event);

                $details = [
                    'greeting' => "Hello, {$studentName}",
                    'body' => "Event: {$eventName} <br>
                               Date:{$date}",
                    'lastline' => '',
                    'regards' => ""
                ];
                $itemCopy = $item;
                Queue::push(function () use ($itemCopy, $details) {
                    Notification::send($itemCopy, new reminderNotif($details));
                    // Update the status_msg to 0 after successfully sending the email
                    $itemCopy->status_msg = 0;
                    $itemCopy->save();
                });
            }
        }
    }
}
