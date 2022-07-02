<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Poliklinika Miraculum</title>
    @yield('css')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    

</head>
<div id='container'>

    <body>
        @include('partials.navbar')
        <div class="wrapper">
            @yield('content')
        </div>
        @yield('js')
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/caaf290004.js" crossorigin="anonymous"></script>
    </body>
</div>

</html>