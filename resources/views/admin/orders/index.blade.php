@extends('admin.layouts.app')
@section('title') {{ __('Orders') }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-inbox"></i> {{  __('Orders') }}</h1>
            <p>{{ __('List of all orders') }}</p>
        </div>
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
                                <th>Checkout</th>
                                <th>Status</th>
                                <th>Returned</th>
                                <th>Issue</th>
                                <th>User</th>
                                <th>Book</th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        @if($order->checkout) {{ date('Y-m-d h:i:s a', strtotime($order->checkout)) }} @endif
                                    </td>
                                    <td style="font-size:1.3rem ;color: #f1f1f1 ;background-color: @if($order->status == 'submitting') #f8961e @elseif($order->status == 'checkout') #f94144 @else #90be6d @endif">
                                        {{ $order->status }}
                                    </td>
                                    <td>
                                        @if($order->date_returned) {{ date('Y-m-d h:i:s a', strtotime($order->date_returned)) }} @endif
                                    </td>
                                    <td>{{ $order->issue }}</td>
                                    <td>{{ $order->userName($order->user_id) }}</td>
                                    <td>{{ $order->bookTitle($order->book_id) }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this order?') ) { document.getElementById('order-delete-{{ $order->id }}').submit(); } else { return false; }"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="post" id="order-delete-{{ $order->id }}">
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
