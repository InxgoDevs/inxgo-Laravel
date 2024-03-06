<!-- resources/views/admin/users.blade.php -->

@extends('layouts.admin')

@section('content')
    <h2>Users List</h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <!-- Add more columns if needed -->
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <!-- Add more columns if needed -->
                </tr>
            @empty
                <tr>
                    <td colspan="3">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
