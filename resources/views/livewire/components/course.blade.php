<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between my-3 mx-2">
                <h3>COURSE LIST</h3>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalCourseAdd">Add</button>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Course</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($course_list))
                                <tr>
                                    <td colspan="3">No courses found</td>
                                </tr>
                            @else
                                @foreach ($course_list as $index => $item)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ ucwords($item->name) }}</td>

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
                                                                wire:click="editCourse({{ $item->id }})"
                                                                data-bs-target="#modalCourseUpdate"
                                                                class="btn btn-sm btn-warning "><i
                                                                    class="fa fa-pencil-square-o"></i></button>
                                                            <button data-bs-toggle="modal"
                                                                wire:click="deleteCourse({{ $item->id }})"
                                                                data-bs-target="#modalCourseDelete"
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
                    {{ $course_list->links(data: ['scrollTo' => false]) }}

                </div>
            </div>
        </div>
        @include('livewire.components.modal.index')
    </div>
</div>
