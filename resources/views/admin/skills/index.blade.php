
<!-- resources/views/admin/skills/index.blade.php -->

@extends('layouts.admin')

@section('content')
    <h1>Skills</h1>
    <a href="{{ route('admin.skills.create') }}" class="btn btn-primary">Create Skill</a>

    <!-- Display skills table or list here -->
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Service</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($skills as $skill)
                <tr>
                    <td>{{ $skill->title }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $skill->image) }}" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td>{{ $skill->service->title }}</td>
                    <td>
                        <!-- Add actions such as edit and delete buttons with appropriate links -->
                        <a href="{{ route('admin.skills.edit', $skill->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection 

