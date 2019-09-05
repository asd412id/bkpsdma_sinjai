@extends('layout.master')
@section('title',$title)
@section('head')
  <style media="screen">
    a.btn-link{
      padding: 0 5px;
    }
  </style>
@endsection
@section('content')
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Daftar Pegawai</h1>
    <div class="float-right">
      <a href="javascript:void()" data-toggle="modal" data-target="#importModal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-file-excel text-white-50"></i> Import Excel</a>
      <a href="javascript:void()" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm btn-print" target="_blank"><i class="fas fa-print text-white-50"></i> Cetak Data</a>
      <a href="{{ route('pegawai.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus text-white-50"></i> Tambah Data</a>
    </div>
  </div>

  @if (session()->has('message'))
    <div class="alert alert-success"><i class="fa fa-fw fa-check"></i> {!! session()->get('message') !!}</div>
  @elseif ($errors->any())
    @foreach ($errors->all() as $key => $err)
      <div class="alert alert-danger"><i class="fa fa-fw fa-exclamation"></i> {{ $err }}</div>
    @endforeach
  @endif

  <table class="table table-hover table-stripped data-table">
    <thead>
      <tr>
        <th width="5">No</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Pangkat</th>
        <th>Instansi</th>
        <th>Status</th>
        <th>Jabatan</th>
        <th width="135px">Aksi</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>

@endsection
@section('foot')
  <script type="text/javascript">
  var table = $('.data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('pegawai.index') }}",
    columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
      {data: 'nip_baru', name: 'nip_baru'},
      {data: 'nama', name: 'nama'},
      {data: 'jk', name: 'jk'},
      {data: 'golongan', name: 'golongan'},
      {data: 'instansi', name: 'instansi'},
      {data: 'status', name: 'status', visible: false},
      {data: 'jabatan', name: 'jabatan', visible: false},
      {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
    "language": {
      "decimal":        "",
      "emptyTable":     "Data tidak tersedia",
      "info":           "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
      "infoEmpty":      "Menampilkan 0 hingga 0 dari 0 entries",
      "infoFiltered":   "(Difilter dari _MAX_ total data)",
      "infoPostFix":    "",
      "thousands":      ",",
      "lengthMenu":     "Menampilkan _MENU_ data",
      "loadingRecords": "Memuat...",
      "processing":     "Memproses...",
      "search":         "Cari:",
      "zeroRecords":    "Pencarian tidak ditemukan",
      "paginate": {
        "first":      "Pertama",
        "last":       "Terakhir",
        "next":       "Selanjutnya",
        "previous":   "Sebelumnya"
      }
    },
    'drawCallback': function(settings){
      var start = (settings.json.input.start/settings.json.input.length)+1;
      var rows = settings.json.input.length;
      var dta = settings.json.input.search.value;
      var uri = 'all';
      if (dta!=null) {
        uri = encodeURIComponent(dta.trim());
      }
      $(".btn-print").prop('href','{{ route('pegawai.print.all') }}?q='+uri+'&rows='+rows+'&page='+start);
      $(".hapus").on('click',function(){
        if (!confirm('Hapus data ini?')) {
          return false;
        }
      });
    }
  });

  </script>
@endsection
