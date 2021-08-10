<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>File Management System</title>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap Table -->
  <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">

  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="stylesheet" href="../../plugins/mycustomicon/style.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/dashboard" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item" style="padding-right:10px">
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search" style="margin-right:15px"></i>
          </a>
          <div class="navbar-search-block" style="display: none;">
            <form action="/search" method="POST" class="form-inline">
              @csrf
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <form action="/logout" method="POST" enctype="multipart/form-data">
          @csrf
          <li class="nav-item" style="padding-right:10px">
            <button type="submit" class="btn btn-primary btn-sm" style="margin-top:5px;">
              <i class="fas fa-sign-out-alt" style="margin-right:5px;"></i><b style="font-size:14.5px">Log out</b>
            </button>
          </li>
        </form>
      </ul>
    </nav>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <center><span class="brand-text font-weight-bold">File Management System</span></center>
      </a>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="padding-left:10px;">
        <div class="image">
          <img src="../../dist/img/default.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <span class="d-block" style="color:white">{{auth()->user()->name}}</span>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2" style="min-height:1000px;">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="/dashboard" class="nav-link {{ (request()->is('dashboard')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/create-file" class="nav-link {{ (request()->is('create-file')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas fa-file"></i>
                <p>
                  Create File
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/create-center" class="nav-link {{ (request()->is('create-center')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas fa-building"></i>
                <p>
                  Create Center
                </p>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('manage-request/*', 'manage-checkout/*')) ? 'menu-open' : 'nav-item' }}">
              <a href="#" class="nav-link {{ (request()->is('manage-request/*', 'manage-checkout/*')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas fa-file-export"></i>
                <p>
                  Check Out Files
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/manage-request/all-files" class="nav-link {{ (request()->is('manage-request/all-files', 'manage-checkout/all-files/*')) ? 'active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    All Files
                  </a>
                </li>
                <li class="nav-item">
                  @foreach($centers as $center)
                  <a href="/manage-request/{{$center->code}}" class="nav-link {{ (request()->is("manage-request/$center->code", "manage-checkout/$center->code/*" )) ? 'active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    [{{$center->code}}] {{$center->name}}
                    @endforeach
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item {{ (request()->is('manage-unreturned/*', 'manage-checkin/*')) ? 'menu-open' : 'nav-item' }}">
              <a href="#" class="nav-link {{ (request()->is('manage-unreturned/*', 'manage-checkin/*')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas fa-file-import"></i>
                <p>
                  Check In Files
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/manage-unreturned/all-files" class="nav-link {{ (request()->is('manage-unreturned/all-files', 'manage-checkin/all-files/*')) ? 'active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    All Files
                  </a>
                </li>
                <li class="nav-item">
                  @foreach($centers as $center)
                  <a href="/manage-unreturned/{{$center->code}}" class="nav-link {{ (request()->is("manage-unreturned/$center->code", "manage-checkin/$center->code/*")) ? 'active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    [{{$center->code}}] {{$center->name}}
                    @endforeach
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item {{ (request()->is('archive-file/*')) ? 'menu-open' : 'nav-item' }}">
              <a href="#" class="nav-link {{ (request()->is('archive-file/*')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas fa-file-archive"></i>
                <p>
                  Archive Files
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  @foreach($centers as $center)
                  <a href="/archive-file/{{$center->code}}" class="nav-link {{ (request()->is("archive-file/$center->code")) ? 'active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    [{{$center->code}}] {{$center->name}}
                    @endforeach
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item {{ (request()->is('unarchive-file/*')) ? 'menu-open' : 'nav-item' }}">
              <a href="#" class="nav-link {{ (request()->is('unarchive-file/*')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas icon-file-unarchive"></i>
                <p>
                  Unarchive Files
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/unarchive-file/all-files" class="nav-link {{ (request()->is('unarchive-file/all-files')) ? 'active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    All Files
                  </a>
                </li>
                <li class="nav-item">
                  @foreach($centers as $center)
                  <a href="/unarchive-file/{{$center->code}}" class="nav-link {{ (request()->is("unarchive-file/$center->code")) ? 'active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    [{{$center->code}}] {{$center->name}}
                    @endforeach
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item {{ (request()->is('move-file/*')) ? 'menu-open' : 'nav-item' }}">
              <a href="#" class="nav-link {{ (request()->is('move-file/*')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas fa-dolly"></i>
                <p>
                  Move Files
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  @foreach($centers as $center)
                  <a href="/move-file/{{$center->code}}" class="nav-link {{ (request()->is("move-file/$center->code")) ? 'active' : 'nav-link' }}">
                    <i class="far fa-circle nav-icon"></i>
                    [{{$center->code}}] {{$center->name}}
                    @endforeach
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="/view-file/all-files" class="nav-link {{ (request()->is('view-file/*','file-page/*')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>
                  View Files
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/view-archive/all-files" class="nav-link {{ (request()->is('view-archive/*','view-unarchive-file/*','view-archive-file/*')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas fa-archive"></i>
                <p>
                  View Archives
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/applications-log/all-files" class="nav-link {{ (request()->is('applications-log/*')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                  Applications Log
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/manual" class="nav-link {{ (request()->is('manual')) ? 'active' : 'nav-link' }}">
                <i class="nav-icon fas fa-book-open"></i>
                <p>
                  User Manual
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->

  </div>

  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>

  <script src="../../plugins/select2/js/select2.min.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    @if($message = Session::get('centercreated'))
    Swal.fire({
      icon: 'success',
      title: 'SUCCESS!',
      text: 'Successfully created center!',
      confirmButtonColor: '#337DFF',
    })
    @endif

    @if($message = Session::get('filecreated'))
    Swal.fire({
      icon: 'success',
      title: 'Created File!',
      text: 'File Number: {{ session('filenum') }}',
      confirmButtonColor: '#337DFF',
    })
    @endif

    @if($message = Session::get('editfile'))
    Swal.fire({
      icon: 'success',
      title: 'Edited File!',
      text: 'Successfully edited file',
      confirmButtonColor: '#337DFF',
    })
    @endif

    @if($message = Session::get('checkout'))
    Swal.fire({
      icon: 'success',
      title: 'SUCCESS!',
      text: 'File has successfully checked out!',
      confirmButtonColor: '#337DFF',
    })
    @endif
    @if($message = Session::get('cancel'))
    Swal.fire({
      icon: 'error',
      title: 'REQUEST CANCELED!',
      text: 'File request has been successfully canceled!',
      confirmButtonColor: '#337DFF',
    })
    @endif

    @if($message = Session::get('checkin'))
    Swal.fire({
      icon: 'success',
      title: 'SUCCESS!',
      text: 'File has successfully checked in!',
      confirmButtonColor: '#337DFF',
    })
    @endif

    @if($message = Session::get('movedfile'))
    Swal.fire({
      icon: 'success',
      title: 'SUCCESS!',
      text: 'Successfully moved files!',
      confirmButtonColor: '#337DFF',
    })
    @endif

    @if($message = Session::get('fileunarchive'))
    Swal.fire({
      icon: 'success',
      title: 'Unarchived Files!',
      text: 'Succesfully unarchived files',
      confirmButtonColor: '#337DFF',
    })
    @endif

    @if($message = Session::get('filearchive'))
    Swal.fire({
      icon: 'success',
      title: 'Archive created!',
      text: 'Archive Number : {{ session('archive_number') }}',
      confirmButtonColor: '#337DFF',
    })
    @endif

    @if($message = Session::get('editarchive'))
    Swal.fire({
      icon: 'success',
      title: 'Archive Edited!',
      text: 'Succesfully edited archive',
      confirmButtonColor: '#337DFF',
    })
    @endif

    @if($message = Session::get('fail'))
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please select a file!',
      })
      @endif

  </script>

  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  </script>

  <script>
    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $("#myInput2").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable2 tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>

  <script>
    var $table = $('#table')

    $(function() {
      $table.bootstrapTable()

      $('.toolbar input').change(function() {
        var paginationParts = []
      })
    })
  </script>

  <script>
    function linksSorter(a, b) {
      var a = $(a).text();
      var b = $(b).text();
      if (a < b) return -1;
      if (a > b) return 1;

      return 0;
    }
  </script>

  <script>
    $(function() {
      // bind change event to select
      $('#dynamic_select').bind('change', function() {
        var url = $(this).val(); // get selected value
        if (url) { // require a URL
          window.location = url; // redirect
        }
        return false;
      });
    });
  </script>

  <script>
    $(function() {
      var $sections = $('.form-section');

      function navigateTo(index) {
        $sections.removeClass('current').eq(index).addClass('current');
        $('.form-navigation .previous').toggle(index > 0);
        var atTheEnd = index >= $sections.length - 1;
        $('.form-navigation .next').toggle(!atTheEnd);
        $('.form-navigation [type=submit]').toggle(atTheEnd);
      }

      function curIndex() {
        return $sections.index($sections.filter('.current'));
      }

      $('.form-navigation .previous').click(function() {
        navigateTo(curIndex() - 1);
      });

      $('.form-navigation .next').click(function() {
        navigateTo(curIndex() + 1);
      });

      navigateTo(0);
    });
  </script>

  <script type="text/javascript">
    $(function() {
      $("#select_purpose").change(function() {
        if ($(this).val() == 1) {
          $("#other_purpose").removeAttr("disabled");
          $("#other_purpose").focus();
        } else {
          $("#other_purpose").attr("disabled", "disabled");
        }
      });
    });
  </script>

  <script type="text/javascript">
    $(function() {
      $("#archive_number").change(function() {
        if ($(this).val() == "null") {
          $("#other_number").removeAttr("disabled");
          $("#other_number").focus();
        } else {
          $("#other_number").attr("disabled", "disabled");
        }
      });
    });
  </script>

<script type="text/javascript">
    $(function() {
      $("#move_purpose").change(function() {
        if ($(this).val() == 1) {
          $("#other_move_purpose").removeAttr("disabled");
          $("#other_move_purpose").focus();
        } else {
          $("#other_move_purpose").attr("disabled", "disabled");
        }
      });
    });
  </script>

  <script>
    $(function() {
      $("#table1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "pageLength": 5
      }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
    });

    $(function() {
      $("#table2").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "pageLength": 5,
      }).buttons().container().appendTo('#table2_wrapper .col-md-6:eq(0)');
    });
  </script>

</body>

</html>