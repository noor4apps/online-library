@extends('admin.layouts.app')
@section('title') {{ __('Customers') }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users"></i> {{  __('Customers') }}</h1>
            <p>{{ __('List of all Customers') }}</p>
        </div>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary pull-right">Add Customer</a>
    </div>
    @include('partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Contact number</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->contact_number }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->email }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this customer?') ) { document.getElementById('customer-delete-{{ $customer->id }}').submit(); } else { return false; }"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="post" id="customer-delete-{{ $customer->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
