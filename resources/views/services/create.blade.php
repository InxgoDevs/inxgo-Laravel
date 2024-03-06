<@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Service</h2>

    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
