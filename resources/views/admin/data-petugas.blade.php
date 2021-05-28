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
  <a href="/tambah_petugas" class="btn btn-success mb-3"><i class="fa fa-fw fa-plus"></i> Tambah Petugas</a>
  <a href="/trash_petugas" class="btn btn-primary mb-3"><i class="fa fa-fw fa-archive"></i> Tempat Sampah</a>
  <a href="/export_excel_petugas" class="btn btn-warning mb-3"><i class="fa fa-fw fa-download"></i>Export Excel</a>
  <a href="/export_pdf_petugas" class="btn btn-danger mb-3"><i class="fa fa-fw fa-download"></i>Export PDF</a>
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
      @foreach($petugas as $p)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$p->name}}</td>
        <td>{{$p->email}}</td>
        <td>{{$p->telp}}</td>
        <td>
          <a href="/soft_delete_petugas/{{$p->id}}" class="button-delete" onclick="return confirm('Apa kamu yakin?')"><i class="fa fa-fw fa-minus-circle"></i> Hapus</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection