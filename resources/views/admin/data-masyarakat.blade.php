@extends('template')
@extends('side-navbar')
@section('css', '/css/content.css')
@section('sidenavcss', '/css/side-navbar.css')
@section('title', 'Data Masyarakat | Pengaduan Masyarakat')
@section('content')
<div class="content">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Admin</li>
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-users mr-2"></i> Data Masyarakat</li>
    </ol>
  </nav>
  @if(session('status'))
  <div class="alert alert-success" role="alert">
    {{session('status')}}
  </div>
  @endif
  <a href="/trash" class="btn btn-success mb-3"><i class="fa fa-fw fa-archive"></i> Tempat Sampah</a>
  <a href="/export_excel_masyarakat" class="btn btn-warning mb-3"><i class="fa fa-fw fa-download"></i>Export Excel</a>
  <a href="/export_pdf_masyarakat" class="btn btn-danger mb-3"><i class="fa fa-fw fa-download"></i>Export PDF</a>
  <form action="/import_excel_masyarakat" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-1 importexcel">
      <label for="importExcel" class="form-label">Upload File Excel</label>
      <input type="file" class="form-control @error('file') is-invalid @enderror" id="importExcel" name="file">
      <div class="invalid-feedback">
        @error('file')
        {{$message}}
        @enderror
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
  </form>
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
      @foreach($masyarakat as $m)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$m->name}}</td>
        <td>{{$m->email}}</td>
        <td>{{$m->telp}}</td>
        <td>
          <a href="/soft-delete/{{$m->id}}" class="button-delete" onclick="return confirm('Apa kamu yakin?')"><i class="fa fa-fw fa-minus-circle"></i> Hapus</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection