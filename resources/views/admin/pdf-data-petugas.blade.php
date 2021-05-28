<h3>Data Petugas</h3>
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Lengkap</th>
        <th scope="col">Email</th>
        <th scope="col">No. Telepon</th>
      </tr>
    </thead>
    <tbody>
      @foreach($petugas as $p)
      <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$p->name}}</td>
        <td>{{$p->email}}</td>
        <td>{{$p->telp}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>