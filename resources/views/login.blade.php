@extends('layouts.app')
@section('title', 'CLASS REMINDER - LOGIN')
@section('content')

    <div class="container-fluid login-container">
        <div class="d-flex  justify-content-center align-items-center">
            <div class="card rounded-4 c-custom">

                <div class="card-body ">
                    <h2 class="card-title mt-3 mb-5 text-center"><strong>CLASS REMINDER</strong></h2>
                    @livewire('auth.custom-login')
                </div>
            </div>
        </div>

    </div>
@endsection
