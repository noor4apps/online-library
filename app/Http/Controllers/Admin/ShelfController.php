<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Shelf;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    public function index()
    {
        $shelves = Shelf::With('category')->get();
        return view('admin.shelves.index', compact('shelves'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.shelves.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:shelves',
            'category_id' => 'required',
        ]);

        $params = $request->except('_token');

        $shelve = Shelf::create($params);

        if (!$shelve) {
            return redirect()->back()->with([
                'message' => 'Error occurred while creating shelf.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.shelves.index')->with([
            'message' => 'Shelf added successfully',
            'alert-type' => 'success'
        ]);
    }

    public function edit(shelf $shelf)
    {
        $categories = Category::all();
        return view('admin.shelves.edit', compact('shelf', 'categories'));
    }

    public function update(Request $request, Shelf $shelf)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:shelves,name,' . $shelf->id,
            'category_id' => 'required',
        ]);

        $params = $request->except('_token');

        $shelve = $shelf->update($params);

        if (!$shelve) {
            return redirect()->back()->with([
                'message' => 'Error occurred while updating shelf.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.shelves.index')->with([
            'message' => 'Shelf updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Shelf $shelf)
    {
        $shelf = $shelf->delete();

        if (!$shelf) {
            return redirect()->back()->with([
                'message' => 'Error occurred while deleting shelf.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.shelves.index')->with([
            'message' => 'Shelf deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
