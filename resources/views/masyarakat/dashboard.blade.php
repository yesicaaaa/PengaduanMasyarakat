@extends('template')
@extends('side-navbar')
@section('sidenavcss', '/css/side-navbar.css')
@section('content')
@if(session('status'))
<div class="alert alert-success" role="alert">
    {{session('status')}}
</div>
@endif
@endsection