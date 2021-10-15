<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:authors',
        ]);

        $params = $request->except('_token');

        $author = Author::create($params);

        if (!$author) {
            return redirect()->back()->with([
                'message' => 'Error occurred while creating author.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.authors.index')->with([
            'message' => 'Author added successfully',
            'alert-type' => 'success'
        ]);

    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:authors,name,' . $author->id,
        ]);

        $params = $request->except('_token');

        $author = $author->update($params);

        if (!$author) {
            return redirect()->back()->with([
                'message' => 'Error occurred while updating author.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.authors.index')->with([
            'message' => 'Author updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Author $author)
    {
        $author = $author->delete();

        if (!$author) {
            return redirect()->back()->with([
                'message' => 'Error occurred while deleting author.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.authors.index')->with([
            'message' => 'Author deleted successfully',
            'alert-type' => 'success'
        ]);

    }

}
