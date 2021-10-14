@extends('admin.layouts.app')
@section('title'){{ __('Publishers') }}@endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-bookmark-o"></i> {{  __('Publishers') }}</h1>
            <p>{{ __('List of all publishers') }}</p>
        </div>
        <a href="{{ route('admin.publishers.create') }}" class="btn btn-primary pull-right">Add publisher</a>
    </div>
    @include('partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Address </th>
                            <th> Email </th>
                            <th> Contact number </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($publishers as $publisher)
                            <tr>
                                <td>{{ $publisher->id }}</td>
                                <td>{{ $publisher->name }}</td>
                                <td>{{ $publisher->address }}</td>
                                <td>{{ $publisher->email }}</td>
                                <td>{{ $publisher->contact_number }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('admin.publishers.edit', $publisher->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this publisher?') ) { document.getElementById('publisher-delete-{{ $publisher->id }}').submit(); } else { return false; }"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        <form action="{{ route('admin.publishers.destroy', $publisher->id) }}" method="post" id="publisher-delete-{{ $publisher->id }}">
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
