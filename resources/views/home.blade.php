
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Client Dashboard</h2>
                <!-- Role Switch for Client to Seller -->
                <div class="mt-4">
                    <a href="{{ route('sellers.dashboard') }}" id="roleSwitch" target="blank"> Go To Seller Dashboard</a>
                </div>
                <!-- Client-specific content goes here -->
                <!-- Display all skills -->
                <div class="mb-4">
                    <h3>All Skills</h3>
                    <!-- Display all skills logic goes here -->
                    <ul>
                        @foreach($allSkills as $skill)
                            <li>{{ $skill->title }}</li>
                            <li><img src="{{ asset('storage/' . $skill->image) }}" style="max-width: 100px; max-height: 100px;"></li>
                        @endforeach
                    </ul>
                </div>
                <!-- Display active job cards -->
                <div class="mb-4">
                    <h3>Active Job Cards</h3>
                    <!-- Display active job cards logic goes here -->
                </div>

                <!-- Display the most recent job card -->
                <div>
                    <h3>Most Recent Job Card</h3>
                    <!-- Display most recent job card logic goes here -->
                </div>
                
            </div>
        </div>
    </div>
    <script>
        document.getElementById('roleSwitch').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior
            window.location.href = "{{ route('sellers.dashboard') }}";
        });
    </script>
@endsection
