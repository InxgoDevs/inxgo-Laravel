<!-- resources/views/admin/skills/create.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Create Skill</h1>

    <!-- Add your skill creation form here -->
    <form action="{{ route('admin.skills.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Add form fields for title, image, and service_id -->

        <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*" class="form-control">
        </div>

        <div class="form-group">
        <label for="service_id">Service:</label>
        <select name="service_id" class="form-control">
            @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->title }}</option>
            @endforeach
        </select>
</div>
        <div class="form-group">
        <button type="submit" class="btn btn-primary">Create Skill</button>
    </div>
    </form>
@endsection
