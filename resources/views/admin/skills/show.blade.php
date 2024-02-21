<!-- resources/views/admin/skills/show.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Skill Details</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Skill: {{ $skill->title }}</h5>
                <!-- Add other skill details here -->
            </div>
        </div>

        <a href="{{ route('skills.index') }}" class="btn btn-primary mt-3">Back to Skills</a>
    </div>
@endsection
