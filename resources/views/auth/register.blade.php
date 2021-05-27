@extends('template')
@section('css', '/css/login-register.css')
@section('title', 'Register | Pengaduan Masyarakat')

@section('content')
<div class="container container-register">
    <h2>REGISTER</h2>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- name -->
        <div class="input-group flex-nowrap">
            <span class="input-group-text"><i class="fa fa-fw fa-user"></i></span>
            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="{{old('name')}}" autofocus>
        </div>

        <!-- Email Address -->
        <div class="input-group flex-nowrap">
            <span class="input-group-text"><i class="fa fa-fw fa-envelope"></i></span>
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}" autofocus>
        </div>

        <!-- telephone -->
        <div class="input-group flex-nowrap">
            <span class="input-group-text"><i class="fa fa-fw fa-phone"></i></span>
            <input type="text" class="form-control" name="telp" placeholder="No. Telepon" value="{{old('telp')}}" autofocus>
        </div>

        <!-- Password -->
        <div class="input-group flex-nowrap">
            <span class="input-group-text"><i class="fa fa-fw fa-key"></i></span>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>

        <!-- confirm Password -->
        <div class="input-group flex-nowrap">
            <span class="input-group-text"><i class="fa fa-fw fa-key"></i></span>
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-outline-blue">REGISTER</button>

            <a class="underline text-sm text-gray-600 hover:text-gray-900 not-register" href="{{ route('login') }}">
                {{ __('Already Registered?') }}
            </a>
        </div>
    </form>
    @endsection