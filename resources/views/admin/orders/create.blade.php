@extends('admin.layouts.app')
@section('title')  @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-inbox"></i> </h1>
        </div>
    </div>
    @include('partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
        </div>
    </div>
@endsection
@push('scripts')

@endpush
