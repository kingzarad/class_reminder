<?php

namespace App\Livewire\Components;

use App\Models\instructor as ModelsInstructor;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Instructor extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $instructor_name, $id;

    public function render()
    {
        $view = ModelsInstructor::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.components.instructor', ['instructor_list' => $view]);
    }

    public function saveInstructor()
    {
        $validated = $this->validate([
            'instructor_name' => 'required|string|min:3',
        ]);

        $existing = ModelsInstructor::where('name', $validated['instructor_name'])->exists();
        if ($existing) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Instructor already exist.');
            return;
        }

        $data = [
            'name' => $validated['instructor_name'],
        ];
        ModelsInstructor::create($data);
        $this->resetInput();
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Instructor save succesfully.');
    }

    public function updateInstructor()
    {
        $validated = $this->validate([
            'instructor_name' => 'required|string|min:3',
        ]);

        $data = [
            'name' => $validated['instructor_name'],
        ];
        ModelsInstructor::where('id', $this->id)->update($data);
        $this->resetInput();
        $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'Instructor updated succesfully.', modal: '#modalInstructorUpdate');
    }

    public function editInstructor($id)
    {
        $value = ModelsInstructor::findOrFail($id);

        if ($value) {
            $this->id = $value->id;
            $this->instructor_name = $value->name;
        } else {
            $this->redirect('/admin/instructor');
        }
    }

    public function deleteInstructor(int $id)
    {
        $this->id = $id;
    }


    public function closeModal()
    {
        $this->resetInput();
    }

    public function destroyInstructor()
    {
        $value = ModelsInstructor::find($this->id);

        if (!$value) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'Instructor not found!', modal: '#modalInstructorDelete');
            return;
        }

        $count = ModelsInstructor::count();
        if ($count === 1) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'You can only edit, but you cannot delete the only remaining Instructor.', modal: '#modalInstructorDelete');
            return;
        }


        $value->delete();

        $this->dispatch('destroyModal', status: 'warning',  position: 'top', message: 'Instructor delete successfully.', modal: '#modalInstructorDelete');
    }

    private function resetInput()
    {
        $this->reset(['instructor_name']);
    }
}
