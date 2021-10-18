@extends('admin.layouts.app')
@section('title') {{ __('Books') }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-book"></i> {{  __('Books') }}</h1>
            <p>{{ __('Show book') }}</p>
        </div>
        <a class="btn btn-secondary" href="{{ route('admin.books.index') }}"><i
                class="fa fa-fw fa-lg fa-backward"></i>Back</a>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <table class="table table-striped">
                    <tr>
                        <th>Title:</th>
                        <td>{{ $book->title }}</td>
                    </tr>
                    <tr>
                        <th>Publisher:</th>
                        <td>{{ $book->publisher->name }}</td>
                    </tr>
                    <tr>
                        <th>Authors:</th>
                        <td>
                            @foreach($book->authors as $author)
                                <span class="badge badge-secondary p-2"> {{ $author->name }} </span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Categories:</th>
                        <td>
                            @foreach($book->categories as $category)
                                <span class="badge badge-secondary p-2"> {{ $category->name }} </span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>ISBN:</th>
                        <td>{{ $book->isbn }}</td>
                    </tr>
                    <tr>
                        <th>Quantity:</th>
                        <td>{{ $book->quantity }}</td>
                    </tr>
                    <tr>
                        <th>Edition:</th>
                        <td>{{ $book->edition }}</td>
                    </tr>
                    <tr>
                        <th>Volume:</th>
                        <td>{{ $book->volume }}</td>
                    </tr>
                    @if($book->issue)
                        <tr>
                            <th>Issue:</th>
                            <td>{{ $book->issue }}</td>
                        </tr>
                    @endif
                    @if($book->is_pdf)
                        <tr>
                            <th>Is PDF:</th>
                            <td>
                                <i class="fa fa-check-square-o fa-lg"></i>
                            </td>
                        </tr>
                        <tr>
                            <th>URL:</th>
                            <td>{{ $book->url }}</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <div class="form-group">
                    <div class="row">
                        <h3 class="p-2">Cover: </h3>
                    </div>
                    <div class="row">
                        @if($book->cover)
                            <img src="{{ $book->img_full_path }}" style="width: 100%; height: auto;">
                        @else
                            <img src="https://via.placeholder.com/80x80?text=Placeholder+Image"
                                 style="width: 60%; height: auto;">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
