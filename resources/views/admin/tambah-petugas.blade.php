@extends('template')
@extends('side-navbar')
@section('css', '/css/content.css')
@section('sidenavcss', '/css/side-navbar.css')
@section('title', 'Tambah Petugas | Pengaduan Masyarakat')
@section('content')
<div class="content">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Admin</li>
      <li class="breadcrumb-item active" aria-current="page"><a href="/data_petugas"><i class="fa fa-fw fa-user mr-2"></i> Data Petugas</a></li>
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-plus mr-2"></i> Tambah Petugas</li>
    </ol>
  </nav>
  <div class="card">
    <div class="card-body">
      <form action="/proses_tambah_petugas" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
          <div class="invalid-feedback">
            @error('name')
            {{$message}}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}">
          <div class="invalid-feedback">
            @error('email')
            {{$message}}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="telp" class="form-label">No. Telepon</label>
          <input type="text" class="form-control @error('telp') is-invalid @enderror" onkeypress="return event.charCode >= 48 && event.charCode <=57" id="telp" name="telp" value="{{old('telp')}}">
          <div class="invalid-feedback">
            @error('telp')
            {{$message}}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
          <div class="invalid-feedback">
            @error('password')
            {{$message}}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="confirm_password" class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password">
          <div class="invalid-feedback">
            @error('confirm_password')
            {{$message}}
            @enderror
          </div>
        </div>
        <button type="submit" class="btn btn-success">Tambah</button>
      </form>
    </div>
  </div>
</div>
@endsection