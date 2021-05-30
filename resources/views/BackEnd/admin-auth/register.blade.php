@extends('BackEnd.master')

@section('title')
    Create an admin
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
                        <h5>Admin Generate</h5>
                        <a class="float-right mb-3" href="{{ route('admin_index') }}">
                            Admin List
                        </a>
                    </div>
                </div>
            </div>
            {{--<div class="widget-content widget-content-area">--}}
            <div class="offset-1 col-xl-10 col-md-10 col-sm-10 col-10">
                <form method="POST" action="{{ route('admin_store') }}" class="text-left">
                    @csrf

                    <div class="form">
                        <div id="username-field" class="field-wrapper input">
                            <label for="username">USERNAME</label>
                            <input id="username" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Username">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="email-field" class="field-wrapper input">
                            <label for="email">EMAIL</label>
                            <input id="email" name="email" type="email" value="" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="password-field" class="field-wrapper input mb-2">
                            <div class="d-flex justify-content-between">
                                <label for="password">PASSWORD</label>
                            </div>
                            <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div id="password-field" class="field-wrapper input mb-2">
                            <div class="d-flex justify-content-between">
                                <label for="password">Confirm PASSWORD</label>
                            </div>
                            <input id="password" name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Retype your password">
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-sm-flex justify-content-between">
                            <div class="field-wrapper">
                                <button type="submit" class="btn btn-primary" value="">Store</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- </div>--}}
        </div>
    </div>

@endsection



