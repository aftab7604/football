@extends('PublicArea.layouts.app')
@section('title')
Football-Today | Bets
@endsection
@section('content')


<div class="row mt-3">
    <div class="col-md-12">
        <div class="card align-middle title-band text-white">
            <h5 class="text-left px-2 py-4">Free Bets & Offers</h5>
        </div>
        <div id="bets_list" class="row">
            <div class="col-md-12 d-none d-lg-block">
                <div class="my-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row justify-content-between">
                                <div class="col-md-12">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="width: 15%">
                                                    <img src="{{asset('PublicArea/img/bets/888-logo.png')}}"
                                                        width=100% alt="image">
                                                </td>
                                                <td class="special_td text-center">
                                                    <span>
                                                        <h4>£30 in free bets + £10 in casino bonus when you place your first £10 bet</h4>
                                                    </span>
                                                </td>
                                                <td style="width: 20%">
                                                    <a class="btn btn-success" target="_blank"
                                                    href="https://www.888sport.com/spt/betget-offer.htm?utm_campaign=100138146_1851819_nodescription&utm_content=100138146&utm_medium=casap&utm_source=aff_na"
                                                    style="width: 100%">Get Offer</a>
                                                </td>
                                            <tr class="desc">
                                                <td colspan="3">
                                                    <small>
                                                        Min deposit £10 • A qualifying bet is a ‘real money’ stake of at least £10 • Min odds 1/2 (1.50) • Free Bets credited upon qualifying bet settlement and expire after 7 days • Free Bet stakes not included in returns • Casino Bonus must be claimed within 7 days and expires after 14 days • To withdraw any winnings from the Casino Bonus, wager the Bonus amount 40 times within 14 days • Withdrawal restrictions, payment methods, country & Full T&Cs apply.
                                                    </small>
                                                </td>
                                            </tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-block d-lg-none">
                <div class="my-3">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row justify-content-between">
                                <div class="col-md-12">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td style="width: 40%">
                                                    <img src="{{asset('PublicArea/img/bets/888-logo.png')}}"
                                                        width=100% alt="image">
                                                </td>
                                                <td class="text-center">
                                                    <span>
                                                        <h4>£30 in free bets + £10 in casino bonus when you place your first £10 bet</h4>
                                                    </span>
                                                    <a class="btn btn-success" target="_blank"
                                                    href="https://www.888sport.com/spt/betget-offer.htm?utm_campaign=100138146_1851819_nodescription&utm_content=100138146&utm_medium=casap&utm_source=aff_na"
                                                    style="width: 100%">Get Offer</a>
                                                </td>
                                            <tr class="desc">
                                                <td colspan="2">
                                                    <small>
                                                        Min deposit £10 • A qualifying bet is a ‘real money’ stake of at least £10 • Min odds 1/2 (1.50) • Free Bets credited upon qualifying bet settlement and expire after 7 days • Free Bet stakes not included in returns • Casino Bonus must be claimed within 7 days and expires after 14 days • To withdraw any winnings from the Casino Bonus, wager the Bonus amount 40 times within 14 days • Withdrawal restrictions, payment methods, country & Full T&Cs apply.
                                                    </small>
                                                </td>
                                            </tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>

</script>
@endsection
@section('css')
<style>
    .title-band {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
        url("{{asset('PublicArea/img/article_bg.jpg')}}");
        background-size: cover;
        background-position: center;
    }

    table {
        width: 100%;
        border-collapse: unset;
    }

    #bets_list {
        min-height: 65vh;
    }

    .desc {
        background-color: rgba(0, 0, 0, 0.1)
    }

    .card-header {
        background-color: rgba(0, 0, 0, .8);
    }

    .clickable {
        cursor: pointer;
    }

    .special_td {
        width: 50%;
    }

    td {
        padding: 10px;
    }

    tr {
        border-bottom: 0.1px solid rgb(126 126 126 / 28%);
    }

    .rec_img {
        width: 5rem;
    }

    @media (max-width: 780.98px) {

        .special_td {
            width: 66% !important;
        }
    }

    @media (max-width: 1024px) {

        .rec_img {
            width: 3rem !important;
        }

        .article_title {
            font-size: 0.8rem !important;
        }
    }

</style>
@endsection
