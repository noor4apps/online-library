@extends('admin.layouts.app')
@section('title') {{ __('Members') }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users"></i> {{ __('Members') }}</h1>
        </div>
    </div>
    @include('partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ __('Edit Member') }}: {{ $member->full_name }}</h3>
                <form action="{{ route('admin.members.update', $member->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="first_name">First Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" id="first_name" value="{{ old('first_name', $member->first_name) }}"/>
                            @error('first_name') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="last_name">Last Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" id="last_name" value="{{ old('last_name', $member->last_name) }}"/>
                            @error('last_name') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="contact_number">Contact Number <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('contact_number') is-invalid @enderror" type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $member->contact_number) }}"/>
                            @error('contact_number') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="address">Addressr </label>
                            <input class="form-control" type="text" name="address" id="address" value="{{ old('address', $member->address) }}"/>
                            @error('address') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="email">Email <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" value="{{ old('email', $member->email) }}"/>
                            @error('email') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="email">Password <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('contact_number') is-invalid @enderror" type="text" name="password" id="password" value="{{ old('password') }}"/>
                            @error('password') {{ $message }} @enderror
                        </div>
                    </div>

                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Member</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.members.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
