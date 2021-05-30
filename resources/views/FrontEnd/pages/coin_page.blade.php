@extends('FrontEnd.master')

@section('title')
    coin page
@endsection

@section('content')

    <div class="layout-px-spacing">

        <div class="row" id="cancel-row">

            <div class="col-lg-12 layout-spacing layout-top-spacing">

                {{-- display error message --}}
                @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('error') }}</strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- //display error message --}}

                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>{{--{{ $section->title }}--}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="container">

                            <div id="pricingWrapper" class="row">
                                @forelse($coins as $coin)
                                    <div class="col-md-6 col-lg-4 mt-5">
                                        <div class="card stacked">
                                            <div class="card-header pt-0">
                                                <h4 class="card-price">${{ $coin->coin_price }}</h4>
                                                <h5 class="card-title mt-3 mb-1 text-center">{{ $coin->coin_amount }} Coins</h5>
                                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>--}}
                                            </div>
                                            <div class="card-body">
                                                @auth
                                                    <a href="{{ route('payment_page',$coin->id) }}" class="btn btn-block btn-primary">Get Coins</a>
                                                @else
                                                    <a href="{{ route('login') }}" title="Please Login/Register First" class="btn btn-block btn-primary">Get Coins</a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <span> Oops No Coin Found</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
