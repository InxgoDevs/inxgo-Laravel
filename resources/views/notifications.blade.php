@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Notifications</h1>
        <ul>
            @foreach($notifications as $notification)
                <li>
                    @if (isset($notification['type']) && $notification['type'] === 'welcome')
                        <!-- Display welcome notification -->
                        Welcome {{ $notification['user_name'] }} to Inxgo <!-- Removed the extra 'd' -->
                    @else
                        <!-- Display other types of notifications -->
                        {{ $notification['actor'] }} {{ $notification['verb'] }}d a {{ $notification['object'] }}
                    @endif

                    <small>{{ $notification['time'] }}</small>
                </li>

                 <ul>
            @forelse($notifications as $notification)
                @if (isset($notification['type']) && $notification['type'] === 'job_request')
                    <li>
                        <strong>{{ $notification['actor'] }}</strong> sent a job request for {{ $notification['object'] }}.
                        <small>{{ $notification['time'] }}</small>
                    </li>
                @endif
            @empty
                <li>No new job request notifications.</li>
            @endforelse
        </ul>

            @endforeach
        </ul>
       
    </div>
@endsection