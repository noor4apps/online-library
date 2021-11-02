<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('is_admin', 0)->get();
        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'contact_number' => 'required',
            'address' => 'nullable',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $params = $request->except('_token');

        $result = User::create($params);

        if (!$result) {
            return redirect()->back()->with([
                'message' => 'Error occurred while creating member.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.members.index')->with([
            'message' => 'Member added successfully',
            'alert-type' => 'success'
        ]);

    }

    public function edit(User $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, User $member)
    {
        $this->validate($request, [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'contact_number' => 'required',
            'address' => 'nullable',
            'email' => 'required|unique:users,email,' . $member->id,
            'password' => 'required',
        ]);

        $params = $request->except(['_token', 'password']);

        $params['password'] = bcrypt($request->password);

        $result = $member->update($params);

        if (!$result) {
            return redirect()->back()->with([
                'message' => 'Error occurred while updating member.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.members.index')->with([
            'message' => 'Member updated successfully',
            'alert-type' => 'success'
        ]);

    }

    public function destroy(user $member)
    {
        $result = $member->delete();

        if (!$result) {
            return redirect()->back()->with([
                'message' => 'Error occurred while deleting member.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.members.index')->with([
            'message' => 'Member deleted successfully',
            'alert-type' => 'success'
        ]);

    }


}
