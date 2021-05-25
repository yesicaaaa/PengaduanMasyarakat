@extends('template')
@extends('side-navbar')
@section('css', '/css/content.css')
@section('sidenavcss', '/css/side-navbar.css')
@section('title', 'Beri Tanggapan | Pengaduan Masyarakat')
@section('content')
<div class="content">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Admin</li>
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-users mr-2"></i> Beri Tanggapan</li>
    </ol>
  </nav>
  @if(session('status'))
  <div class="alert alert-success" role="alert">
    {{session('status')}}
  </div>
  @endif
  @foreach($pengaduan as $p)
  <h5>Pengaduan Masyarakat</h5>
  <div class="card mb-3 card-pengaduan">
    <div class="row g-0">
      <div class="col-md-4">
        <img class="img-pengaduan" src="/img/pengaduan_img/{{$p->foto}}" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body ml-body-card">
          <h5 class="card-title">{{$p->name}}</h5>
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
        <form action="/kirim_tanggapan_admin" method="POST">
          @csrf
          @if($p->status == 'proses')
          <textarea type="text" name="tanggapan" id="tanggapan" cols="30" rows="10"></textarea>
          @endif
          <input type="hidden" name="id_pengaduan" value="{{$p->id_pengaduan}} ">
          <input type="hidden" name="tgl_tanggapan" value="<?php echo date('Y-m-d'); ?>">
          @foreach($tanggapan as $t)
          @if($p->id_pengaduan == $t->id_pengaduan)
          <textarea id="tanggapan" cols="30" rows="10" disabled>{{$t->tanggapan}}</textarea>
          <p class="card-text"><small class="text-muted">{{$t->tgl_tanggapan}}</small></p>
          @endif
          @endforeach
          <input type="hidden" name="id_petugas" value="{{Auth::user()->id}}">
          <input type="hidden" name="status" value="selesai">
          @if($p->status == 'proses')
          <button type="submit" class="btn btn-primary btn-tanggapan">Kirim</button>
          @endif
        </form>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection