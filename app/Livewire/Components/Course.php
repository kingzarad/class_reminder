<?php

namespace App\Livewire\Components;

use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\Course as ModelsCourse;
use Livewire\Component;

class Course extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $course_name, $id;

    public function render()
    {
        $view = ModelsCourse::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.components.course', ['course_list' => $view]);
    }

    public function saveCourse()
    {
        $validated = $this->validate([
            'course_name' => ['required', 'string', 'min:3', 'regex:/^((?!([a-zA-Z0-9])\1{2,}).)*$/'],
        ], [
            'course_name.required' => 'The course name field is required.',
            'course_name.regex' => 'The course name should not contain repeated characters.'
        ]);


        $existing = ModelsCourse::where('name', $validated['course_name'])->exists();
        if ($existing) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Course already exist.');
            return;
        }

        $data = [
            'name' => strtolower($validated['course_name']),
        ];
        ModelsCourse::create($data);
        $this->resetInput();
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Course save succesfully.');
    }

    public function updateCourse()
    {
        $validated = $this->validate([
            'course_name' => 'required|string|min:3',
        ]);

        $data = [
            'name' => strtolower($validated['course_name']),

        ];
        ModelsCourse::where('id', $this->id)->update($data);
        $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'Course updated succesfully.', modal: '#modalCourseUpdate');
    }

    public function editCourse($id)
    {
        $value = ModelsCourse::findOrFail($id);

        if ($value) {
            $this->id = $value->id;
            $this->course_name = $value->name;
        } else {
            $this->redirect('/admin/course');
        }
    }

    public function deleteCourse(int $id)
    {
        $this->id = $id;
    }

    public function destroyCourse()
    {
        $value = ModelsCourse::find($this->id);

        if (!$value) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'Course not found!', modal: '#modalCourseDelete');
            return;
        }

        $count = ModelsCourse::count();
        if ($count === 1) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'You can only edit, but you cannot delete the only remaining course.', modal: '#modalCourseDelete');
            return;
        }


        $value->delete();

        $this->dispatch('destroyModal', status: 'warning',  position: 'top', message: 'Course delete successfully.', modal: '#modalCourseDelete');
    }

    private function resetInput()
    {
        $this->reset(['course_name']);
    }
}
