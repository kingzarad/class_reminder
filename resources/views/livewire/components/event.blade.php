<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between my-3 mx-2">
                <h3>EVENT LIST</h3>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalReminderAdd">Add</button>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Event</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if (empty($reminder_list))
                                <tr>
                                    <td colspan="3">No Reminder found</td>
                                </tr>
                            @else
                                @foreach ($reminder_list as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $item->student->name }}</td>
                                        <td>{{ $item->student->email }}</td>

                                        <td><a href="{{ route('time') }}"
                                                class="link">{{ $item->schedule->title }}</a></td>
                                        <td>
                                            @if ($item->status_msg == 0)
                                                <span class="badge bg-success">SENT</span>
                                            @else
                                                <span class="badge bg-warning text-dark">NOT SENT</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                @if ($item->status == 'on')
                                                    <button wire:click="updateOnReminder({{ $item->id }})"
                                                        class="btn btn-sm btn-warning "><i
                                                            class="fa-solid fa-toggle-on"></i></button>
                                                @endif
                                                @if ($item->status == 'off')
                                                    <button wire:click="updateOffReminder({{ $item->id }})"
                                                        class="btn btn-sm btn-warning "><i
                                                            class="fa-solid fa-toggle-off"></i></button>
                                                @endif
                                                <button data-bs-toggle="modal"
                                                    wire:click="deleteReminder({{ $item->id }})"
                                                    data-bs-target="#modalReminderDelete"
                                                    class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif --}}


                        </tbody>
                    </table>
                    {{-- {{ $reminder_list->links(data: ['scrollTo' => false]) }} --}}

                </div>

            </div>
        </div>
        {{-- @include('livewire.components.modal.rem') --}}
    </div>
</div>
