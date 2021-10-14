<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{

    public function index()
    {
        $publishers = Publisher::all();
        return view('admin.publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('admin.publishers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'address' => 'nullable',
            'email' => 'nullable|email',
            'contact_number' => 'required',
        ]);

        $params = $request->except('_token');

        $publisher = Publisher::create($params);

        if (!$publisher) {
            return redirect()->back()->with([
                'message' => 'Error occurred while creating publisher.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.publishers.index')->with([
            'message' => 'Publisher added successfully',
            'alert-type' => 'success'
        ]);
    }

    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit', compact('publisher'));
    }

    public function update(Request $request, Publisher $publisher)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'address' => 'nullable',
            'email' => 'nullable|email',
            'contact_number' => 'required',
        ]);

        $params = $request->except('_token');

        $category = $publisher->update($params);

        if (!$category) {
            return redirect()->back()->with([
                'message' => 'Error occurred while updating publisher.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->back()->with([
            'message' => 'Publisher updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Publisher $publisher)
    {
        $publisher = $publisher->delete();

        if (!$publisher) {
            return redirect()->back()->with([
                'message' => 'Error occurred while deleting publisher.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.publishers.index')->with([
            'message' => 'Publisher deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
