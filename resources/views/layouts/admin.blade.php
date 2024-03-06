<!-- resources/views/layouts/admin.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Admin Dashboard</title>
    <!-- Add your stylesheets and scripts here -->
</head>
<body>
    <div id="sidebar">
        <ul>
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.users.index') }}">Users List</a></li>
            <li><a href="{{ route('admin.services.index') }}">Services</a></li>
            <li><a href="{{ route('admin.skills.index') }}">Skills</a></li>
            <li><a href="#">Jobs</a></li>
        </ul>
    </div>

    <div id="content">
        @yield('content')
    </div>
</body>
</html>
