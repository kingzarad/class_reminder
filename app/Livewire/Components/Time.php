<?php

namespace App\Livewire\Components;

use App\Models\course;
use App\Models\instructor;
use App\Models\room;
use App\Models\schedule;
use App\Models\subject;
use Livewire\Component;

class Time extends Component
{

    public $title, $course_id, $subject_id, $room_id, $instructor_id, $description, $date, $start_time, $end_time, $id;

    public function render()
    {
        $view = schedule::orderBy('created_at', 'DESC')->paginate(10);
        $course = course::orderBy('created_at', 'DESC')->get();
        $subject = subject::orderBy('created_at', 'DESC')->get();
        $room = room::orderBy('created_at', 'DESC')->get();
        $instructor = instructor::orderBy('created_at', 'DESC')->get();

        return view('livewire.components.time', [
            'schedule_list' => $view,
            'course' => $course,
            'subject' => $subject,
            'room' => $room,
            'instructor' => $instructor
        ]);
    }

    public function saveSchedule()
    {
        $validated = $this->validate([
            'title' => 'required|string|min:3',
            'course_id' => 'required',
            'subject_id' => 'required',
            'room_id' => 'required',
            'instructor_id' => 'required',
            'description' => 'required|string|min:3|max:50',
            'date' => 'required|date_format:Y-m-d',
            'start_time' => 'required',
            'end_time' => 'required',
        ], [
            'course_id.required' => 'The course field is required.',
            'subject_id.required' => 'The subject field is required.',
            'room_id.required' => 'The room field is required.',
            'instructor_id.required' => 'The instructor field is required.',
            'date.date_format' => 'The date must be in the format YYYY-MM-DD.',
            'start_time.regex' => 'Invalid start time format. Please use HH:MM format (e.g., 08:30).',
            'end_time.regex' => 'Invalid end time format. Please use HH:MM format (e.g., 17:45).',
        ]);


        $existing = schedule::where('title', $validated['title'])->exists();
        if ($existing) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Schedule already exist.');
            return;
        }

        $data = [
            'title' => $validated['title'],
            'course_id' => $validated['course_id'],
            'subject_id' => $validated['subject_id'],
            'room_id' => $validated['room_id'],
            'instructor_id' => $validated['instructor_id'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],

        ];
        schedule::create($data);
        $this->resetInput();
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Schedule save succesfully.');
    }

    public function updateSchedule()
    {
        $validated = $this->validate([
            'title' => 'required|string|min:3',
            'course_id' => 'required',
            'subject_id' => 'required',
            'room_id' => 'required',
            'instructor_id' => 'required',
            'description' => 'required|string|min:3|max:50',
            'date' => 'required|date_format:Y-m-d',
            'start_time' => 'required',
            'end_time' => 'required',
        ], [
            'course_id.required' => 'The course field is required.',
            'subject_id.required' => 'The subject field is required.',
            'room_id.required' => 'The room field is required.',
            'instructor_id.required' => 'The instructor field is required.',
            'date.date_format' => 'The date must be in the format YYYY-MM-DD.',
            'start_time.regex' => 'Invalid start time format. Please use HH:MM format (e.g., 08:30).',
            'end_time.regex' => 'Invalid end time format. Please use HH:MM format (e.g., 17:45).',
        ]);

        $data = [
            'title' => $validated['title'],
            'course_id' => $validated['course_id'],
            'subject_id' => $validated['subject_id'],
            'room_id' => $validated['room_id'],
            'instructor_id' => $validated['instructor_id'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],

        ];
        schedule::where('id', $this->id)->update($data);
        $this->resetInput();
        $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'Schedule updated succesfully.', modal: '#modalScheduleUpdate');
    }

    public function editSchedule($id)
    {
        $value = schedule::findOrFail($id);

        if ($value) {
            $this->id = $value->id;
            $this->title = $value->title;
            $this->course_id = $value->course_id;
            $this->subject_id = $value->subject_id;
            $this->room_id = $value->room_id;
            $this->instructor_id = $value->instructor_id;
            $this->description = $value->description;
            $this->date = $value->date;
            $this->end_time = $value->end_time;
            $this->start_time = $value->start_time;
        } else {
            $this->redirect('/admin/time');
        }
    }

    public function closeModal()
    {
        $this->resetInput();
    }


    public function destroySchedule()
    {
        $value = schedule::find($this->id);

        if (!$value) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'Schedule not found!', modal: '#modalScheduleDelete');
            return;
        }

        $count = schedule::count();
        if ($count === 1) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'You can only edit, but you cannot delete the only remaining Schedule.', modal: '#modalScheduleDelete');
            return;
        }


        $value->delete();

        $this->dispatch('destroyModal', status: 'warning',  position: 'top', message: 'Schedule delete successfully.', modal: '#modalScheduleDelete');
    }

    public function deleteSchedule(int $id)
    {
        $this->id = $id;
    }

    private function resetInput()
    {
        $this->reset(['title', 'course_id', 'subject_id', 'room_id', 'instructor_id', 'description', 'date', 'start_time', 'end_time']);
    }
}
