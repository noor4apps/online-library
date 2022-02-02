@extends('admin.layouts.app')
@section('title') {{ __('Orders') }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-inbox"></i> {{ __('Orders') }}</h1>
        </div>
    </div>
    @include('partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ __('Edit Order') }}: {{ $order->user->full_name }}</h3>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="tile-body">

                        <div class="form-group">
                            <label class="control-label" for="status">Status <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('publisher_id') is-invalid @enderror" type="text" name="status" id="status" value="{{ old('status') }}">
                                    <option value="submitting" {{ $order->status == 'submitting' ? 'selected' : '' }}>submitting</option>
                                    <option value="checkout" {{ $order->status == 'checkout' ? 'selected' : '' }}>checkout</option>
                                    <option value="returned" {{ $order->status == 'returned' ? 'selected' : '' }}>returned</option>
                            </select>
                            @error('Status') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="issue">Issue <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('issue') is-invalid @enderror" type="text" name="issue" id="issue" value="{{ old('issue', $order->issue) }}"/>
                            @error('issue') {{ $message }} @enderror
                        </div>

                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Order</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.orders.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
