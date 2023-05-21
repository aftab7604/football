<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use services\Callers\ArticleCaller;
use services\Callers\CategoryCaller;

class ArticleController extends Controller
{
    public function allArticles()
    {
        if (isset($_COOKIE["sorting"]) && isset($_COOKIE["filter"])) {
            $sorting = $_COOKIE["sorting"] ? $_COOKIE["sorting"] : 'desc';
            $filter = $_COOKIE["filter"] ? $_COOKIE["filter"] : 'all';
        } else {
            $sorting = "desc";
            $filter = "all";
        }

        $response['sorting'] = $sorting;
        $response['filter'] = $filter;

        $response['articles'] = ArticleCaller::getAllArticles($sorting, $filter);
        $response['categories'] = CategoryCaller::getAll();

        $response['recommended_articles'] = ArticleCaller::getAllRecommendedArticles();

        return view('PublicArea.pages.articles.all')->with($response);
    }

    public function getArticle($title)
    {
        $title = str_replace('_', ' ', $title);
        $response['article'] = ArticleCaller::getByTitle($title);

        $response['relevant_articles'] = ArticleCaller::getAllReleventArticles($response['article']->id);
        $response['recommended_articles'] = ArticleCaller::getAllRecommendedArticles($response['article']->id);

        return view('PublicArea.pages.articles.article')->with($response);
    }
}
