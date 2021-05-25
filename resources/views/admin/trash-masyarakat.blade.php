@extends('template')
@extends('side-navbar')
@section('css', '/css/content.css')
@section('sidenavcss', '/css/side-navbar.css')
@section('title', 'Tempat Sampah | Pengaduan Masyarakat')
@section('content')
<div class="content">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-archive mr-2"></i> Tempat Sampah</li>
    </ol>
  </nav>
  <a href="/delete_permanent" class="btn btn-danger mb-3"><i class="fa fa-fw fa-minus-circle"></i> Hapus Permanen Semua</a>
  <a href="/restore_all" class="btn btn-success mb-3"><i class="fa fa-fw fa-plus-circle"></i> Pulihkan Semua</a>
  @if(session('status'))
  <div class="alert alert-success" role="alert">
    {{session('status')}}
  </div>
  @endif
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Lengkap</th>
        <th scope="col">Email</th>
        <th scope="col">No. Telepon</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($user as $u)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$u->name}}</td>
        <td>{{$u->email}}</td>
        <td>{{$u->telp}}</td>
        <td>
          <a href="/restore/{{$u->id}}" class="button-pulihkan"><i class="fa fa-fw fa-plus-circle"></i> Pulihkan</a>
          <a href="/delete/{{$u->id}}" class="button-delete"><i class="fa fa-fw fa-minus-circle"></i> Hapus</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection