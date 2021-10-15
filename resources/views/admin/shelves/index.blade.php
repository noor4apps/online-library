@extends('admin.layouts.app')
@section('title') {{ __('Shelves') }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-archive"></i> {{  __('Shelves') }}</h1>
            <p>{{ __('List of all shelves') }}</p>
        </div>
        <a href="{{ route('admin.shelves.create') }}" class="btn btn-primary pull-right">Add Shelf</a>
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
                                <th> Category </th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shelves as $shelve)
                                <tr>
                                    <td>{{ $shelve->id }}</td>
                                    <td>{{ $shelve->name }}</td>
                                    <td>{{ $shelve->category->name }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.shelves.edit', $shelve->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this shelf?') ) { document.getElementById('shelf-delete-{{ $shelve->id }}').submit(); } else { return false; }"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('admin.shelves.destroy', $shelve->id) }}" method="post" id="shelf-delete-{{ $shelve->id }}">
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
