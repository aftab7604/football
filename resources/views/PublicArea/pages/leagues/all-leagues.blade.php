@extends('PublicArea.layouts.app')
@section('title')
Football-Today | Leagues
@endsection
@section('content')


<div class="row mt-3">
    <div class="col-md-10">
        <div class="card align-middle title-band text-white">
            <h5 class="text-left px-2 py-4">Leagues</h5>
        </div>
        <div id="leagues_list" class="my-3">
            <div class="text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        getAllLeagues();
    });

    function getAllLeagues() {
        $.ajax({
            url: "{{ route('public.leagues.ajax') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            dataType: 'html',
            success: function (response) {
                $('#leagues_list').html(response);
            }
        });
    }

</script>
@endsection
@section('css')
<style>
    .title-band {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
        url("{{asset('PublicArea/img/soccer-bg.png')}}");
        background-size: cover;
        background-position: center;
    }

    #leagues_list {
        min-height: 65vh;
    }

    .card-header {
        background-color: rgba(0, 0, 0, .8);
    }

    #DataTables_Table_0_length {
        text-align: left !important;
    }

</style>
@endsection
