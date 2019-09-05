@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">{{ str_replace(['Detail Pegawai',' - BKPSDMA'],'',$title) }}</h1>
    <div class="float-right">
      <a href="{{ route('pegawai.print.single',['uuid'=>$data->uuid]) }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" target="_blank"><i class="fas fa-print text-white-50"></i> Cetak Data</a>
      <a href="{{ route('pegawai.edit',['uuid'=>$data->uuid]) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit text-white-50"></i> Ubah Data</a>
    </div>
  </div>

  @if ($errors->any())
    @foreach ($errors->all() as $key => $er)
      <div class="alert alert-danger">{{ $er }}</div>
    @endforeach
  @endif

  <div class="row">
    <div class="col-sm-6">
      <div class="card mb-4">
        <div class="card-header text-primary">Biodata</div>
        <div class="card-body">
          <table class="table">
            <tr>
              <th width="200">Nama</th>
              <th width="1">:</th>
              <td>{{ $data->nama }}</td>
            </tr>
            <tr>
              <th>Jenis Kelamin</th>
              <th width="1">:</th>
              <td>{{ $data->jenis_kelamin==1?'Pria':'Wanita' }}</td>
            </tr>
            <tr>
              <th>Alamat</th>
              <th width="1">:</th>
              <td>{{ $data->alamat }}</td>
            </tr>
            <tr>
              <th>Nomor Telepon</th>
              <th width="1">:</th>
              <td>{{ $data->telp }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card mb-4">
        <div class="card-header text-primary">Data Kepegawaian</div>
        <div class="card-body">
          <table class="table">
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
              <th>Nama Instansi</th>
              <th width="1">:</th>
              <td>{{ $data->instansi }}</td>
            </tr>
            <tr>
              <th>Jabatan</th>
              <th width="1">:</th>
              <td>{{ $data->jabatan }}</td>
            </tr>
            <tr>
              <th>Status</th>
              <th width="1">:</th>
              <td>{{ ucwords($data->status) }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
