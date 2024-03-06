@extends('layouts.admin')

@section('content')
    <h2>Create Service</h2>

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Service</button>
    </form>
@endsection
