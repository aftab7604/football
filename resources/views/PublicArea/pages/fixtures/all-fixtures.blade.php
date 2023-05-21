@extends('PublicArea.layouts.app')
@section('title')
Football-Today | Fixtures
@endsection
@section('content')


<div class="row mt-3">
    <div class="col-md-8 text-left">
        <div class="card align-middle bg-dark text-white">
            <h5 class="text-left p-2">Matches</h5>
        </div>
        <div id="fixtures_list" class="my-3">
            <div class="text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 text-left">
        <div class="card align-middle bg-dark text-white">
            <h5 class="text-left p-2">Date Picker</h5>
        </div>
        <div class="calendar-wrapper"></div>
    </div>
</div>

@endsection

@section('js')
<script src="{{asset('PublicArea/calendar/js/calendar.js')}}"></script>
<script>
    var intervalId = window.setInterval(function () {
        getAllFixtures();
    }, 300000);

    $(document).ready(function () {
        getAllFixtures();

        var config =
            `function selectDate(date) {
                $('.calendar-wrapper').updateCalendarOptions({
                date: date
                });
                dateSelect(date);
            }

            var defaultConfig = {
                weekDayLength: 1,
                date: new Date(),
                onClickDate: selectDate,
                showYearDropdown: true,
                startOnMonday: false,
            };

            $('.calendar-wrapper').calendar(defaultConfig);`;

        eval(config);
    });

    function getAllFixtures() {
        $.ajax({
            url: "{{ route('public.fixtures.ajax') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            dataType: 'html',
            success: function (response) {
                $('#fixtures_list').html(response);
            }
        });
    }

    function dateSelect(date) {
        var selectedDate = moment(date).format('YYYY-MM-DD')
        document.cookie = "date=" + selectedDate;

        $('#fixtures_list').html(
            '<div class="text-center">' +
            '<div class="spinner-border" role="status">' +
            '<span class="sr-only">Loading...</span>' +
            '</div>' +
            '</div>'
        );
        getAllFixtures();
    }

</script>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('PublicArea/calendar/css/style.css')}}">
<link rel="stylesheet" href="{{asset('PublicArea/calendar/css/theme.css')}}">
<style>
    #fixtures_list {
        min-height: 65vh;
    }

    .card-header {
        background-color: rgba(0, 0, 0, .8);
    }

    .btn-link {
        color: #fff;
        text-decoration: none !important;
    }

    .btn-link:hover {
        color: #fff;
        text-decoration: none !important;
    }

    tr.match {
        border-top: 1px solid #d3d3d3;
    }

    .matches_new td.minute {
        width: 58px;
        text-align: center;
    }

    table.matches_new th,
    table.matches_new td {
        padding: 3px 5px;
    }

    .minute.novis .match-card.match-current-minute {
        background-color: transparent !important;
        margin-right: 4px;
    }

    .minute.visible .match-card.match-current-minute {
        background-color: #12e5fa;
    }

    .minute.visible-2 .match-card.match-current-minute {
        background-color: rgba(0, 0, 0, .8);
    }

    .match .match-card {
        padding: 0 5px;
        background: #4a4a4a;
        color: #fff;
        text-align: center;
        min-width: 48px;
        line-height: 23px;
        font-size: 12px;
        display: inline-block;
    }

    td.team-a {
        text-align: right;
    }

    td.team {
        width: 50%;
        max-width: 50px;
        overflow: hidden;
        overflow-x: hidden;
        overflow-y: hidden;
        text-overflow: ellipsis;
    }

    td.score-time {
        width: 45px;
        white-space: nowrap;
        text-align: center;
        background: #dadada;
        font-weight: bold;
    }

    table.matches_new th,
    table.matches_new td {
        padding: 3px 5px;
    }

    td>a {
        text-decoration: none !important;
        color: #000;
    }

    td>a:hover {
        text-decoration: none !important;
        color: #000;
    }

    .calendar-wrapper {
        width: 100%;
        max-width: 400px;
        margin: auto;
        border: 1px solid #eee;
        padding: 10px;
    }

    .btn-xs {
        padding: 0.25rem 0.25rem;
        font-size: .675rem;
        line-height: 1;
        border-radius: 0.2rem;
    }

</style>
@endsection
