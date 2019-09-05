<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style media="screen">
      html,body{
        font-family: 'DejaVu sans';
      }
      .wrapper{
        width: 100%;
        margin-bottom: 10px;
        clear: both;
      }
      .table{
        width: 100% !important;
        text-align: left;
        border-spacing: 0;
        border-collapse: collapse;
      }
      th,td{
        padding: 3px 7px;
        border: solid 1px #000 !important;
      }
      .wrapper-left{
        width: 100%;
        margin-bottom: 10px;
        /* display: inline-block; */
      }
    </style>
  </head>
  <body>
    <center><h2>Data Aparatur Sipil Negara</h2></center>
    <div class="wrapper">
      <table class="table">
        <tr>
          <td colspan="3" style="font-weight: bold;text-align: center;background: rgba(0,0,0,.1)">Biodata</td>
        </tr>
        <tr>
          <th width="200">Nama</th>
          <th width="1">:</th>
          <td>{{ $data->gelar_depan.' '.$data->nama.($data->gelar_belakang?', '.$data->gelar_belakang:'') }}</td>
        </tr>
        <tr>
          <th>Jenis Kelamin</th>
          <th width="1">:</th>
          <td>{{ $data->jenis_kelamin==1?'Pria':'Wanita' }}</td>
        </tr>
        <tr>
          <th>Tempat Lahir</th>
          <th width="1">:</th>
          <td>{{ $data->alamat }}</td>
        </tr>
        <tr>
          <th>Nomor Telepon</th>
          <th width="1">:</th>
          <td>{{ $data->telp }}</td>
        </tr>
        <tr>
          <td colspan="3" style="font-weight: bold;text-align: center;background: rgba(0,0,0,.1)">Data Kepegawaian</td>
        </tr>
        <tr>
          <th width="200">NIP</th>
          <th width="1">:</th>
          <td>{{ $data->nip_baru }}</td>
        </tr>
        <tr>
          <th>NIP Lama</th>
          <th width="1">:</th>
          <td>{{ $data->nip_lama??'-' }}</td>
        </tr>
        <tr>
          <th>Pangkat/Golongan</th>
          <th width="1">:</th>
          <td>{{ $data->golongan }}</td>
        </tr>
        <tr>
          <th>Jabatan</th>
          <th width="1">:</th>
          <td>{{ $data->jabatan }}</td>
        </tr>
        <tr>
          <th>Unit Kerja</th>
          <th width="1">:</th>
          <td>{{ $data->instansi }}</td>
        </tr>
        <tr>
          <th>Unit Kerja Induk</th>
          <th width="1">:</th>
          <td>{{ $data->instansi_induk }}</td>
        </tr>
        <tr>
          <th>Status</th>
          <th width="1">:</th>
          <td>{{ ucwords($data->status) }}</td>
        </tr>
      </table>
    </div>
  </body>
</html>
