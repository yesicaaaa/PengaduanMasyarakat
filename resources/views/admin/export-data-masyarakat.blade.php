<h3>Data Masyarakat</h3>
<table>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Lengkap</th>
      <th scope="col">Email</th>
      <th scope="col">No. Telepon</th>
    </tr>
  </thead>
  <tbody>
    @foreach($masyarakat as $m)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$m->name}}</td>
      <td>{{$m->email}}</td>
      <td>{{$m->telp}}</td>
    </tr>
    @endforeach
  </tbody>
</table>