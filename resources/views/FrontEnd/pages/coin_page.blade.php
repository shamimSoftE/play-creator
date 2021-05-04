@extends('FrontEnd.master')

@section('title')
    coin
@endsection

@section('content')

    <div class="layout-px-spacing">

        <div class="row" id="cancel-row">

            <div class="col-lg-12 layout-spacing layout-top-spacing">
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
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card stacked mt-5">
                                            <div class="card-header pt-0">
                                                <span class="card-price">${{ $coin->coin_price }}</span>
                                                <h3 class="card-title mt-3 mb-1 text-center">{{ $coin->coin_amount }} Coins</h3>
                                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>--}}
                                            </div>
                                            <div class="card-body">
                                                {{--<ul class="list-group list-group-minimal mb-3">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Support forum
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">Free hosting
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">2 hours of support
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">5GB of storage space
                                                    </li>
                                                </ul>--}}
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
