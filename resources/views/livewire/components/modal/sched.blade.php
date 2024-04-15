
<!-- Schedule -->
<div wire:ignore.self class="modal fade" id="modalScheduleAdd" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="saveSchedule">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Set Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="name" class="form-label">Title</label>
                        <input type="text" wire:model="title" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="course_id" class="form-label">Course</label>
                                <select class="form-control" wire:model="course_id">
                                    <option value="" selected></option>
                                    @foreach ($course as $item)
                                        <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label class="form-label">Subject</label>
                                <select class="form-control" wire:model="subject_id">
                                    <option value="" selected></option>
                                    @foreach ($subject as $item)
                                        <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label class="form-label">Room</label>
                                <select class="form-control" wire:model="room_id">
                                    <option value="" selected></option>
                                    @foreach ($room as $item)
                                        <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                    @endforeach
                                </select>
                                @error('room_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label class="form-label">Instructor</label>
                                <select class="form-control" wire:model="instructor_id">
                                    <option value="" selected></option>
                                    @foreach ($instructor as $item)
                                        <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                    @endforeach
                                </select>
                                @error('instructor_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mb-2">
                        <label for="name" class="form-label">Description</label>
                        <input type="text" wire:model="description" class="form-control">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Date</label>
                        <input type="date" wire:model="date" class="form-control">
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="name" class="form-label">Start Time</label>
                                <input type="time" wire:model="start_time" class="form-control">
                                @error('start_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="name" class="form-label">End Time</label>
                                <input type="time" wire:model="end_time" class="form-control">
                                @error('end_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div wire:ignore.self class="modal fade" id="modalScheduleUpdate" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="updateSchedule">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Set Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="name" class="form-label">Title</label>
                        <input type="text" wire:model="title" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="course_id" class="form-label">Course</label>
                                <select class="form-control" wire:model="course_id">
                                    <option value="" selected></option>
                                    @foreach ($course as $item)
                                        <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label class="form-label">Subject</label>
                                <select class="form-control" wire:model="subject_id">
                                    <option value="" selected></option>
                                    @foreach ($subject as $item)
                                        <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label class="form-label">Room</label>
                                <select class="form-control" wire:model="room_id">
                                    <option value="" selected></option>
                                    @foreach ($room as $item)
                                        <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                    @endforeach
                                </select>
                                @error('room_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label class="form-label">Instructor</label>
                                <select class="form-control" wire:model="instructor_id">
                                    <option value="" selected></option>
                                    @foreach ($instructor as $item)
                                        <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                    @endforeach
                                </select>
                                @error('instructor_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mb-2">
                        <label for="name" class="form-label">Description</label>
                        <input type="text" wire:model="description" class="form-control">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="form-label">Date</label>
                        <input type="date" wire:model="date" class="form-control">
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label for="name" class="form-label">Start Time</label>
                                <input type="time" wire:model="start_time" class="form-control">
                                @error('start_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col">
                            <div class="mb-2">
                                <label for="name" class="form-label">End Time</label>
                                <input type="time" wire:model="end_time" class="form-control">
                                @error('end_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div wire:ignore.self class="modal fade" role="dialog" id="modalScheduleDelete" tabindex="-1"
    aria-labelledby="deleteCategoryModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog ">
        <form wire:submit.prevent="destroySchedule">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Schedule</h1>
                </div>
                <div class="modal-body">
                    <h6 class="text-danger">Are you sure you want to delete this schedule?</h6>
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
