<div wire:ignore.self class="modal fade" id="modalReminderAdd" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="saveReminder">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Set Reminder</h1>
                </div>
                <div class="modal-body">

                    <div class="mb-2">
                        <label for="student_id" class="form-label">Student</label>
                        <select class="form-control" wire:model="student_id" wire:change="updateEmail">
                            <option value="" selected></option>
                            @foreach ($student as $item)
                                <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Email</label>
                        <input type="text" wire:model="email" class="form-control" readonly>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="schedule_id" class="form-label">Schedule</label>
                        <select class="form-control" wire:model="schedule_id">
                            <option value="" selected></option>
                            @foreach ($schedule as $item)
                                <option value="{{ $item->id }}">{{ ucfirst($item->title) }}</option>
                            @endforeach
                        </select>
                        @error('schedule_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Remind</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div wire:ignore.self class="modal fade" role="dialog" id="modalReminderDelete" tabindex="-1"
    aria-labelledby="deleteCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog ">
        <form wire:submit.prevent="destroyReminder">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Reminder</h1>
                </div>
                <div class="modal-body">
                    <h6 class="text-danger">Are you sure you want to delete this reminder?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary"
                        data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </form>
    </div>
</div>

