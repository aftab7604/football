<?php

namespace services\CategoryService;

use App\Models\Category;
use Carbon\Carbon;

class CategoryService
{
    protected $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function get($id)
    {
        return $this->category->find($id);
    }

    public function getAll()
    {
        return $this->category->all();
    }

    public function create($data)
    {
        return $this->category->create($data);
    }


    public function updateCategory(Category $category, array $data)
    {
        return $category->update($this->editCategory($category, $data));
    }

    protected function editCategory(Category $category, $data)
    {
        return array_merge($category->toArray(), $data);
    }

    public function delete($id)
    {
        $category = $this->get($id);
        return $category->delete();
    }
}
