<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between my-3 mx-2">
                <h3>TIME LIST</h3>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalScheduleAdd">Add</button>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Course</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Room</th>
                                <th scope="col">Instructor</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">End Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($schedule_list))
                                <tr>
                                    <td colspan="3">No schedule found</td>
                                </tr>
                            @else
                                @foreach ($schedule_list as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->course->name }}</td>
                                        <td>{{ $item->subject->name }}</td>
                                        <td>{{ $item->room->name }}</td>
                                        <td>{{ $item->instructor->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->start_time }}</td>
                                        <td>{{ $item->end_time }}</td>
                                        <td>
                                            <div class="dropdown d-flex">
                                                <button class="btn btn-secondary btn-custom btn-sm dropdown-toggle"
                                                    type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <div class="dropdown-item">
                                                        <div class="d-flex align-items-center gap-3">
                                                            <button data-bs-toggle="modal"
                                                                wire:click="editSchedule({{ $item->id }})"
                                                                data-bs-target="#modalScheduleUpdate"
                                                                class="btn btn-sm btn-warning "><i
                                                                    class="fa fa-pencil-square-o"></i></button>
                                                            <button data-bs-toggle="modal"
                                                                wire:click="deleteSchedule({{ $item->id }})"
                                                                data-bs-target="#modalScheduleDelete"
                                                                class="btn btn-sm btn-danger"><i
                                                                    class="fa fa-trash-o"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('livewire.components.modal.sched')
    </div>
</div>
