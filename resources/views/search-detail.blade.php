@extends('frontpage.master')
@section('title',$title)
@section('content')
  <div class="wrapper">
    <div class="frontpage search-result">
      <div class="container-search">
        <div class="page-header">
          <a href="{{ route('main') }}">
            <img src="{{ url('assets/img/sinjai.png') }}" alt="" class="logo">
            <h1 class="h4 title">Aplikasi Kepegawaian</h1>
            <h2 class="h4 title">BKPSDMA KABUPATEN SINJAI</h2>
          </a>
        </div>
        <div class="wrapper">
          <div class="card card-body">
            <form class="form-search mb-4" action="{{ route('search.index') }}" method="get">
              <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Masukkan NIP atau Nama Pegawai ..." required>
                <div class="input-group-append">
                  <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Cari Pegawai</button>
                </div>
              </div>
            </form>
            @if ($data)
              <h3 class="mb-4">Biodata Pegawai Negeri Sipil: <strong>{{ $data->nama }}</strong></h3>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="card mb-4">
                    <div class="card-header text-success font-weight-bold">Biodata</div>
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
                    <div class="card-header text-success font-weight-bold">Data Kepegawaian</div>
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
            @else
              <div class="h4 text-danger text-center mb-4"><i class="fas fa-exclamation-circle"></i> Maaf, data yang Anda cari tidak ditemukan!</div>
            @endif
          </div>
        </div>
        <div class="footer">
          <div class="copyright text-center my-auto">
            <span>&copy; 2019 Copyright BKPSDMA</span>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
