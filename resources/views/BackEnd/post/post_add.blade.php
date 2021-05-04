@extends('BackEnd.master')

@section('title')
    Post | Add
@endsection

@section('content')

    <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                {{-- display success message--}}
                @if(Session::has('sms'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('sms') }}</strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- display success message--}}
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h5>Create Post</h5>
                        <a class="float-right mb-3" href="{{ route('post.index') }}">
                            <i class="fas fa-list"></i> Post List
                        </a>
                    </div>
                </div>
            </div>
            {{--<div class="widget-content widget-content-area">--}}
            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">

                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Post Title<sup style="color:red;" title="Must fill out this">*</sup></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror " value="{{ old('title') }}" name="title">
                        @error('title')
                        <div class="alert alert-default-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="section_id">Post Category<sup style="color:red;" title="Must fill out this">*</sup> </label>
                                <select class="form-control select2" name="category_id" >
                                    <option value="">Select</option>
                                    @foreach($categories as $cate)
                                        <option value="{{ $cate->id }}">
                                            {{ $cate->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Post Point<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="text" class="form-control @error('point') is-invalid @enderror" value="{{ old('point') }}" name="point">
                                @error('point')
                                <div class="alert alert-default-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Post Price<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" name="price">
                                @error('price')
                                <div class="alert alert-default-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="section_id">Post Section <sup style="color:red;" title="You can skip this"> optional</sup></label>
                                <select class="form-control select2" name="section_id" >
                                    <option value="">Select</option>
                                    @foreach($section as $sec)
                                        <option value="{{ $sec->id }}">
                                            {{ $sec->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    {{--<div class="form-group">
                        <label  class="form-control-plaintext">Post Description<sup style="color:red;" title="Must fill out this">*</sup></label>
                        <textarea rows="5" id="div_editor1" name="product_description"></textarea>
                        @error('product_description')
                        <div class="alert alert-default-danger">{{ $message }}</div>
                        @enderror
                    </div>--}}

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

{{--@section('style')

    <!--Rich text editor-->
    <link rel="stylesheet" href="{{ asset('/Back') }}/richtexteditor/rte_theme_default.css" />

@endsection

@section('script')

    --}}{{--========= rich text editor script--}}{{--
    <script type="text/javascript" src="{{ asset('/Back') }}/richtexteditor/rte.js"></script>
    <script type="text/javascript" src='{{ asset('/Back') }}/richtexteditor/plugins/all_plugins.js'></script>
    <script>
        var editor1 = new RichTextEditor("#div_editor1");
        //editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
    </script>
@endsection--}}
