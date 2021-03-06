@extends('admin.layouts.app')
@section('title') {{ __('Books') }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-book"></i> {{ __('Books') }}</h1>
        </div>
    </div>
    @include('partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ __('Create Book') }}</h3>
                <form action="{{ route('admin.books.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="publisher_id">Publisher <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('publisher_id') is-invalid @enderror" type="text" name="publisher_id" id="publisher_id" value="{{ old('publisher_id') }}">
                                <option value="">Select a publisher</option>
                                @foreach($publishers as $publisher)
                                    <option value="{{$publisher->id}}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                            @error('publisher_id') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label for="authors">Authors <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control select2-multiple @error('authors') is-invalid @enderror" id="authors" name="authors[]" multiple>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ is_array(old('authors')) && in_array($author->id, old('authors')) ? 'selected' : '' }}>{{ $author->name }}</option>
                                @endforeach
                            </select>
                            @error('authors') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label for="categories">Categories <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control select2-multiple @error('categories') is-invalid @enderror" id="categories" name="categories[]" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ is_array(old('categories')) && in_array($category->id, old('categories')) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('categories') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>
                            @error('title') {{ $message }} @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="control-label" for="title">ISBN <span class="m-l-5 text-danger"> *</span></label>
                                <input class="form-control @error('isbn') is-invalid @enderror" type="text" name="isbn" id="isbn" value="{{ old('isbn') }}"/>
                                @error('isbn') {{ $message }} @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label" for="quantity">Quantity </label>
                                <input class="form-control" type="text" name="quantity" id="quantity" value="{{ old('quantity') }}"/>
                                @error('quantity') {{ $message }} @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label" for="title">Edition <span class="m-l-5 text-danger"> *</span></label>
                                <input class="form-control @error('edition') is-invalid @enderror" type="text" name="edition" id="edition" value="{{ old('edition') }}"/>
                                @error('edition') {{ $message }} @enderror
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label" for="volume">Volume </label>
                                <input class="form-control" type="text" name="volume" id="volume" value="{{ old('volume') }}"/>
                                @error('volume') {{ $message }} @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="issue">Issue </label>
                            <input class="form-control" type="text" name="issue" id="issue" value="{{ old('issue') }}"/>
                            @error('issue') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-3">
                                    <img src="https://via.placeholder.com/80x80?text=Placeholder+Image" id="coverImg" style="width: 80px; height: auto;">
                                </div>
                                <div class="col-6">
                                    <label class="control-label" for="cover">Cover </label>
                                    <input class="form-control-file" type="file" name="cover" id="cover" value="{{ old('cover') }}" onchange="loadFile(event,'coverImg')"/>
                                    @error('cover') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="toggle lg">
                            <label class="control-label" for="is_pdf">Is PDF
                                <input id="is_pdf" type="checkbox" name="is_pdf" {{ old('is_pdf') == true ? 'checked' : ''  }}><span class="button-indecator"></span>
                            </label>
                        </div>

                        <div class="form-group url-box d-none">
                            <label class="control-label" for="url">URL <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('url') is-invalid @enderror" type="url" name="url" id="url" value="{{ old('url') }}"/>
                            @error('url') {{ $message }} @enderror
                        </div>

                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Book</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.books.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2-multiple').select2();
        });

        loadFile = function(event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
        };

        if (document.querySelector('#is_pdf').checked === true) {
            document.querySelector('.url-box').classList.remove('d-none');
        }

        document.querySelector('#is_pdf').addEventListener('click', function (e) {
            document.querySelector('.url-box').classList.toggle('d-none');
        })
    </script>
@endpush
