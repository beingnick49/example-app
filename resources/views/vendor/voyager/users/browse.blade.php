@extends('voyager::master')
@section('javascript')
    @viteReactRefresh
    @vite('resources/js/app.jsx')
@endsection
@section('content')
    <div id="root"></div>
@endsection
