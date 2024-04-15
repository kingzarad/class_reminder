<?php

namespace App\Livewire\Components;

use App\Models\room as ModelsRoom;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Component;

class Room extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $room_name, $id;

    public function render()
    {
        $view = ModelsRoom::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.components.room', ['room_list' => $view]);
    }

    public function saveRoom()
    {
        $validated = $this->validate([
            'room_name' => 'required|string|min:3',
        ]);

        $existing = ModelsRoom::where('name', $validated['room_name'])->exists();
        if ($existing) {
            $this->dispatch('messageModal', status: 'warning', position: 'top', message: 'Room already exist.');
            return;
        }

        $data = [
            'name' => $validated['room_name'],
        ];
        ModelsRoom::create($data);
        $this->resetInput();
        $this->dispatch('messageModal', status: 'success', position: 'top', message: 'Room save succesfully.');
    }

    public function updateRoom()
    {
        $validated = $this->validate([
            'room_name' => 'required|string|min:3',
        ]);

        $data = [
            'name' => $validated['room_name'],
        ];
        ModelsRoom::where('id', $this->id)->update($data);
        $this->resetInput();
        $this->dispatch('destroyModal', status: 'success', position: 'top', message: 'Room updated succesfully.', modal: '#modalRoomUpdate');
    }

    public function editRoom($id)
    {
        $value = ModelsRoom::findOrFail($id);

        if ($value) {
            $this->id = $value->id;
            $this->room_name = $value->name;
        } else {
            $this->redirect('/admin/room');
        }
    }

    public function deleteRoom(int $id)
    {
        $this->id = $id;
    }


    public function closeModal()
    {
        $this->resetInput();
    }

    public function destroyRoom()
    {
        $value = ModelsRoom::find($this->id);

        if (!$value) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'Room not found!', modal: '#modalRoomDelete');
            return;
        }

        $count = ModelsRoom::count();
        if ($count === 1) {
            $this->dispatch('destroyModal', status: 'warning', position: 'top', message: 'You can only edit, but you cannot delete the only remaining Room.', modal: '#modalRoomDelete');
            return;
        }


        $value->delete();

        $this->dispatch('destroyModal', status: 'warning',  position: 'top', message: 'Room delete successfully.', modal: '#modalRoomDelete');
    }

    private function resetInput()
    {
        $this->reset(['room_name']);
    }
}
