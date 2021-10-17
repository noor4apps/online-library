@extends('admin.layouts.app')
@section('title') {{ __('Books') }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-book"></i> {{  __('Books') }}</h1>
            <p>{{ __('List of all books') }}</p>
        </div>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary pull-right">Add Book</a>
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
                                <th>Title</th>
                                <th>QTY</th>
                                <th>Edition</th>
                                <th>Volume</th>
                                <th>Issue</th>
                                <th style="width:50px; width:50px;">Cover</th>
                                <th>PDF</th>
                                <th style="width:50px; width:50px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.books.show', $book->id) }}">{{ $book->title }}</a>
                                    </td>
                                    <td>{{ $book->quantity }}</td>
                                    <td>{{ $book->edition }}</td>
                                    <td>{{ $book->volume }}</td>
                                    <td>{{ $book->issue }}</td>
                                    <td style="padding: 0">
                                        @if($book->cover)
                                            <img src="{{ $book->img_full_path }}" style="width: 100%; height: auto;">
                                        @else
                                            <img src="https://via.placeholder.com/80x80?text=Placeholder+Image" style="width: 100%; height: auto;">
                                        @endif
                                    </td>
                                    <td style="padding: 0">
                                        @if($book->is_pdf == 1)
                                            <i class="fa fa-check-square-o fa-4x"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this book?') ) { document.getElementById('book-delete-{{ $book->id }}').submit(); } else { return false; }"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="post" id="book-delete-{{ $book->id }}">
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
