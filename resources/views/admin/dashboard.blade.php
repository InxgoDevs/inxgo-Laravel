<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <h5 class="card-title">Welcome, {{ auth()->user()->name }}!</h5>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Display link to admin dashboard for admin users --}}
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <p class="card-text">You are logged in as an Admin.</p>
                        <hr>

                        <!-- Display total number of skills and services in card UI design -->
                         <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text">{{ $totalSkills }}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Skills</h5>
                                <p class="card-text">{{ $totalSkills }}</p>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="card-title">Total Services</h5>
                                <p class="card-text">{{ $totalServices }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
