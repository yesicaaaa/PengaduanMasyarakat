@extends('template')
@extends('side-navbar')
@section('css', '/css/content.css')
@section('sidenavcss', '/css/side-navbar.css')
@section('title', 'Tanggapan | Pengaduan Masyarakat')
@section('content')
<div class="content">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Masyarakat</li>
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-users mr-2"></i> Tanggapan Pengaduan</li>
    </ol>
  </nav>
  <h5>Pengaduan Saya</h5>
  @foreach($pengaduan as $p)
  <div class="card mb-3 card-pengaduan">
    <div class="row g-0">
      <div class="col-md-4">
        <img class="img-pengaduan" src="/img/pengaduan_img/{{$p->foto}}" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body ml-body-card">
          <h5 class="card-title">{{Auth::user()->name}}</h5>
          <p class="card-text">{{$p->isi_laporan}}</p>
        </div>
      </div>
    </div>
  </div>
  <p class="card-text tgl-pengaduan"><small class="text-muted">{{$p->tgl_pengaduan}}</small></p>
  <div class="body-tanggapan">
    <h5 class="tanggapan-title">Tanggapan</h5>
    <div class="card mb-3 card-tanggapan">
      <div class="col-md">
        <div class="card-body">
          @if($p->status == 'selesai')
          @foreach($tanggapan as $t)
          <p class="card-text">{{$t->tanggapan}}</p>
          @endforeach
          @endif
          @if($p->status == 'proses')
          <p class="card-text">Pengaduan belum ditanggapi</p>
          @endif
        </div>
      </div>
    </div>
    <p class="card-text tgl-tanggapan"><small class="text-muted">{{$t->tgl_tanggapan}}</small></p>
  </div>
  @endforeach
</div>
@endsection