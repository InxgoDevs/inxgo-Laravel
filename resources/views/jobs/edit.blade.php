<!-- resources/views/jobs/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Job</h2>

        <form action="{{ route('jobs.update', $job->id) }}" method="post">
            @csrf
            @method('PUT')

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ $job->title }}" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required>{{ $job->description }}</textarea>

            <label for="price_per_hour">Price per Hour:</label>
            <input type="number" name="price_per_hour" id="price_per_hour" step="0.01" value="{{ $job->price_per_hour }}" required>

            <label for="client_name">Client Name:</label>
            <input type="text" name="client_name" id="client_name" value="{{ $job->client_name }}" required>

            <button type="submit">Update Job</button>
        </form>

        <a href="{{ route('jobs.index') }}">Back to Jobs</a>
    </div>
@endsection
