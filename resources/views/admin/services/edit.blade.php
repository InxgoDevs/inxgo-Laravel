@extends('layouts.admin')

@section('content')
    <h2>Edit Service</h2>

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $service->title }}" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control-file" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Update Service</button>
    </form>
@endsection
