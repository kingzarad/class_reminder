@extends('layouts.app')
@section('title', 'CLASS REMINDER - DASHBOARD')
@section('content')
    <div class="py-3">
        <div class="row">
            <div class="col-lg-12">
                <h3>DASHBOARD</h3>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="m-2"><strong>{{ $reminder_total }}</strong></h5>
                                <p class="card-text mx-2">ACTIVE REMINDER</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="m-2"><strong>{{ $student_total }}</strong></h5>
                                <p class="card-text mx-2">STUDENT TOTAL</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="m-2"><strong>{{ $course_total }}</strong></h5>
                                <p class="card-text mx-2">COURSE TOTAL</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="m-2"><strong>{{ $subject_total }}</strong></h5>
                                <p class="card-text mx-2">SUBJECT TOTAL</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="m-2"><strong>{{ $room_total }}</strong></h5>
                                <p class="card-text mx-2">ROOM TOTAL</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="m-2"><strong>{{ $instructor_total }}</strong></h5>
                                <p class="card-text mx-2">INSTRUCTOR TOTAL</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="m-2"><strong>{{ $schedule_total }}</strong></h5>
                                <p class="card-text mx-2">SCHEDULE TOTAL    </p>
                            </div>
                        </div>
                    </div>
                    <div class="col">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
