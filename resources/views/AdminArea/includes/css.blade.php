<!-- CSS Files -->
<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
    rel="stylesheet" />
<link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />
<!-- PLUGINS CSS STYLE -->
<link rel="stylesheet" href="{{ asset('AdminArea/assets/plugins/toaster/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminArea/assets/plugins/flag-icons/css/flag-icon.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminArea/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}">
<link rel="stylesheet" href="{{ asset('AdminArea/assets/plugins/ladda/ladda.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminArea/assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('AdminArea/assets/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('AdminArea/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<!-- SLEEK CSS -->
<link id="sleek-css" rel="stylesheet" href="{{ asset('AdminArea/assets/css/sleek.css') }}">
<style>
    .dataTables_paginate>.pagination .page-item .page-link {
        padding: .75rem;
        margin: 0 0.31rem;
        border-radius: 0;
    }

    @media (min-width: 768px) {
        .dataTables_paginate>.pagination .page-item .page-link {
            padding: 1rem 1.25rem;
        }
    }

    .dataTables_paginate>.pagination .page-item:last-child .page-link {
        margin-right: 0;
    }

    .dataTables_paginate>.pagination .page-item:first-child .page-link {
        margin-left: 0;
    }

    .dataTables_paginate>.pagination .page-item .page-link {
        border-radius: 6.25rem;
    }

    .bottom-information {
        margin-top: 2rem;
    }

</style>
@yield('css')
