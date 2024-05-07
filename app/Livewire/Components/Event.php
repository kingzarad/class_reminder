<?php

namespace App\Livewire\Components;

use App\Models\Event as ModelsEvent;
use App\Models\student;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\reminder as ModelsReminder;

class Event extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $student_id, $event, $date, $id;

    public function render()
    {
        $student = student::orderBy('created_at', 'DESC')->get();
        $event_list = ModelsEvent::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.components.event', ['student'=>$student, 'event_list' => $event_list]);
    }

    public function saveEvent()
    {
        $validated = $this->validate([
            'student_id' => 'required',
            'event' => 'required',
            'date' => 'required',
        ]);

        $existing = ModelsEvent::where('student_id', $validated['student_id'])->exists();
        if ($existing) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Event already exist.');
            return;
        }

        $data = [
            'student_id' => $validated['student_id'],
            'event' => $validated['event'],
            'date' => $validated['date'],
            'status' => 'on',
        ];
        ModelsEvent::create($data);
        $this->resetInput();
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Event save succesfully.');
    }

    public function deleteEvent(int $id)
    {
        $this->id = $id;
    }

    public function updateOnEvent(int $id)
    {
        $data = [
            'status' => 'off',
        ];
        ModelsEvent::where('id', $id)->update($data);

        $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Reminder: This event cannot receive email notifications.');
    }

    public function updateOffEvent(int $id)
    {
        $data = [
            'status' => 'on',
        ];
        ModelsEvent::where('id', $id)->update($data);
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Reminder: This event can receive email notifications.');
    }

    public function destroyEvent()
    {
        $value = ModelsEvent::find($this->id);

        if (!$value) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'Event not found!', modal: '#modalEventDelete');
            return;
        }

        $value->delete();

        $this->dispatch('destroyModal', status: 'warning',  position: 'top', message: 'Event delete successfully.', modal: '#modalEventDelete');
    }

    public function closeModal()
    {
        $this->resetInput();
    }


    private function resetInput()
    {
        $this->reset(['student_id', 'event', 'date']);
    }
}
