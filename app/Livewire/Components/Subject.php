<?php

namespace App\Livewire\Components;

use App\Models\subject as ModelsSubject;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Component;

class Subject extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $subject_name, $id;

    public function render()
    {
        $view = ModelsSubject::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.components.subject', ['subject_list' => $view]);
    }

    public function saveSubject()
    {
        $validated = $this->validate([
            'subject_name' => ['required', 'string', 'min:3', 'regex:/^((?!([a-zA-Z0-9])\1{2,}).)*$/'],
        ], [
            'subject_name.required' => 'The subject name field is required.',
            'subject_name.regex' => 'The subject name should not contain repeated characters.'
        ]);

        $existing = ModelsSubject::where('name', $validated['subject_name'])->exists();
        if ($existing) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Subject already exist.');
            return;
        }

        $data = [
            'name' => strtolower($validated['subject_name']),
        ];
        ModelsSubject::create($data);
        $this->resetInput();
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Subject save succesfully.');
    }

    public function updateSubject()
    {
        $validated = $this->validate([
            'subject_name' => 'required|string|min:3',
        ]);

        $data = [
            'name' => strtolower($validated['subject_name']),
        ];
        ModelsSubject::where('id', $this->id)->update($data);
        $this->resetInput();
        $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'Subject updated succesfully.', modal: '#modalSubjectUpdate');
    }

    public function editSubject($id)
    {
        $value = ModelsSubject::findOrFail($id);

        if ($value) {
            $this->id = $value->id;
            $this->subject_name = $value->name;
        } else {
            $this->redirect('/admin/subject');
        }
    }

    public function deleteSubject(int $id)
    {
        $this->id = $id;
    }


    public function closeModal()
    {
        $this->resetInput();
    }

    public function destroySubject()
    {
        $value = ModelsSubject::find($this->id);

        if (!$value) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'Subject not found!', modal: '#modalSubjectDelete');
            return;
        }

        $count = ModelsSubject::count();
        if ($count === 1) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'You can only edit, but you cannot delete the only remaining Subject.', modal: '#modalSubjectDelete');
            return;
        }


        $value->delete();

        $this->dispatch('destroyModal', status: 'warning',  position: 'top', message: 'Subject delete successfully.', modal: '#modalSubjectDelete');
    }

    private function resetInput()
    {
        $this->reset(['subject_name']);
    }
}
