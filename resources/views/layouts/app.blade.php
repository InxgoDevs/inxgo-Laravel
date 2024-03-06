<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
<!-- Include Socket.IO client library -->
<script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>

 <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

<!-- Your existing seller dashboard content -->

<script>
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyDq5B7ha-YkB0fqd6yLHFR9iYEVbUeQyxk",
            authDomain: "peoplei-52037.firebaseapp.com",
            projectId: "peoplei-52037",
            storageBucket: "peoplei-52037.appspot.com",
            messagingSenderId: "1013653212406",
            appId: "1:1013653212406:web:561088faa0ce44f1deb0d7",
            measurementId: "G-QDMF8389HX"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
            messaging.requestPermission().then(function () {
                return messaging.getToken()
            }).then(function(token) {
                
                axios.post("{{ route('fcmToken') }}",{
                    _method:"PATCH",
                    token
                }).then(({data})=>{
                    console.log(data)
                }).catch(({response:{data}})=>{
                    console.error(data)
                })

            }).catch(function (err) {
                console.log(`Token Error :: ${err}`);
            });
        }

        initFirebaseMessagingRegistration();
      
        messaging.onMessage(function({data:{body,title}}){
            new Notification(title, {body});
        });
  // Initialize Firebase Messaging
  
</script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <!-- Right Side Of Navbar -->
<ul class="navbar-nav ms-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.profile.show') }}">Profile</a>
        </li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="notifications" id="notificationsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Notifications
        <!-- Display the count of unread notifications if needed -->
        <span id="notificationCount" class="badge badge-danger"></span>
    </a>
    <div class="dropdown-menu" aria-labelledby="notificationsDropdown" id="notificationsContainer">
        <!-- Notifications will be dynamically added here -->
    </div>
</li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
<ul class="nav nav-tabs">
    <!-- Existing navigation links... -->

    <li class="nav-item">
        <a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a>
    </li>

</ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>


</html>
