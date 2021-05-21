@extends('template')
@extends('side-navbar')
@section('css', '/css/content.css')
@section('sidenavcss', '/css/side-navbar.css')
@section('title', 'Pengaduan Saya | Pengaduan Masyarakat')
@section('content')
<div class="content">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Masyarakat</li>
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-users mr-2"></i> Pengaduan Saya</li>
    </ol>
  </nav>
  @if(session('status'))
  <div class="alert alert-success" role="alert">
    {{session('status')}}
  </div>
  @endif
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tanggal Pengaduan</th>
        <th scope="col">Isi Laporan</th>
        <th scope="col">Foto</th>
        <th scope="col">Status</th>
        <th scope="col">Tanggapan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pengaduan as $p)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$p->tgl_pengaduan}}</td>
        <td>{{$p->isi_laporan}}</td>
        <td><img class="foto-pengaduan" src="/img/pengaduan_img/{{$p->foto}}" alt="foto"></td>
        <td>{{$p->status}}</td>
        <td><a href="/tanggapan_pengaduan/{{$p->id_pengaduan}}" class="badge bg-success">Lihat</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection