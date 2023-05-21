@extends('PublicArea.layouts.app')
@section('title')
Football-Today | Article
@endsection
@section('content')


<div class="row mt-3">
    <div class="col-md-12">
        <div class="card align-middle title-band text-white">
            <h5 class="text-left px-2 py-4">Article</h5>
        </div>
        <div id="articles_list" class="row">
            <div class="col-md-8">
                <div class="my-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-md-12 text-left">
                                    <span>
                                        <h2>{{$article->title}}</h2>
                                        <div class="row">
                                            <div class="col-md-12 text-center mt-2">
                                                <img src="{{$article->image?asset('uploads/'.$article->image):''}}"
                                                    width=50% alt="article image">
                                            </div>
                                            <div class="col-md-12 my-3">
                                                <span>
                                                    {!! $article->description !!}
                                                </span>
                                            </div>
                                        </div>


                                        <br>
                                        <span
                                            class="badge
                                            badge-success">{{$article->category?$article->category->title : ''}}</span>&nbsp;|&nbsp;<small>{{$article->created_at}}</small>
                                    </span>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="my-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-md-12">
                                    <h6 class="text-left">Relevant Articles</h6>
                                    <table class="mt-4">
                                        <tbody>
                                            @forelse ($relevant_articles as $rel_article)
                                            <tr class="clickable"
                                                onclick="showArticle('{{str_replace(' ', '_', $rel_article->title)}}')">
                                                <td>
                                                    <img class="rec_img"
                                                        src="{{$rel_article->image?asset('uploads/'.$rel_article->image):''}}"
                                                        alt="article image">
                                                </td>
                                                <td class="special_td text-left">
                                                    <div class="row ml-2 mr-0 px-0">
                                                        <span>
                                                            <h6 class="article_title">{{$rel_article->title}}</h6>
                                                            <span class="badge badge-success">
                                                                {{$rel_article->category?(strlen($rel_article->category->title) > 12 ? substr($rel_article->category->title, 0, 12).'...' : $rel_article->category->title) : ''}}
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="2" class="text-center pb-3">
                                                    No Article
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <h6 class="text-left">Recommendations</h6>
                                    <table class="mt-4">
                                        <tbody>
                                            @forelse ($recommended_articles as $rec_article)
                                            <tr class="clickable"
                                                onclick="showArticle('{{str_replace(' ', '_', $rec_article->title)}}')">
                                                <td>
                                                    <img class="rec_img"
                                                        src="{{$rec_article->image?asset('uploads/'.$rec_article->image):''}}"
                                                        alt="article image">
                                                </td>
                                                <td class="special_td text-left">
                                                    <div class="row ml-2 mr-0 px-0">
                                                        <span>
                                                            <h6 class="article_title">{{$rec_article->title}}</h6>
                                                            <span class="badge badge-success">
                                                                {{$rec_article->category?(strlen($rec_article->category->title) > 12 ? substr($rec_article->category->title, 0, 12).'...' : $rec_article->category->title) : ''}}
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    No Article
                                                </td>
                                            </tr>
                                            @endforelse
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
    function showArticle(title) {
        window.location.href = '{{ url("articles") }}/' + title;

    }

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
    }

    #articles_list {
        min-height: 65vh;
    }

    .card-header {
        background-color: rgba(0, 0, 0, .8);
    }

    .clickable {
        cursor: pointer;
    }

    .special_td {
        width: 76%;
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
