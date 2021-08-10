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

  <!-- Bootstrap Date-Picker Plugin -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />



</head>

<body class="layout-top-nav">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container-fluid" style="max-width:1168px">
        <ul class="navbar-nav" style="font-size:17.5px">
          <li class="nav-item">
            <a href="/home/all-files" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="/request-file/all-files" class="nav-link">Request Files</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-compress-arrows-alt"></i>
            </a>
          </li>
          <div class="dropdown mr-1">
            <button type="button" style="font-size:19px" class="btn dropdown-toggle btn-primary-outline" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="../../dist/img/default.png" class="brand-image img-circle elevation-1" style="width:25px; height:25px;" alt="User Image">
              <span class="brand-text font-weight-light">{{auth()->user()->name}}</span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
              <form action="/logout" method="POST" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="btn btn-block btn-primary-outline">Log Out</button>
              </form>
            </div>
          </div>
        </ul>
      </div>
    </nav>

    <div class="content-wrapper">
      <div class="content">
        <div class="container">
          <div class="content-wrapper">
            @yield('content')
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.cookie/1.4.0/jquery.cookie.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>

    <script src="../../plugins/select2/js/select2.min.js"></script>

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      @if($message = Session::get('success'))
      Swal.fire({
        icon: 'success',
        title: 'SUCCESS!',
        text: 'Successfully requested file!',
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

    <script>
      $(document).ready(function() {
        var date_input = $('input[name="date"]');
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
          format: 'yyyy/mm/dd',
          startDate: "+1d",
          container: container,
          todayHighlight: true,
          autoclose: true,
        };
        date_input.datepicker(options)
      });
    </script>

</body>

</html>