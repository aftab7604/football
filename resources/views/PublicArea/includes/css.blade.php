<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<style>
    @media (min-width: 992px) {
        .main-nav {
            padding-right: 6rem !important;
            padding-left: 6rem !important;
        }
    }

    @media (max-width: 780.98px) {
        .main-navbar-brand {
            max-width: 75%;
        }
    }

    .bg-dark {
        background-color: rgba(0, 0, 0, .8) !important;
    }

    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
        margin-bottom: 0;
        border-radius: 0;
        border-bottom: 3px solid #12e5fa;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {
        height: 100%
    }

    /* Set gray background color and 100% height */
    .sidenav {
        padding-top: 20px;
        height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
        background-color: rgba(0, 0, 0, .8);
        color: white;
        padding: 15px;
        border-top: 3px solid #12e5fa;

    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
        .sidenav {
            height: auto;
            padding: 15px;
        }

        .row.content {
            height: auto;
        }
    }

    .scorer {
        max-width: 1rem !important;
    }

    .badge-newinfo {
        color: #fff;
        background-color: #12e5fa;
    }

    .text-newinfo {
        color: #12e5fa !important;
    }

    .nav-cus {
        border-right: 1px solid #12e5fa;
    }

    .no-underline {
        color: #000;
        text-decoration: none !important;
    }

    .no-underline:hover {
        color: #000;
        text-decoration: none !important;
    }

    .btn-outline-newinfo {
        color: #12e5fa;
        border-color: #12e5fa;
    }

    .btn-outline-info:hover {
        color: #ffffff;
        background-color: #12e5fa;
        border-color: #12e5fa;
    }

</style>
@yield('css')
