@extends('admin.layouts.app')
@section('title') {{ __('Authors') }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-pencil-square-o"></i> {{ __('Authors') }}</h1>
        </div>
    </div>
    @include('partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ __('Edit Author') }}: {{ $author->name }}</h3>
                <form action="{{ route('admin.authors.update', $author->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $author->name) }}"/>
                            @error('name') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Author</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.authors.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
