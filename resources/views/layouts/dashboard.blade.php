<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts and Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Additional styles if needed -->

    <style>

        .layout-wrapper {

            display: flex;
            height: 100vh;

        }

        .sidebar {

            width: 70px;
            background-color: #343a40;

        }

        .content-wrapper {

            flex-grow: 1;
            padding: 20px;

        }

        .navbar {

            background-color: #f8f9fa;

        }

        .navbar-brand {

            display: flex;
            align-items: center;

        }

        .navbar-brand img {

            margin-right: 10px;

        }

        .navbar-nav .nav-link {

            color: #343a40;

        }

        .navbar-nav .nav-link img {

            margin-left: 10px;

        }

    </style>

</head>

<body>

    <div id="app" class="layout-wrapper">
        @include('include.sidebar') <!-- Including the sidebar partial -->
        <div class="content-wrapper">
            @include('include.navbar') <!-- Including the header partial -->
            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>