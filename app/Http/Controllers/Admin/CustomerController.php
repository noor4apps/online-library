<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('is_admin', 0)->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
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
                'message' => 'Error occurred while creating customer.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.customers.index')->with([
            'message' => 'Customer added successfully',
            'alert-type' => 'success'
        ]);

    }

    public function edit(User $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, User $customer)
    {
        $this->validate($request, [
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'contact_number' => 'required',
            'address' => 'nullable',
            'email' => 'required|unique:users,email,' . $customer->id,
            'password' => 'required',
        ]);

        $params = $request->except(['_token', 'password']);

        $params['password'] = bcrypt($request->password);

        $result = $customer->update($params);

        if (!$result) {
            return redirect()->back()->with([
                'message' => 'Error occurred while updating customer.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.customers.index')->with([
            'message' => 'Customer updated successfully',
            'alert-type' => 'success'
        ]);

    }

    public function destroy(user $customer)
    {
        $result = $customer->delete();

        if (!$result) {
            return redirect()->back()->with([
                'message' => 'Error occurred while deleting customer.',
                'alert-type' => 'error'
            ]);
        }
        return redirect()->route('admin.customers.index')->with([
            'message' => 'Customer deleted successfully',
            'alert-type' => 'success'
        ]);

    }


}
