@extends('site.layouts.app')
@section('title') Book @endsection

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <div class="py-5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->

    <!-- Start main Content -->
    <div class="maincontent bg--white pt--80 pb--55">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto col-12">
                    <div class="wn__single__product">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="product__thumb">
                                    @if($book->cover)
                                        <img src="{{ $book->img_full_path }}" alt="product image">
                                    @else
                                        <img src="{{asset('frontend/images/books/1.jpg')}}" alt="product image">
                                    @endif
                                </div>
                                <div class="pt-5 text-center">
                                    <a href="#"><i class="bi bi-heart-beat mx-2" style="font-size: xxx-large"></i></a>
                                    @if($book->is_pdf)
                                        <a href="{{ $book->url }}" target="_blank" class="mx-2"><i class="fa fa-download" style="font-size: xxx-large"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-8 col-12">
                                <div class="product__info__main">
                                    <h1>{{ $book->title }}</h1>
                                    <div class="product-reviews-summary d-flex">
                                        <ul class="rating-summary d-flex">
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li class="off"><i class="zmdi zmdi-star-outline"></i></li>
                                            <li class="off"><i class="zmdi zmdi-star-outline"></i></li>
                                        </ul>
                                    </div>
                                    <div class="product__overview">
                                        <div>
                                            <span class="font-weight-bold">ISBN: </span><span> {{ $book->isbn }}</span>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">Edition: </span><span> {{ $book->edition }}</span>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">Volume: </span><span> {{ $book->volume }}</span>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">Quantity: </span><span> {{ $book->quantity }}</span>
                                        </div>
                                        <div class="font-weight-bold">Authors:
                                            @foreach($book->authors as $category)
                                                <span class="badge badge-info p-1">{{ $category->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="product_meta">
                                        <span class="posted_in">Categories:<br>
                                            @foreach($book->categories as $category)
                                                <span class="badge badge-dark p-1">{{ $category->name }}</span>
                                                <span class="posted_in">In shelf:
                                                @foreach($category->shelf as $shelf)
                                                    <span class="badge badge-light p-1">{{ $shelf->name }}</span>
                                                @endforeach
                                                </span>
                                                <br>
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
