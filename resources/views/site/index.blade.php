@extends('site.layouts.app')
@section('title') Home @endsection

@section('content')

    <!-- Start Slider area -->
    <div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
        <!-- Start Single Slide -->
        <div class="slide animation__style10 bg-image--1 fullscreen align__center--left">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider__content">
                            <div class="contentbox">
                                <h2>Borrow <span>your </span></h2>
                                <h2>favorite <span>Book </span></h2>
                                <h2>from <span>Here </span></h2>
                                <a class="shopbtn" href="{{ route('site.grid') }}">choose now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slide -->
        <!-- Start Single Slide -->
        <div class="slide animation__style10 bg-image--7 fullscreen align__center--left">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="slider__content">
                            <div class="contentbox">
                                <h2>Borrow <span>your </span></h2>
                                <h2>favorite <span>Book </span></h2>
                                <h2>from <span>Here </span></h2>
                                <a class="shopbtn" href="{{ route('site.grid') }}">choose now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Single Slide -->
    </div>
    <!-- End Slider area -->

    @include('partials.flash')

    <!-- Start BEst Seller Area -->
    <section class="wn__product__area brown--color pt--80  pb--30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section__title text-center">
                        <h2 class="title__be--2">New <span class="color--theme">Books</span></h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
                    </div>
                </div>
            </div>
            <!-- Start Single Tab Content -->
            <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
                <!-- Start Single Product -->
                @foreach($books as $book)
                    <div class="product product__style--3">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="product__thumb">
                                @if($book->cover)
                                    <a class="first__img" href="{{ route('site.show', $book->id) }}"><img src="{{ $book->img_full_path }}" alt="product image"></a>
                                @else
                                    <a class="first__img" href="{{ route('site.show', $book->id) }}"><img src="{{asset('frontend/images/books/1.jpg')}}" alt="product image"></a>
                                @endif
                            </div>
                            <div class="product__content content--center">
                                <h4><a href="{{ route('site.show', $book->id) }}">{{ $book->title }}</a></h4>
                                <div class="action">
                                    <div class="actions_inner">
                                        <ul class="add_to_links">
{{--                                            <li><a class="compare" href="{{ route('site.orders.store', $book->id) }}"><i class="bi bi-heart-beat"></i></a></li>--}}
                                            @if($book->is_pdf)
                                                <a href="{{ $book->url }}" target="_blank" class="mx-2"><i class="fa fa-download" style="font-size: xxx-large"></i></a>
                                            @else
                                                <a href="{{ route('site.orders.store', $book->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form').submit();"><i class="bi bi-heart-beat mx-2" style="font-size: xxx-large"></i></a>
                                                <form id="delete-form" action="{{ route('site.orders.store', $book->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div class="product__hover--content">
                                    <ul class="rating d-flex">
                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                        <li class="on"><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End Single Tab Content -->
        </div>
    </section>
    <!-- End BEst Seller Area -->

@endsection
