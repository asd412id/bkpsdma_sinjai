<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="{{ url('assets/img/sinjai_logo.png') }}">
  <meta name="description" content="">
  <meta name="author" content="">


  <title>@yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ url('assets') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="{{ url('assets') }}/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="{{ url('assets') }}/css/style.min.css" rel="stylesheet">
  <link href="{{ url('assets') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="{{ url('assets') }}/vendor/fancybox/jquery.fancybox.min.css" rel="stylesheet">
  <style media="screen">
    label.control-label{
      font-weight: bold;
    }
    .btn{
      border-radius: 0;
    }
    .card-header{
      font-weight: bold;
    }
  </style>
  @yield('head')

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('layout.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('layout.topbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; BKPSDMA 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin akan logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih tombol "Logout" di bawah jika ingin mengakhiri sesi Anda!</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="{{ route('main.logout') }}">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import File Excel (*.xlsx, *.xls, *.ods)</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="form-import" action="{{ route('pegawai.import') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <input type="file" name="file_excel" class="form-control" accept=".xlsx,.xls,.ods" required>
            <div class="mt-2">
              <label for="update">
                <input type="radio" name="status" value="update" id="update" checked>
                Update Data <em>(Meperbaharui data lama)</em>
              </label>
              <label for="new">
                <input type="radio" name="status" value="new" id="new">
                Data Baru <em class="text-danger">(Data lama akan diganti dengan data dari file excel)</em>
              </label>
            </div>
            <div class="mt-1 text-center">
              <div class="alert alert-success">
                <em>Format file Excel harus sesuai dengan template! Silahkan <a href="{{ route('download.template') }}" class="text-danger font-weight-bold">download template</a> berikut untuk menginput data.</em>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"><i class="fas fa-file-upload"></i> Import File</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ url('assets') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ url('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ url('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ url('assets') }}/js/sb-admin-2.min.js"></script>
  <script src="{{ url('assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="{{ url('assets') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="{{ url('assets') }}/vendor/fancybox/jquery.fancybox.min.js"></script>
  <script type="text/javascript">
  $("#form-import").submit(function(){
    $(this).find("button[type='submit']").prop('disabled',true);
    $(this).find("button[type='submit']").html('Sedang mengimport ...');
  })
  </script>
  @yield('foot')

</body>

</html>
