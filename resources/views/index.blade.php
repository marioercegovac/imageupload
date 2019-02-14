@extends('layouts.app')
@section('title','Image Management')
@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('body')
    <div id="app">

        <button @click="logout">Logout</button>
        <form class="card" enctype="multipart/form-data">
            <span class="title">Image file:</span>

            <div class="custom-file">
                <input type="file" class="custom-file-input" accept=".jpg, .jpeg, .svg ,.gif, .bmp"
                       @change="changeInputDisplay($event)" formenctype="">
                <label class="custom-file-label">Choose a file</label>
            </div>
            <button type="button" :class="['btn btn-success',{'disabled': errors.length > 0 || isUploading}]" @click="uploadImage"><i
                        class="fe fe-upload mr-2"></i>Upload image
            </button>
        </form>
    </div>
@endsection

    @section('javascripts')
        <script src="{{ asset('js/index.js') }}"></script>
@endsection

