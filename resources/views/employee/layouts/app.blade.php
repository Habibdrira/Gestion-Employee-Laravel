<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/style.scss'])

    @yield('head')
</head>

<body>

    @include('employee.layouts.components.sidebar')

    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('employee.layouts.components.top-header')
        <div class="body flex-grow-1 px-3">
            <div class="container-lg">

                @include('employee.layouts.components.response')

                <!-- Error Section -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
        @include('employee.layouts.components.footer')
    </div>

    @vite(['resources/js/app.js'])
</body>

</html>
