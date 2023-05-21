<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/')->namespace('App\Http\Controllers\PublicArea')->group(function () {

    // routes for fixtures
    Route::get('/', 'FixtureController@fixtures')->name('public.fixtures');
    Route::get('/fixtures/ajax', 'FixtureController@fixturesAjax')->name('public.fixtures.ajax');
    Route::get('/fixture/{id}', 'FixtureController@getFixture')->name('public.fixture.get');
    Route::get('/fixture/ajax/{id}', 'FixtureController@getFixtureAjax')->name('public.fixture.get.ajax');

    // routes for leagues
    Route::get('/leagues', 'LeaguesController@leagues')->name('public.leagues');
    Route::get('/leagues/ajax', 'LeaguesController@leaguesAjax')->name('public.leagues.ajax');
    Route::get('/leagues/{nation}/{league_name}', 'LeaguesController@getLeague')->name('public.league.get');
    Route::get('/leagues/call/ajax/{id}', 'LeaguesController@getLeagueAjax')->name('public.league.get.ajax');

    // routes for teams
    Route::get('/team/{nation}/{club}/{id}', 'TeamsController@getTeam')->name('public.team.get');
    Route::get('/team/ajax/{id}', 'TeamsController@getTeamAjax')->name('public.team.get.ajax');

    // routes for articles
    Route::get('/articles', 'ArticleController@allArticles')->name('public.articles.all');
    Route::get('/articles/{title}', 'ArticleController@getArticle')->name('public.articles.get');

    // routes for search
    Route::get('/search', 'SearchController@search')->name('public.search.all');

    // routes for bets
    Route::get('/bets', 'BetsController@bets')->name('public.bets.all');
});

Auth::routes();

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is the Admin routes
|
*/
Route::prefix('/admin')->namespace('App\Http\Controllers\AdminArea')->group(function () {

    Route::get('/', 'HomeController@index')->name('admin.index');

    Route::prefix('/category/article')->group(function () {
        Route::get('/', 'CategoryController@all')->name('admin.category.all');
        Route::get('/add', 'CategoryController@add')->name('admin.category.add');
        Route::post('/store', 'CategoryController@store')->name('admin.category.store');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('admin.category.edit');
        Route::post('/update/{id}', 'CategoryController@update')->name('admin.category.update');
        Route::get('/delete/{id}', 'CategoryController@delete')->name('admin.category.delete');
    });

    Route::prefix('/article')->group(function () {
        Route::get('/', 'ArticleController@all')->name('admin.article.all');
        Route::get('/add', 'ArticleController@add')->name('admin.article.add');
        Route::post('/store', 'ArticleController@store')->name('admin.article.store');
        Route::get('/edit/{id}', 'ArticleController@edit')->name('admin.article.edit');
        Route::post('/update/{id}', 'ArticleController@update')->name('admin.article.update');
        Route::get('/delete/{id}', 'ArticleController@delete')->name('admin.article.delete');
        Route::post('/image/upload', 'ArticleController@uploadImage')->name('admin.article.image.upload');
    });
});
