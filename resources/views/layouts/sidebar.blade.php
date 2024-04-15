<div class="row ">
    <div class="col-lg-12 bg-container-right-top ">
        <h5>CLASS REMINDER</h5>
    </div>

    <div class="col-lg-12 d-flex flex-column  align-items-center align-items-sm-start px-3 pt-2 text-white">

        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
            id="menu">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link align-middle px-0">
                    <i class="fas fa-home"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('reminder') }}" class="nav-link px-0 align-middle">
                    <i class="fas fa-bell"></i> <span class="ms-1 d-none d-sm-inline"> Set Reminder</span>
                </a>

            </li>
            <li>
                <a href="{{ route('student') }}" class="nav-link px-0 align-middle">
                    <i class="fas fa-plus-circle"></i>  <span class="ms-1 d-none d-sm-inline">Student</span></a>
            </li>
            <li>
                <a href="{{ route('course') }}" class="nav-link px-0 align-middle">
                    <i class="fas fa-plus-circle"></i>  <span class="ms-1 d-none d-sm-inline">Course</span></a>
            </li>
            <li>
                <a href="{{ route('subject') }}" class="nav-link px-0 align-middle">
                    <i class="fas fa-plus-circle"></i>  <span class="ms-1 d-none d-sm-inline">Subject</span></a>
            </li>

            <li>
                <a href="{{ route('room') }}" class="nav-link px-0 align-middle">
                    <i class="fas fa-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Room</span>
                </a>
            </li>
            <li>
                <a href="{{ route('instructor') }}" class="nav-link px-0 align-middle">
                    <i class="fas fa-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Instructor</span>
                </a>
            </li>
            <li>
                <a href="{{ route('time') }}" class="nav-link px-0 align-middle">
                    <i class="fas fa-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Time</span>
                </a>
            </li>
            <li class="d-none">
                <a href="{{ route('list') }}" class="nav-link px-0 align-middle">
                    <i class="fas fa-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">List</span>
                </a>
            </li>
            <li >
                @livewire('auth.logout')
            </li>
        </ul>

    </div>
</div>
