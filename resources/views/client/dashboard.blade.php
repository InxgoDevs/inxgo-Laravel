@extends('layouts.app')
 <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <h2>Client Dashboard</h2>
                <!-- Role Switch for Client to Seller -->
                <div class="mt-4">
                    <a href="{{ route('seller.dashboard') }}" target="_blank">Go To Seller Dashboard</a>
                </div>
                <!-- Client-specific content goes here -->
                <!-- Display all skills -->
                
              <!-- Display all skills logic goes here -->
<div class="mb-4">
    <h3>All Skills</h3>
    <div class="row">
        @foreach($allSkills as $skill)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $skill->image) }}" class="card-img-top img-fluid" alt="{{ $skill->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $skill->title }}</h5>
<button onclick="sendJobRequest({{ $skill->id }})">Request Service</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
    </div>
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
    <button id="statusButton" onclick="toggleStatus()">You're Offline</button>
    <div id="map"></div>

<!-- resources/views/client/dashboard.blade.php -->

<!-- Add a button or link to send a job request -->
<button onclick="sendJobRequest()">Request Service</button>
<!-- Include Axios library -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

// Initialize the map
function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 0, lng: 0 },
        zoom: 15,
    });

    // Try HTML5 geolocation
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                // Center the map on the user's current position
                map.setCenter(pos);

                // Add a marker at the user's current position
                const marker = new google.maps.Marker({
                    position: pos,
                    map,
                    title: "Your Location",
                });

                // Display latitude and longitude
                const infoWindow = new google.maps.InfoWindow();
                infoWindow.setContent(
                    `<div>Latitude: ${pos.lat}<br>Longitude: ${pos.lng}</div>`
                );
                infoWindow.open(map, marker);

                // Use Roads API to snap user's location to the nearest road
                fetchRoadsAPI(pos);
            },
            () => {
                handleLocationError(true, map.getCenter());
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, map.getCenter());
    }
}

// Handle geolocation errors
function handleLocationError(browserHasGeolocation, pos) {
    const infoWindow = new google.maps.InfoWindow();
    infoWindow.setPosition(pos);
    infoWindow.setContent(
        browserHasGeolocation
            ? "Error: The Geolocation service failed." 
            : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
}

// Function to fetch Roads API to snap user's location to the nearest road
function fetchRoadsAPI(pos) {
    const API_KEY = "AIzaSyBKjOHzobT8EVo_kGpLYgapvOabh-yRVzQ";
    const url = `https://roads.googleapis.com/v1/snapToRoads?path=${pos.lat},${pos.lng}&key=${API_KEY}`;
    
    fetch(url)
        .then(response => response.json())
        .then(data => {
            // Handle snapped location data (data will contain the snapped coordinates)
            console.log(data);
        })
        .catch(error => console.error("Error fetching Roads API:", error));
}
let status = "offline"; // Initial status

function toggleStatus() {
    const button = document.getElementById("statusButton");
    if (status === "offline") {
        status = "online";
        button.textContent = "You're Online";
        button.style.backgroundColor = "green";
        fetchLiveLocation();
    } else {
        status = "offline";
        button.textContent = "You're Offline";
        button.style.backgroundColor = "Black"; // Reset button color
        // Stop fetching live location if needed
    }
}

function fetchLiveLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            position => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const mapDiv = document.getElementById("map");
                mapDiv.innerHTML = `<p>Your live location: Latitude ${latitude}, Longitude ${longitude}</p>`;
                // Display live location on map or perform additional actions
            },
            error => {
                console.error("Error getting location:", error.message);
                // Handle error gracefully
            }
        );
    } else {
        console.error("Geolocation not supported");
        // Notify user that geolocation is not supported
    }
}


</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function sendJobRequest(skillId) {
        // Show confirmation popup
        if (confirm('Are you sure you want to send a request for this service?')) {
            // If user confirms, make AJAX request to send job request
            axios.post('/send-job-request', { skill_id: skillId })
                .then(response => {
                    // Display success message
                    alert('Email sent successfully');
                })
                .catch(error => {
                    console.error(error);
                    // Handle errors and update the UI
                    alert('Failed to send email. Please try again later.');
                });
        }
    }
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKjOHzobT8EVo_kGpLYgapvOabh-yRVzQ&libraries=places"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAdbeTaoMAEa2osUF4TnKmi5_85Ed_SZI&libraries=places&callback=initMap" async defer></script>

    

@endsection
