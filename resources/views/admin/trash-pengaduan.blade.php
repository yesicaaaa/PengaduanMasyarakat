@extends('template')
@extends('side-navbar')
@section('css', '/css/content.css')
@section('sidenavcss', '/css/side-navbar.css')
@section('title', 'Tempat Sampah | Pengaduan Masyarakat')
@section('content')
<div class="content">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item ">Admin</li>
      <li class="breadcrumb-item active" aria-current="page"><a href="/beri_tanggapan_view_admin"><i class="fa fa-fw fa-edit mr-2"></i> Beri Tanggapan</a></li>
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-archive mr-2"></i> Tempat Sampah</li>
    </ol>
  </nav>
  <a href="/all_delete_permanent_pengaduan" class="btn btn-danger mb-3" onclick="return confirm('Apa kamu yakin?')"><i class="fa fa-fw fa-minus-circle"></i> Hapus Permanen Semua</a>
  <a href="/restore_all_pengaduan" class="btn btn-success mb-3"><i class="fa fa-fw fa-plus-circle"></i> Pulihkan Semua</a>
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
        <th scope="col">Nama Pengadu</th>
        <th scope="col">Isi Laporan</th>
        <th scope="col">Foto</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pengaduan as $p)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$p->tgl_pengaduan}}</td>
        <td>{{$p->name}}</td>
        <td>{{$p->isi_laporan}}</td>
        <td><img src="img/pengaduan_img/{{$p->foto}}" alt="foto" class="foto-pengaduan"></td>
        <td>{{$p->status}}</td>
        <td>
          <a href="/restore_pengaduan/{{$p->id_pengaduan}}" class="button-pulihkan"><i class="fa fa-fw fa-plus-circle"></i> Pulihkan</a>
          <a href="/delete_permanent_pengaduan/{{$p->id_pengaduan}}" class="button-delete" onclick="return confirm('Apa kamu yakin?')"><i class="fa fa-fw fa-minus-circle"></i> Hapus</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection