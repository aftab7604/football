<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCn8TFXGg17HAUcNpkwtxxyT9Io9B_NcM" defer></script>
<script src="{{ asset('AdminArea/assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/toaster/toastr.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/charts/Chart.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/ladda/spin.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/ladda/ladda.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/jquery-mask-input/jquery.mask.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/jekyll-search.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/js/sleek.js') }}"></script>
<script src="{{ asset('AdminArea/assets/js/chart.js') }}"></script>
<script src="{{ asset('AdminArea/assets/js/date-range.js') }}"></script>
<script src="{{ asset('AdminArea/assets/js/map.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/data-tables/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('AdminArea/assets/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<script>
    $(document).ready(function () {

        @foreach(['danger', 'success'] as $msg)
        @if(Session::has('alert-'.$msg))
        var msg = '@php echo Session("alert-".$msg); @endphp';
        @if($msg == 'success')
        setTimeout(() => {
            notifySuccess(msg);
        }, 500);
        @endif
        @if($msg == 'danger')
        setTimeout(() => {
            notifyDanger(msg);
        }, 500);
        @endif
        @endif
        @endforeach

    });

    function notifySuccess(msg) {
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: false,
            progressBar: true,
            positionClass: 'toast-top-right',
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        toastr.success(msg);
    }

    function notifyDanger(msg) {
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: false,
            progressBar: true,
            positionClass: 'toast-top-right',
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        };
        toastr.error(msg);
    }

</script>
@yield('js')
