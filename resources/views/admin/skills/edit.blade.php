<!-- resources/views/admin/skills/edit.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Edit Skill</h1>

    <!-- Add your skill edit form here -->
    <form action="{{ route('admin.skills.update', $skill->id) }}" method="post">
        @csrf
        @method('put')
        <!-- Add form fields for title, image, and service_id with pre-filled values -->
        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ $skill->title }}" required>
        
        <label for="image">Image:</label>
        <input type="file" name="image" accept="image/*">
        
        <label for="service_id">Service:</label>
        <select name="service_id" required>
            @foreach($services as $service)
                <option value="{{ $service->id }}" {{ $skill->service_id == $service->id ? 'selected' : '' }}>
                    {{ $service->title }}
                </option>
            @endforeach
        </select>

        <button type="submit">Update Skill</button>
    </form>
@endsection
