<!-- resources/views/jobs/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Job</h2>

        <form action="{{ route('jobs.store') }}" method="post">
            @csrf
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>

            <label for="price_per_hour">Price per Hour:</label>
            <input type="number" name="price_per_hour" id="price_per_hour" step="0.01" required>

            <label for="client_name">Client Name:</label>
            <input type="text" name="client_name" id="client_name" required>

            <button type="submit">Create Job</button>
        </form>
    </div>
@endsection
