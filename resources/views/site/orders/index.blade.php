@extends('site.layouts.app')
@section('title') My Order @endsection

@section('content')

    <div class="ht__bradcaump__area bg-image--8">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.flash')

    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ol-lg-12">
                    <div class="table-content wnro__table table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Checkout</th>
                                <th>Status</th>
                                <th>Returned</th>
                                <th>Issue</th>
                                <th>Book</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>
                                        @if($order->checkout) {{ date('Y-m-d h:i:s a', strtotime($order->checkout)) }} @endif
                                    </td>
                                    <td style="color: #f1f1f1 ;background-color: @if($order->status == 'submitting') #FDB45C @elseif($order->status == 'checkout') #F7464A @else #46BFBD @endif">
                                        {{ $order->status }}
                                    </td>
                                    <td>
                                        @if($order->date_returned) {{ date('Y-m-d h:i:s a', strtotime($order->date_returned)) }} @endif
                                    </td>
                                    <td>{{ $order->issue }}</td>
                                    <td>{{ $order->books->first()->title }}</td>
                                    <td class="product-remove">
                                        @if($order->status == 'submitting')
                                            <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this order?') ) { document.getElementById('order-delete-{{ $order->id }}').submit(); } else { return false; }">X</a>
                                            <form action="{{ route('site.orders.destroy', $order->id) }}" method="post" id="order-delete-{{ $order->id }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
