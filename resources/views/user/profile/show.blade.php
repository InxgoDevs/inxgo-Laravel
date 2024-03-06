@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Profile</h1>
        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image">
        <p>Name: {{ $user->name }}</p>
        <p>Hourly Rate: {{$user->hourly_rate }}</p>
        <p>Self Introduction: {{ $user->self_introduction }}</p>

       @if(count($userSkills) > 0)
    <h2>Skills:</h2>
    <ul>
        {{-- Iterate over the skills --}}
        @foreach($userSkills as $skill)
            <li>{{ $skill->name }}</li>

            {{-- Display skill image --}}
            @if($skill->image)
                <img src="{{ asset('storage/' . $skill->image) }}" alt="{{ $skill->title }}">
            @else
                <p>No image available for this skill</p>
            @endif
        @endforeach
    </ul>
@else
    <p>No skills available.</p>
@endif


        <h2>Portfolio:</h2>
        @foreach($user->portfolio as $portfolio)
            <div>
                <p>Title: {{ $portfolio->title }}</p>
                <img src="{{ asset('storage/' . $portfolio->image) }}" alt="Portfolio Image">
            </div>
        @endforeach

        <!-- Display other user profile details here -->
        <a href="{{ route('user.profile.edit') }}">Edit Profile</a>
    </div>
@endsection
