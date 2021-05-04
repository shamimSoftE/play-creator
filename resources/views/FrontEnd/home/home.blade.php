@extends('FrontEnd.master')

@section('title')
    Home
@endsection

@section('content')

    <div class="layout-px-spacing">

        @php
           $sections =  \App\Models\Section::where('status',1)->latest()->get();
        @endphp

        <div class="row" id="cancel-row">

            @forelse($sections as $section)
                <div class="col-lg-12 col-md-12 layout-spacing layout-top-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>{{ $section->title }}</h4>

                                    {{-- display error message --}}
                                    @if(Session::has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>{{ Session::get('success') }}</strong>.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    {{-- //display error message --}}

                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="container">

                                <div id="pricingWrapper" class="row">

                                    <div class="col-md-6 col-lg-4">
                                        <div class="card stacked mt-5">
                                            <div class="card-header pt-0">
                                                <span class="card-price">$49</span>
                                                <h3 class="card-title mt-3 mb-1">Freelancer</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-minimal mb-3">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Support forum
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Free hosting
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">2 hours of support
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">5GB of storage space
                                                    </li>
                                                </ul>
                                                <a href="" class="btn btn-block btn-primary">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card stacked mt-5">
                                            <div class="card-header pt-0">
                                                <span class="card-price">$89</span>
                                                <h3 class="card-title mt-3 mb-1">Small business</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-minimal mb-3">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Unlimited calls
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Free hosting
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">10 hours of support
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">100GB of storage space
                                                    </li>
                                                </ul>
                                                <a href="" class="btn btn-block btn-primary">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                        <div class="card stacked mt-5">
                                            <div class="card-header pt-0">
                                                <span class="card-price">$129</span>
                                                <h3 class="card-title mt-3 mb-1">Larger business</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-minimal mb-3">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Unlimited calls
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Free hosting
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Unlimited hours of support
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">1TB of storage space
                                                    </li>
                                                </ul>
                                                <a href="" class="btn btn-block btn-primary">Buy Now</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty

                <div class="col-lg-12 layout-spacing layout-top-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Animated</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="container">
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>

            @endforelse
        </div>

    </div>

@endsection
