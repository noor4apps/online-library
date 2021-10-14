@extends('admin.layouts.app')
@section('title') {{ __('Publishers') }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-bookmark-o"></i> {{ __('Publishers') }}</h1>
        </div>
    </div>
    @include('partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ __('Edit Publisher') }}: {{ $publisher->name }}</h3>
                <form action="{{ route('admin.publishers.update', $publisher->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name', $publisher->name) }}"/>
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="address">Address</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="address" id="address" value="{{ old('address', $publisher->address) }}"/>
                            @error('address') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email', $publisher->email) }}"/>
                            @error('email') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="contact_number">contact_number <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $publisher->contact_number) }}"/>
                            @error('contact_number') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Publisher</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.publishers.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
