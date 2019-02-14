<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield ('title')</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    @section('stylesheets')
    @show
</head>
<body>
@section('body')
@show

@section('javascripts')
@show
</body>
</html>
