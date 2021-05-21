@extends('FrontEnd.master')

@section('title')
    seller-request-form
@endsection

@section('content')

    <div id="flStackForm" class="col-lg-12 layout-spacing layout-top-spacing">
        <div class="statbox widget box box-shadow">

            {{--<div class="widget-content widget-content-area">--}}
            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">

                <form action="{{ route('seller_store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Name<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror " value="{{ old('name') }}"
                                       name="name" placeholder=" your name ">
                                @error('name')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">NID/Passport Number<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="text" class="form-control @error('nid') is-invalid @enderror" value="{{ old('nid') }}"
                                       name="nid" placeholder=" your NID or passport number ">
                                @error('nid')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="name">Address<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                                       name="address" placeholder="your address">
                                @error('address')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group">
                                <label for="name">Your Image<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="file" accept="image/*" class="form-control-file @error('image') is-invalid @enderror"
                                       value="{{ old('image') }}" name="image">
                                @error('image')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="form-group" title="Capture your NID with you">
                                <label for="name">NID/Passport Image<sup style="color:red;" title="Must fill out this">*</sup></label>
                                <input type="file" accept="image/*" class="form-control-file @error('nid_image') is-invalid @enderror"
                                       value="{{ old('nid_image') }}" name="nid_image">
                                @error('nid_image')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
