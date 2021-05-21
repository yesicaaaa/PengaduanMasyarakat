<nav class="navbar navbar-expand-lg navbar-light bg-blue sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/dashboard">Pengaduan Masyarakat</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    </ul>
  </div>
  <div class="dropdown">
    <button class="dropdown-toggle" id="dropdownlogout" data-bs-toggle="dropdown" aria-expanded="false">
      {{ Auth::user()->name }}
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownlogout">
      <li><a class="dropdown-item" href="/logout"><i class="fa fa-arrow-left"></i> Logout</a></li>
    </ul>
  </div>
  <div class="sidenav">
    <ul class="sidemenu">
      @if(Auth::user()->hasRole('admin'))
      <li><a href="/data_masyarakat" class="menu"><i class="fa fa-fw fa-users"></i> Data Masyarakat</a></li>
      <div class="divider"></div>
      <li><a href="/data_petugas" class="menu"><i class="fa fa-fw fa-users"></i> Data Petugas</a></li>
      <div class="divider"></div>
      @endif
      @if(Auth::user()->hasRole('admin'))
      <li><a href="/beri_tanggapan_view_admin" class="menu"><i class="fa fa-fw fa-edit"></i> Beri Tanggapan</a></li>
      <div class="divider"></div>
      @endif
      @if(Auth::user()->hasRole('petugas'))
      <li><a href="/beri_tanggapan_view_petugas" class="menu"><i class="fa fa-fw fa-edit"></i> Beri Tanggapan</a></li>
      <div class="divider"></div>
      @endif
      @if(Auth::user()->hasRole('admin'))
      <li><a href="/generate_laporan" class="menu"><i class="fa fa-fw fa-file"></i> Generate Laporan</a></li>
      <div class="divider"></div>
      @endif
      @if(Auth::user()->hasRole('masyarakat'))
      <li><a href="/form_pengaduan" class="menu"><i class="fa fa-fw fa-edit"></i> Form Pengaduan</a></li>
      <div class="divider"></div>
      <li><a href="/pengaduan_saya" class="menu"><i class="fa fa-fw fa-file"></i> Pengaduan Saya</a></li>
      <div class="divider"></div>
      @endif
    </ul>
  </div>
</nav>