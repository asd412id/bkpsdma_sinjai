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
              <label for="" class="control-label col-sm-12">Gelar Depan</label>
              <div class="col-sm-12">
                <input type="text" name="gelar_depan" class="form-control" value="{{ $data->gelar_depan }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Gelar Belakang</label>
              <div class="col-sm-12">
                <input type="text" name="gelar_belakang" class="form-control" value="{{ $data->gelar_belakang }}">
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
                  'I/a',
                  'I/b',
                  'I/c',
                  'I/d',
                  'II/a',
                  'II/b',
                  'II/c',
                  'II/d',
                  'III/a',
                  'III/b',
                  'III/c',
                  'III/d',
                  'IV/a',
                  'IV/b',
                  'IV/c',
                  'IV/d',
                  'IV/e',
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
              <label for="" class="control-label col-sm-12">Jabatan</label>
              <div class="col-sm-12">
                <input type="text" name="jabatan" class="form-control" value="{{ $data->jabatan }}">
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Unit Kerja</label>
              <div class="col-sm-12">
                <input type="text" name="instansi" class="form-control" value="{{ $data->instansi }}" required>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Unit Kerja Induk</label>
              <div class="col-sm-12">
                <input type="text" name="instansi_induk" class="form-control" value="{{ $data->instansi_induk }}" required>
              </div>
            </div>
            <div class="row form-group">
              <label for="" class="control-label col-sm-12">Status</label>
              <div class="col-sm-12">
                <input type="text" name="status" class="form-control" value="{{ $data->status }}" required>
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
