@extends('site.layouts.app')
@section('title') Grid @endsection

@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--9">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->

    @include('partials.flash')

    <!-- Start Shop Page -->
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto pt--30 col-12 order-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                                <p>Showing {{ $books->firstItem() }}–{{ $books->lastItem() }} of {{ $books->total() }} results</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab__container">
                        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                            <div class="row">
                                <!-- Start Single Product -->
                                @foreach($books as $book)
                                    <div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
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
                                                        <li><a class="compare" href="{{ route('site.store', $book->id) }}"><i class="bi bi-heart-beat"></i></a></li>
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
                                @endforeach
                                <!-- End Single Product -->
                            </div>
                                {{ $books->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
@endsection
