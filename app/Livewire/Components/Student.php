<?php

namespace App\Livewire\Components;

use App\Models\student as ModelsStudent;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Student extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $student_name, $student_email, $id;

    public function render()
    {
        $view = ModelsStudent::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.components.student', ['student_list' => $view]);
    }

    public function saveStudent()
    {
        $validated = $this->validate([
            'student_name' => 'required|string|min:3',
            'student_email' => 'required|string|email'
        ], [
            'student_name.required' => 'The name field is required.',
            'student_email.required' => 'The email field is required.',
            'student_email.email' => 'The email must be a valid email address.'
        ]);

        $existing = ModelsStudent::where('name', $validated['student_name'])->where('email', $validated['student_email'])->exists();
        if ($existing) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Student already exist.');
            return;
        }

        $data = [
            'name' => $validated['student_name'],
            'email' => $validated['student_email'],
        ];
        ModelsStudent::create($data);
        $this->resetInput();
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Student save succesfully.');
    }

    public function updateStudent()
    {
        $validated = $this->validate([
            'student_name' => 'required|string|min:3',
            'student_email' => 'required|string|email'
        ], [
            'student_name.required' => 'The name field is required.',
            'student_email.required' => 'The email field is required.',
            'student_email.email' => 'The email must be a valid email address.'
        ]);

        $data = [
            'name' => $validated['student_name'],
            'email' => $validated['student_email'],
        ];

        ModelsStudent::where('id', $this->id)->update($data);
        $this->resetInput();
        $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'Student updated succesfully.', modal: '#modalStudentUpdate');
    }

    public function editStudent($id)
    {
        $value = ModelsStudent::findOrFail($id);

        if ($value) {
            $this->id = $value->id;
            $this->student_name = $value->name;
            $this->student_email = $value->email;
        } else {
            $this->redirect('/admin/student');
        }
    }

    public function deleteStudent(int $id)
    {
        $this->id = $id;
    }


    public function closeModal()
    {
        $this->resetInput();
    }

    public function destroyStudent()
    {
        $value = ModelsStudent::find($this->id);

        if (!$value) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'Student not found!', modal: '#modalStudentDelete');
            return;
        }

        $count = ModelsStudent::count();
        if ($count === 1) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'You can only edit, but you cannot delete the only remaining Student.', modal: '#modalStudentDelete');
            return;
        }


        $value->delete();

        $this->dispatch('destroyModal', status: 'warning',  position: 'top', message: 'Student delete successfully.', modal: '#modalStudentDelete');
    }

    private function resetInput()
    {
        $this->reset(['student_name', 'student_email']);
    }
}
