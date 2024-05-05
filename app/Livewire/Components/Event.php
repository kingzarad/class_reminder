<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\reminder as ModelsReminder;

class Event extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $student_id, $schedule_id, $email, $id;

    public function render()
    {
        return view('livewire.components.event');
    }

    public function saveReminder()
    {
        $validated = $this->validate([
            'student_id' => 'required',
            'schedule_id' => 'required',
            'email' => 'required',
        ]);

        $existing = ModelsReminder::where('student_id', $validated['student_id'])->where('schedule_id', $validated['schedule_id'])->exists();
        if ($existing) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Reminder already exist.');
            return;
        }

        $data = [
            'student_id' => $validated['student_id'],
            'schedule_id' => $validated['schedule_id'],
            'status' => 'on',
        ];
        ModelsReminder::create($data);
        $this->resetInput();
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Reminder save succesfully.');
    }

    public function deleteReminder(int $id)
    {
        $this->id = $id;
    }

    public function updateOnReminder(int $id)
    {
        $data = [
            'status' => 'off',
        ];
        ModelsReminder::where('id', $id)->update($data);

        $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Reminder: This reminder cannot receive email notifications.');
    }

    public function updateOffReminder(int $id)
    {
        $data = [
            'status' => 'on',
        ];
        ModelsReminder::where('id', $id)->update($data);
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Reminder: This reminder can receive email notifications.');
    }

    public function destroyReminder()
    {
        $value = ModelsReminder::find($this->id);

        if (!$value) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'Reminder not found!', modal: '#modalReminderDelete');
            return;
        }

        $value->delete();

        $this->dispatch('destroyModal', status: 'warning',  position: 'top', message: 'Reminder delete successfully.', modal: '#modalReminderDelete');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function updateEmail()
    {

        if (!empty($this->student_id)) {
            $student = student::find($this->student_id);
            if ($student) {
                $this->email = $student->email;
            }
        } else {
            $this->email = null;
        }
    }

    private function resetInput()
    {
        $this->reset(['student_id', 'schedule_id', 'email']);
    }
}
