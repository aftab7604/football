<?php

namespace App\Http\Controllers\AdminArea;

use App\Models\Article;
use Illuminate\Http\Request;
use services\Callers\ArticleCaller;
use services\Callers\CategoryCaller;
use services\Callers\ImageCaller;

class ArticleController extends ParentController
{
    public function all()
    {
        $response['articles'] = ArticleCaller::getAll();

        return view('AdminArea.pages.article.all')->with($response);
    }

    public function add()
    {
        $response['categories'] = CategoryCaller::getAll();

        return view('AdminArea.pages.article.add')->with($response);
    }

    public function store(Request $request)
    {
        if ($request->has('image1')) {
            $request['image'] = ImageCaller::up($request->file('image1'))['data'];
        }

        if ($request->has('recommended')) {
            $request['recommended'] = 1;
        } else {
            $request['recommended'] = 0;
        }

        if ($request->has('published')) {
            $request['status'] = Article::STATUS['PUBLISHED'];
        } else {
            $request['status'] = Article::STATUS['NOT_PUBLISHED'];
        }

        ArticleCaller::create($request->all());

        return redirect(route('admin.article.all'))->with('alert-success', "Article Added Successfully");
    }

    public function edit($id)
    {
        $response['article'] = ArticleCaller::get($id);
        $response['categories'] = CategoryCaller::getAll();

        return view('AdminArea.pages.article.edit')->with($response);
    }

    function update($id, Request $request)
    {
        if ($request->has('image1')) {
            $request['image'] = ImageCaller::up($request->file('image1'))['data'];
        }

        if ($request->has('recommended')) {
            $request['recommended'] = 1;
        } else {
            $request['recommended'] = 0;
        }

        if ($request->has('published')) {
            $request['status'] = Article::STATUS['PUBLISHED'];
        } else {
            $request['status'] = Article::STATUS['NOT_PUBLISHED'];
        }

        $article = ArticleCaller::get($id);

        ArticleCaller::updateArticle($article, $request->all());

        return redirect(route('admin.article.all'))->with('alert-success', "Article Updated Successfully");
    }

    public function delete($id)
    {
        ArticleCaller::delete($id);

        return redirect(route('admin.article.all'))->with('alert-success', "Article Deleted Successfully");
    }

    public function uploadImage(Request $request)
    {
        return ArticleCaller::uploadImages($request);
    }
}
