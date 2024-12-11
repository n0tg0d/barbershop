<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Add your custom CSS or assets -->
    @include('layouts.partials.head')
    @livewireStyles
</head>

<body>
    <!-- Custom Navbar -->
    @include('layouts.partials.header')

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    <!-- Footer -->
    @include('layouts.partials.footer')


    @livewireScripts
    @include('layouts.partials.scripts')
</body>

</html>
