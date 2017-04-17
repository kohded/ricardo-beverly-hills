<!doctype html>
<html lang="en">
<!--
Ricardo Beverly Hills - Parts, Repair, & Warranty Management System
@author Arnold Koh <arnold@kohded.com>
@author Chris Knoll <>
@author Peter Kim <peterlk.dev@gmail.com>
@version 1.0, developed 1/17/17
@url http://rbh.greenrivertech.net
-->
<head>
    {{--Meta--}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--Links--}}
    <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    {{--Title--}}
    <title>Ricardo Beverly Hills</title>
</head>
<body>
    {{--Nav--}}
    @include('partials.nav')

    {{--Content--}}
    <div class="container">
        @yield('content')
    </div>

    {{--Footer--}}
    @include('partials.footer')

    {{--Scripts--}}
    <script src="{{ URL::to('js/app.js') }}"></script>
</body>
</html>