@extends('FrontEnd.master')

@section('title')
    user-post-add
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
                        <a class="float-right mb-3" href="{{ route('user_profile') }}">
                            <i class="fas fa-list"></i> Post List
                        </a>
                    </div>
                </div>
            </div>
            {{--<div class="widget-content widget-content-area">--}}
            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">

                <form action="{{ route('user_save') }}" method="post">
                    @csrf
                    {{--<div class="form-group">
                        <label for="name">Product Title<sup style="color:red;" title="Must fill out this">*</sup></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror " value="{{ old('title') }}" name="title">
                        @error('title')
                        <div class="alert alert-default-danger">{{ $message }}</div>
                        @enderror
                    </div>--}}

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="section_id">Product Category<sup style="color:red;" title="Must fill out this">*</sup> </label>
                                <select class="form-control select2" name="category_id" >
                                    <option value="">Select</option>
                                    @foreach($categories as $cate)
                                        <option value="{{ $cate->id }}">
                                            {{ $cate->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="alert alert-default-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Product Coins<sup style="color:red;" title="Must fill out this">*</sup></label>
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
                                <label for="name">Product qty<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="text" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" name="quantity">
                                @error('quantity')
                                <div class="alert alert-default-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="section_id">Product Section <sup style="color:red;" title="Must fill out this">*</sup></label>
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

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
