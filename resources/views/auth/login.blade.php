@extends('template')
@section('css', '/css/login-register.css')
@section('title', 'Login | Pengaduan Masyarakat')

@section('content')
<div class="container container-login">
    <h2>LOGIN</h2>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="input-group flex-nowrap">
            <span class="input-group-text"><i class="fa fa-fw fa-user"></i></span>
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}" autofocus>
        </div>

        <!-- Password -->
        <div class="input-group flex-nowrap">
            <span class="input-group-text"><i class="fa fa-fw fa-key"></i></span>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-outline-blue">LOGIN</button>

            <a class="underline text-sm text-gray-600 hover:text-gray-900 not-register" href="{{ route('register') }}">
                {{ __('Not Registered Yet?') }}
            </a>
        </div>
    </form>
    @endsection