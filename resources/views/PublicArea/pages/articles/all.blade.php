@extends('PublicArea.layouts.app')
@section('title')
Football-Today | Articles
@endsection
@section('content')


<div class="row mt-3">
    <div class="col-md-12">
        <div class="card align-middle title-band text-white">
            <h5 class="text-left px-2 py-4">Articles</h5>
        </div>
        <div id="articles_list" class="row">
            <div class="col-md-8">
                <div class="my-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-between">
                                <div class="col-md-6 text-left">
                                    <div class="form-group">
                                        <select class="form-control-sm" name="sorting" id="sorting"
                                            onchange="sort(this.value)">
                                            <option value="desc" {{$sorting == "desc" ? 'selected' : ''}}>Latest
                                            </option>
                                            <option value="asc" {{$sorting == "asc" ? 'selected' : ''}}>Earliest
                                            </option>
                                            <option value="most_clicked"
                                                {{$sorting == "most_clicked" ? 'selected' : ''}}>
                                                Most views
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <div class="form-group">
                                        <select class="form-control-sm" name="filter" id="filter"
                                            onchange="filterCategory(this.value)">
                                            <option value="all" {{$filter == "all" ? 'selected' : ''}}>All</option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}"
                                                {{$filter == $category->id ? 'selected' : ''}}>
                                                {{$category->title}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table>
                                        <tbody>
                                            @foreach ($articles as $article)
                                            <tr class="clickable"
                                                onclick="showArticle('{{str_replace(' ', '_', $article->title)}}')">
                                                <td>
                                                    <img src="{{$article->image?asset('uploads/'.$article->image):''}}"
                                                        width=100% alt="article image">
                                                </td>
                                                <td class="special_td text-left">
                                                    <div class="row ml-2 mr-0 px-0">
                                                        <span>
                                                            <h4>{{$article->title}}</h4>
                                                            <span
                                                                class="badge badge-success">{{$article->category?$article->category->title : ''}}</span>&nbsp;<small>{{$article->created_at}}</small>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                                    <h6 class="text-left">Recommendations</h6>
                                    <table class="mt-4">
                                        <tbody>
                                            @forelse ($recommended_articles as $article)
                                            <tr class="clickable"
                                                onclick="showArticle('{{str_replace(' ', '_', $article->title)}}')">
                                                <td>
                                                    <img class="rec_img"
                                                        src="{{$article->image?asset('uploads/'.$article->image):''}}"
                                                        alt="article image">
                                                </td>
                                                <td class="special_td text-left">
                                                    <div class="row ml-2 mr-0 px-0">
                                                        <span>
                                                            <h6 class="article_title">{{$article->title}}</h6>
                                                            <span class="badge badge-success">
                                                                {{$article->category?(strlen($article->category->title) > 12 ? substr($article->category->title, 0, 12).'...' : $article->category->title) : ''}}
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
                                            @endforelse </tbody>
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
    var sorting = '{{ $sorting }}';
    var filter = '{{ $filter }}';

    function showArticle(title) {
        window.location.href = '{{ url("articles") }}/' + title;

    }

    function sort(sort_val) {
        document.cookie = "sorting=" + sort_val;
        document.cookie = "filter=" + filter;
        location.reload();
    }

    function filterCategory(filter_val) {
        document.cookie = "sorting=" + sorting;
        document.cookie = "filter=" + filter_val;
        location.reload();
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
