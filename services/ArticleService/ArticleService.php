<?php

namespace services\ArticleService;

use App\Models\Article;
use Carbon\Carbon;
use services\Callers\ImageCaller;

class ArticleService
{
    protected $article;

    public function __construct()
    {
        $this->article = new Article();
    }

    public function get($id)
    {
        return $this->article->find($id);
    }

    public function getByTitle($title)
    {
        return $this->article->where('title', $title)->first();
    }

    public function getAll()
    {
        return $this->article->all();
    }

    public function create($data)
    {
        return $this->article->create($data);
    }


    public function updateArticle(Article $article, array $data)
    {
        return $article->update($this->editArticle($article, $data));
    }

    protected function editArticle(Article $article, $data)
    {
        return array_merge($article->toArray(), $data);
    }

    public function delete($id)
    {
        $article = $this->get($id);
        return $article->delete();
    }

    public function getAllArticles($sorting, $filter)
    {
        if ($sorting == "most_clicked") {
            if ($filter == "all") {
                return $this->article->where('status', Article::STATUS['PUBLISHED'])->orderBy('views', 'desc')->get();
            }

            return $this->article->where('status', Article::STATUS['PUBLISHED'])->where('category_id', $filter)->orderBy('views', 'desc')->get();
        } else {
            if ($filter == "all") {
                return $this->article->where('status', Article::STATUS['PUBLISHED'])->orderBy('created_at', $sorting)->get();
            }

            return $this->article->where('status', Article::STATUS['PUBLISHED'])->where('category_id', $filter)->orderBy('created_at', $sorting)->get();
        }
    }

    public function getAllRecommendedArticles($id = null)
    {
        if ($id) {
            return $this->article->where('status', Article::STATUS['PUBLISHED'])->where('id', '!=', $id)->where('recommended', Article::RECOMMENDED['YES'])->orderBy('created_at', 'desc')->paginate(4);
        }

        return $this->article->where('status', Article::STATUS['PUBLISHED'])->where('recommended', Article::RECOMMENDED['YES'])->orderBy('created_at', 'desc')->get();
    }

    public function getAllReleventArticles($id = null)
    {
        if ($id) {
            $article = $this->get($id);
            return $this->article->where('status', Article::STATUS['PUBLISHED'])->where('id', '!=', $id)->where('category_id', $article->category_id)->orderBy('created_at', 'desc')->paginate(4);
        }

        return $this->article->where('status', Article::STATUS['PUBLISHED'])->where('recommended', Article::RECOMMENDED['YES'])->orderBy('created_at', 'desc')->get();
    }

    public function uploadImages($request)
    {
        if ($request->hasFile('upload')) {
            $filenametostore = ImageCaller::up($request->file('upload'))['data'];

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('uploads/' . $filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}
