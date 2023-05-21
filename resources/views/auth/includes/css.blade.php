<!-- CSS Files -->

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
    rel="stylesheet" />
<link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

<!-- PLUGINS CSS STYLE -->
<link href="{{ asset('AdminArea/assets/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />
<link href="{{ asset('AdminArea/assets/plugins/flag-icons/css/flag-icon.min.css') }}" rel="stylesheet" />
<link href="{{ asset('AdminArea/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
<link href="{{ asset('AdminArea/assets/plugins/ladda/ladda.min.css') }}" rel="stylesheet" />
<link href="{{ asset('AdminArea/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('AdminArea/assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />

<!-- SLEEK CSS -->
<link id="sleek-css" href="{{ asset('AdminArea/assets/css/sleek.css') }}" rel="stylesheet" />

<style>
    .bg-dark-cus {
        background-color: rgba(0, 0, 0, .8) !important;
    }

    .btn-dark-cus {
        color: #ffffff;
        background-color: rgba(0, 0, 0, .8);
        border-color: rgba(0, 0, 0, .8);
    }

</style>
@yield('css')
