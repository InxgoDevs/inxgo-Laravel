
@extends('layouts.admin')

@section('content')
    <h2>Service List</h2>
    <a href="{{ route('services.create') }}" class="btn btn-primary">Create Service</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->title }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}">
                    </td>
                    <td>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('services.show', $service->id) }}" class="btn btn-info">View</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


