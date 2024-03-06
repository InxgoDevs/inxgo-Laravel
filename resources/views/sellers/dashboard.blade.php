@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Seller Dashboard</h2>

                <!-- Seller-specific content goes here -->
                <!-- Display selected skills -->
                <!-- Display selected skills -->
<div class="mb-4">
    <h3>My Skills</h3>
    @if(count($userSkills) > 0)
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
</div>


                <!-- Display active job cards -->
                <div class="mb-4">
                    <h3>Active Job</h3>
                    <!-- Display active job cards logic goes here -->
                </div>

                <!-- Display the most recent job card -->
                <div>
                    <h3>Most Recent Job</h3>
                    <!-- Display most recent job card logic goes here -->
                </div>
    
                <!-- Role Switch for Seller to Client -->
                <div class="mt-4">
                    <label class="form-check-label">
                        <input type="checkbox" id="roleSwitch">
                        Go To Client Dashboard
                    </label>
                </div>
                <div id="notification-container"></div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('roleSwitch').addEventListener('change', function() {
            if (this.checked) {
                window.location.href = "{{ route('client.dashboard') }}";
            }
        });
    </script>
    <!-- Add this script in your client.dashboard.blade.php and seller.dashboard.blade.php views -->
<script>
    document.getElementById('roleSwitch').addEventListener('change', function() {
        var sellerDashboard = document.getElementById('sellerDashboard');
        var clientDashboard = document.getElementById('clientDashboard');

        if (this.checked) {
            sellerDashboard.style.display = 'block';
            clientDashboard.style.display = 'none';
        } else {
            sellerDashboard.style.display = 'none';
            clientDashboard.style.display = 'block';
        }
    });
</script>
<script> // In your seller dashboard JavaScript
function sendJobRequestToServer() {
  // Implement logic to send the job request to the server
  fetch('/api/handle-fcm', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ /* your FCM message data */ }),
  });
}
</script>


@endsection
