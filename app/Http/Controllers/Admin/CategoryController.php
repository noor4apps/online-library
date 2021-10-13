<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:categories',
        ]);

        $params = $request->except('_token');

        $category = Category::create($params);

        if (!$category) {
            return redirect()->back()->with([
                'message' => 'Error occurred while creating category.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.categories.index')->with([
            'message' => 'Category added successfully',
            'alert-type' => 'success'
        ]);

    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:categories,name,' . $category->id,
        ]);

        $params = $request->except('_token');

        $category = $category->update($params);

        if (!$category) {
            return redirect()->back()->with([
                'message' => 'Error occurred while updating category.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->back()->with([
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        ]);

    }

    public function destroy(Category $category)
    {
        $category = $category->delete();

        if (!$category) {
            return redirect()->back()->with([
                'message' => 'Error occurred while deleting category.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.categories.index')->with([
            'message' => 'Category deleted successfully',
            'alert-type' => 'success'
        ]);

    }

}
