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
            <h3 class="mb-4">Hasil Pencarian: <strong>"{{ request()->q }}"</strong></h3>
            <div class="clearfix"></div>
            <table class="table table-bordered table-hover">
              <thead>
                <th width="1">NO</th>
                <th>NIP</th>
                <th>NAMA</th>
                <th>JENIS KELAMIN</th>
                <th>INSTANSI</th>
              </thead>
              <tbody>
                @if (count($data))
                  @foreach ($data as $key => $d)
                    <tr>
                      <td class="text-center">{{ $key+1 }}</td>
                      <td><a href="{{ route('search.detail',['nip'=>$d->nip_baru]) }}" class="text-success font-weight-bold" title="Lihat Detail">{{ $d->nip_baru }}</a></td>
                      <td>{{ $d->nama }}</td>
                      <td>{{ $d->jenis_kelamin==1?'Pria':'Wanita' }}</td>
                      <td>{{ $d->instansi }}</td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                  </tr>
                @endif
              </tbody>
            </table>
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
