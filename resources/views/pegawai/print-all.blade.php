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
        font-size: 0.91em;
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
        <th>PANGKAT/GOL.</th>
        <th>JABATAN</th>
        <th>INSTANSI</th>
        <th>INSTANSI INDUK</th>
        <th>STATUS</th>
      </tr>
      @foreach ($data as $key => $d)
        <tr>
          <td align="center">{{ $key+1 }}</td>
          <td>{{ $d->nip_baru }}</td>
          <td style="width: 150px !important">{{ $d->gelar_depan.' '.$d->nama.($d->gelar_belakang?', '.$d->gelar_belakang:'') }}</td>
          <td align="center">{{ $d->jenis_kelamin==1?'Pria':'Wanita' }}</td>
          <td align="center">{{ $d->golongan }}</td>
          <td>{{ $d->jabatan }}</td>
          <td>{{ $d->instansi }}</td>
          <td>{{ $d->instansi_induk }}</td>
          <td align="center">{{ $d->status }}</td>
        </tr>
      @endforeach
    </table>
  </body>
</html>
