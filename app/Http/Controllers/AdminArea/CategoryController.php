<?php

namespace App\Http\Controllers\AdminArea;

use Illuminate\Http\Request;
use services\Callers\CategoryCaller;

class CategoryController extends ParentController
{
    public function all()
    {
        $response['categories'] = CategoryCaller::getAll();

        return view('AdminArea.pages.category.all')->with($response);
    }

    public function add()
    {
        return view('AdminArea.pages.category.add');
    }

    public function store(Request $request)
    {
        CategoryCaller::create($request->all());

        return redirect(route('admin.category.all'))->with('alert-success', "Category Added Successfully");
    }

    public function edit($id)
    {
        $response['category'] = CategoryCaller::get($id);

        return view('AdminArea.pages.category.edit')->with($response);
    }

    function update($id, Request $request)
    {
        $category = CategoryCaller::get($id);

        CategoryCaller::updateCategory($category, $request->all());

        return redirect(route('admin.category.all'))->with('alert-success', "Category Updated Successfully");
    }

    public function delete($id)
    {
        CategoryCaller::delete($id);

        return redirect(route('admin.category.all'))->with('alert-success', "Category Deleted Successfully");
    }
}
