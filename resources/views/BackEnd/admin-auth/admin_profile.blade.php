@extends('BackEnd.master')

@section('title')
    Admin-Profile
@endsection


@section('style')
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('/Back') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/Back') }}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/Back') }}/plugins/dropify/dropify.min.css">
    <link href="{{ asset('/Back') }}/assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
@endsection

@section('content')
    <div class="layout-px-spacing">

        <div class="account-settings-container layout-top-spacing">

            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form id="general-info" class="section general-info" action="{{ route('admin_update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="info">
                                    <h6 class="">General Information</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <input type="hidden" name="id" value="{{ $admin->id }}">
                                                {{--<img src="{{ asset("Back/images/admin/".$admin->image) }}" height="10px" alt="admin-img">--}}
                                                {{--<div class="col-xl-2 col-lg-12 col-md-4">
                                                    <div class="upload mt-4 pr-md-4">
                                                        <input type="file" id="input-file-max-fs" name="image" class="dropify"
                                                               data-default-file="{{ asset("Back/images/admin/".$admin->image) }}" data-max-file-size="2M" />
                                                        --}}{{--<input type="file" accept="image/*" class="form-control-file" name="image">--}}{{--
                                                        <p class="mt-2">
                                                            <i class="flaticon-cloud-upload mr-1"></i>
                                                            Upload New
                                                        </p>
                                                    </div>
                                                </div>--}}
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Full Name</label>
                                                                    <input type="text" class="form-control mb-4" name="name" id="fullName"
                                                                           value="{{ $admin->name }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="dob-input">E-mail</label>
                                                                <div class="d-sm-flex d-block">
                                                                    <input type="email" name="email" class="form-control mb-4 " value="{{ $admin->email }}" id="fullName" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">New Password</label>
                                                                    <input type="password" class="form-control mb-4  @error('password') is-invalid @enderror" name="password" id="fullName">
                                                                </div>
                                                                @error('password')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="dob-input">Confirm Password</label>
                                                                <div class="d-sm-flex d-block">
                                                                    <input type="password" name="password_confirmation" class="form-control mb-4 @error('password_confirmation') is-invalid @enderror" >
                                                                </div>
                                                                @error('password_confirmation')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        {{--<div class="form-group">
                                                            <label for="profession">Profession</label>
                                                            <input type="text" class="form-control mb-4" id="profession" placeholder="Designer" value="Web Developer">
                                                        </div>--}}
                                                        <div class="d-sm-flex justify-content-between">
                                                            <div class="field-wrapper">
                                                                <button type="submit" class="btn btn-success">Update This</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('/Back') }}/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{ asset('/Back') }}/bootstrap/js/popper.min.js"></script>
    <script src="{{ asset('/Back') }}/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('/Back') }}/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('/Back') }}/assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('/Back') }}/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="{{ asset('/Back') }}/plugins/dropify/dropify.min.js"></script>
    <script src="{{ asset('/Back') }}/plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="{{ asset('/Back') }}/assets/js/users/account-settings.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
@endsection
