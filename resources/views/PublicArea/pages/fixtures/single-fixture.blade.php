@extends('PublicArea.layouts.app')
@section('title')
Football-Today
@endsection
@section('content')


<div class="row mt-3">
    <div class="col-md-12">
        <div id="fixture_info" class="row">
            <div class="col-md-12 text-center my-2">
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
    var intervalId = window.setInterval(function () {
        getFixture();
    }, 300000);

    $(document).ready(function () {
        getFixture();
    });

    function getFixture() {
        $.ajax({
            url: "{{ route('public.fixture.get.ajax', $id) }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            dataType: 'html',
            success: function (response) {
                $('#fixture_info').html(response);
                predictionChart();
            }
        });
    }

    function predictionChart() {
        const labels = ['Strength', 'Attacking Potential', 'Defensive Potential', 'Poisson Distribution',
            'Strength H2H',
            'Goals H2H', 'Wins the Game'
        ];

        var home_data = @php echo json_encode($predictions_array['home']);
        @endphp;
        var away_data = @php echo json_encode($predictions_array['away']);
        @endphp;

        const data = {
            labels: labels,
            datasets: [{
                    label: "{{$predictions[0]->teams->home->name}}",
                    data: home_data,
                    borderColor: '#12e5fa',
                    backgroundColor: 'rgba(18, 229, 250, 0.5)',
                },
                {
                    label: '{{$predictions[0]->teams->away->name}}',
                    data: away_data,
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220, 53, 69, 0.5)',
                }
            ]
        };

        const config = {
            type: 'radar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: false,
                        text: ''
                    }
                }
            },
        };

        var predictionChartDiagram = new Chart(
            document.getElementById('predictionChart'),
            config
        );
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

    .nav-pills .nav-link {
        color: #000;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #12e5fa;
    }

    #fixture_info {
        min-height: 75vh;
    }

    .team-logo {
        width: 40%;
    }

    .team-logo-h2h {
        width: 100%;
    }

    .team-logo-standing {
        width: 7%;
    }

    .scorer-name {
        min-width: 7rem;
    }

    .h2h_table td,
    .h2h_table th {
        vertical-align: middle !important;
        font-size: 1.3rem;
    }

    @media (max-width: 780.98px) {
        .team-logo {
            width: 100%;
        }

        .team-logo-standing {
            width: 15%;
        }

        .mobile-resp {
            max-width: 30%;
        }

        .team-text {
            font-size: 1rem;
        }

        .score-text {
            font-size: 1rem;
        }

        .time-text {
            font-size: 1.2rem;
        }

        .stats-table td,
        .stats-table th {
            padding: 0.35rem !important;
        }

        .h2h_table td,
        .h2h_table th {
            vertical-align: middle !important;
            font-size: 0.8rem;
        }
    }

    .player_link {
        text-decoration: none;
        color: #000;
    }

    .player_link:hover {
        text-decoration: none;
        color: #000;
    }

    .table td,
    .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }

</style>
@endsection
