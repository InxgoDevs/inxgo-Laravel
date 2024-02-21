<!-- resources/views/jobs/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
       <h2>{{ $job->title }}</h2>

        <p>Description: {{ $job->description }}</p>
        <p>Price per Hour: ${{ $job->price_per_hour }}</p>
        <p>Client Name: {{ $job->client_name }}</p>

        <!-- Add other job details as needed -->

        <a href="{{ route('jobs.index') }}">Back to Jobs</a>
    </div>
@endsection
