@extends('layouts.app')
@section('title','Random Question')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('body')
    <div id="app" class="loginView" v-cloak>
           <span class="title">
            Hi there, please log in to continue.
        </span>
        <co-login></co-login>
    </div>
@endsection
@section('javascripts')
    <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
@endsection