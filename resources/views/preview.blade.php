@extends('layouts.app')
@section('title','Image Management')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('body')
    <div id="app">
        <div class="card imageWrapper" style="background-image: url('{{ asset($image) }}')"></div>
    </div>
@endsection

    @section('javascripts')
        {{--<script src="{{ asset('js/preview.js') }}"></script>--}}
@endsection

