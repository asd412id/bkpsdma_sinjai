<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style media="screen">
      .table{
        width: 100%;
        text-align: left;
        border-spacing: 0;
        border-collapse: collapse;
      }
      th,td{
        padding: 3px 7px;
        border: solid 1px #000 !important;
      }
      th{
        text-align: center;
        background: rgba(0,0,0,.1);
      }
      html,body{
        width: 100%;
        margin: 15px;
        font-size: 0.93em;
        font-family: DejaVu Sans;
      }
    </style>
  </head>
  <body>
    <center><h2>Daftar Pegawai Aparatur Sipil Negara</h2></center>
    <table class="table">
      <tr>
        <th>NO</th>
        <th>NIP</th>
        <th>NAMA</th>
        <th>JENIS KELAMIN</th>
        <th>PANGKAT/GOLONGAN</th>
        <th>INSTANSI</th>
      </tr>
      @foreach ($data as $key => $d)
        <tr>
          <td align="center">{{ $key+1 }}</td>
          <td>{{ $d->nip_baru }}</td>
          <td>{{ $d->nama }}</td>
          <td align="center">{{ $d->jenis_kelamin==1?'Pria':'Wanita' }}</td>
          <td align="center">{{ $d->golongan }}</td>
          <td>{{ $d->instansi }}</td>
        </tr>
      @endforeach
    </table>
  </body>
</html>
