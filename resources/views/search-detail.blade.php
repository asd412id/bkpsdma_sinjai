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
            @if ($data)
              <h3 class="mb-4">Biodata Pegawai Negeri Sipil: <strong>{{ $data->gelar_depan.' '.$data->nama.($data->gelar_belakang?', '.$data->gelar_belakang:'') }}</strong></h3>
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
                  </div>
                </div>
                <div class="col-sm-12 text-center">
                  <div class="alert alert-success d-inline-block">Apabila terdapat kesalahan pada data terkait, agar segera melapor ke kantor BKPSDMA Kabupaten Sinjai dengan membawa data otentik.</div>
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
