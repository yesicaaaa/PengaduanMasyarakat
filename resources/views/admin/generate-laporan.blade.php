@extends('template')
@extends('side-navbar')
@section('css', '/css/content.css')
@section('sidenavcss', '/css/side-navbar.css')
@section('title', 'Generate Laporan | Pengaduan Masyarakat')
@section('content')
<div class="content">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Admin</li>
      <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-fw fa-users mr-2"></i> Generate Laporan</li>
    </ol>
  </nav>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tanggal Pengaduan</th>
        <th scope="col">Id Pengaduan</th>
        <th scope="col">Pengaduan</th>
        <th scope="col">Tanggal Tanggapan</th>
        <th scope="col">Isi Tanggapan</th>
        <th scope="col">Nama Petugas</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($isiLaporan as $l)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$l['tgl_pengaduan']}}</td>
        <td>{{$l['id_pengadu']}}</td>
        <td>{{$l['pengaduan']}}</td>
        @if($l['status'] == 'selesai')
        <td>{{$l['tgl_tanggapan']}}</td>
        <td>{{$l['isi_tanggapan']}}</td>
        <td>{{$l['nama_petugas']}}</td>
        @else
        <td>-</td>
        <td>-</td>
        <td>-</td>
        @endif
        <td>{{$l['status']}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection