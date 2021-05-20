@extends('template')
@extends('side-navbar')
@section('css', '/css/content.css')
@section('sidenavcss', '/css/side-navbar.css')
@section('title', 'Form Pengaduan | Pengaduan Masyarakat')
@section('content')
<div class="content">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Masyarakat</li>
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-edit mr-2"></i> Form Pengaduan</li>
    </ol>
  </nav>
  <div class="card">
    <div class="card-body">
      <form action="/proses_pengaduan" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="tgl_pengaduan" class="form-label">Tanggal Pengaduan</label>
          <input type="date" class="form-control" id="tgl_pengaduan" name="tgl_pengaduan">
        </div>
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" name="nama">
        </div>
        <div class="mb-3">
          <label for="isi_laporan" class="form-label">Tulis Laporan</label>
          <textarea type="date" class="form-control" id="isi_laporan" name="isi_laporan"></textarea>
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Upload Foto Diri</label>
          <input type="file" class="form-control" id="foto" name="foto">
        </div>
        <input type="hidden" name="status" value="proses">
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection