@extends('FrontEnd.master')

@section('title')
    user-dashboard
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  />
@endsection

@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-spacing">
            <div class="offset-1 col-xl-10 col-lg-8 col-md-8 col-sm-12 layout-top-spacing">

            <div class="skills layout-spacing ">

                    {{-- display error message --}}
                    @if(Session::has('sms'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('sms') }}</strong>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {{-- //display error message --}}

                    <div class="widget-content widget-content-area">
                        <h3 class="text-center">Here you can customize your info</h3>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6  mb-sm-12 mb-5 ">
                                <div class="d-flex b-skills">
                                    <div class="mt-2 ml-5">
                                        <a href="" class="btn btn-sm btn-success">
                                            Create Post
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6  mb-sm-12 mb-5 ">
                                <div class="d-flex b-skills">
                                    <div class="mt-2">
                                        <a href="" class="btn btn-sm btn-primary">Purchased Coins</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="offset-1 col-xl-10 col-lg-8 col-md-8 col-sm-12  layout-spacing">
                {{-- display error message --}}
                @if(Session::has('sms'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('sms') }}</strong>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- //display error message --}}
                <div class="widget-content widget-content-area br-6 p-2">
                    <div class="">
                        <a class="mt-2 mr-4" href="#">
                            Your Purchase Coin
                        </a>
                    </div>

                    <table id="zero-config" class="table dt-table-hover" style="width:100%">

                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Coin</th>
                            <th>Price</th>
                        </tr>
                        </thead>

                        @php
                            $user = auth()->user()->id;
                            $buy = \App\Models\BuyCoin::where('user_id',$user)->latest()->get();
                        @endphp

                        <tbody>
                        @php($i = 1)
                        @forelse($buy as $coin)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $coin->coin->coin_amount }}</td>
                                <td>$ {{ $coin->coin->coin_price }}</td>

                            </tr>
                        @empty
                            <tr>
                                <th colspan="8" style="text-align: center">
                                    Oops.. No coin found.
                                </th>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Coin</th>
                            <th>Price</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>




@endsection
