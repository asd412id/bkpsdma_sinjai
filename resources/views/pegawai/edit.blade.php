@extends('layout.master')
@section('title',$title)
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Pegawai</h1>
  </div>

  @if ($errors->any())
    @foreach ($errors->all() as $key => $er)
      <div class="alert alert-danger">{{ $er }}</div>
    @endforeach
  @endif

  <form action="{{ route('pegawai.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="uuid" value="{{ $data->uuid }}">
    <div class="row">
      <div class="col-sm-6">
        <div class="card mb-4">
          <div class="card-header text-primary">Biodata</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Nama</label>
              <div class="col-sm-12">
                <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" required>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Jenis Kelamin</label>
              <div class="col-sm-12">
                @php
                  $jk = [
                    1=>'Pria',
                    2=>'Wanita'
                  ];
                @endphp
                <select class="form-control" name="jenis_kelamin">
                  @foreach ($jk as $key => $p)
                    <option {{ $data->jenis_kelamin==$key?'selected':'' }} value="{{ $key }}">{{ ucwords($p) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Alamat</label>
              <div class="col-sm-12">
                <textarea name="alamat" rows="8" cols="80" class="form-control">{{ $data->alamat }}</textarea>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">No. Telepon</label>
              <div class="col-sm-12">
                <input type="text" name="telp" class="form-control" value="{{ $data->telp }}">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card mb-4">
          <div class="card-header text-primary">Data Kepegawaian</div>
          <div class="card-body">
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">NIP</label>
              <div class="col-sm-12">
                <input type="number" name="nip_baru" class="form-control" value="{{ $data->nip_baru }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">NIP Lama</label>
              <div class="col-sm-12">
                <input type="number" name="nip_lama" class="form-control" value="{{ $data->nip_lama }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Pangkat/Golongan</label>
              @php
                $pg = [
                  'Juru Muda / Ia',
                  'Juru Muda Tingkat 1 / Ib',
                  'Juru / Ic',
                  'Juru Tingkat 1 / Id',
                  'Pengatur Muda / IIa',
                  'Pengatur Muda Tingkat 1 / IIb',
                  'Pengatur / IIc',
                  'Pengatur Tingkat 1 / IId',
                  'Penata Muda / IIIa',
                  'Penata Muda Tingkat 1 / IIIb',
                  'Penata / IIIc',
                  'Penata Tingkat 1 / IIId',
                  'Pembina / IVa',
                  'Pembina Tingkat 1 / IVb',
                  'Pembina Utama Muda / IVc',
                  'Pembina Utama Madya / IVd',
                  'Pembina Utama / IVe',
                ];
              @endphp
              <div class="col-sm-12">
                <select class="form-control" name="golongan">
                  @foreach ($pg as $key => $p)
                    <option {{ $data->golongan==$p?'selected':'' }} value="{{ $p }}">{{ $p }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Nama Instansi</label>
              <div class="col-sm-12">
                <input type="text" name="instansi" class="form-control" value="{{ $data->instansi }}" required>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Jabatan</label>
              <div class="col-sm-12">
                <input type="text" name="jabatan" class="form-control" value="{{ $data->jabatan }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Status</label>
              <div class="col-sm-12">
                @php
                  $jk = ['aktif','pensiun'];
                @endphp
                <select class="form-control" name="status">
                  @foreach ($jk as $key => $p)
                    <option {{ $data->status==$p?'selected':'' }} value="{{ $p }}">{{ ucwords($p) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i> SIMPAN DATA</button>
        <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fa fa-fw fa-undo"></i> BATAL</a>
      </div>
    </div>
  </form>

@endsection
