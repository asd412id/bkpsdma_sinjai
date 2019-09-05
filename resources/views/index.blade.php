@extends('frontpage.master')
@section('title',$title)
@section('content')
  <div class="wrapper">
    <div class="frontpage">
      <a href="{{ route('main.login') }}" class="btn btn-default btn-sm btn-login"><i class="fas fa-sign-in-alt"></i> Login Admin</a>
      <div class="container">
        <h1>Aplikasi Kepegawaian</h1>
        <h3>BKPSDMA Kabupaten Sinjai</h3>
        <form class="form-search" action="{{ route('search.index') }}" method="get">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Masukkan NIP atau Nama Pegawai ..." autofocus required>
            <div class="input-group-append">
              <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Cari Pegawai</button>
            </div>
          </div>
        </form>
        <div class="footer">
          <div class="copyright text-center my-auto">
            <span>&copy; 2019 Copyright BKPSDMA</span>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
