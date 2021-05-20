@extends('template')
@extends('side-navbar')
@section('css', '/css/content.css')
@section('sidenavcss', '/css/side-navbar.css')
@section('title', 'Data Petugas | Pengaduan Masyarakat')
@section('content')
<div class="content">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Admin</li>
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-users mr-2"></i> Data Petugas</li>
    </ol>
  </nav>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Lengkap</th>
        <th scope="col">Email</th>
        <th scope="col">No. Telepon</th>
      </tr>
    </thead>
    <tbody>
      @foreach($petugas as $p)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$p->name}}</td>
        <td>{{$p->email}}</td>
        <td>{{$p->telp}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection