<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>CMS Bright Star</title>

    <!-- ========== All CSS files linkup ========= -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/datatable/dataTables.bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/datatable/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.main.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/switalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('../../vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/toaster/toaster.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/datatable/datatables.css') }}"> --}}
</head>

<body>
    <main>
        {{ $slot }}
    </main>

    {{-- <script src="{{ asset('assets/datatable/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    {{-- <script src="{{ asset('assets/datatable/dataTables.bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('assets/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/switalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/dynamic-pie-chart.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/js/jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/polyfill.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <script src="{{ asset('js/file-upload.js') }}"></script>
    <script src="{{ asset('js/typeahead.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
    <script src="{{ asset('vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/toaster/toaster.min.js') }}"></script>
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

    <script>
        //started datatables
        $(document).ready(function() {
            $('#myTable').DataTable();
        });


        // taoster message
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
</body>

</html>
