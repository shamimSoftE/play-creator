@extends('BackEnd.master')

@section('title')
 Admin-Home
@endsection

@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">


            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">

                    @php
                        $orderByBank = \App\Models\BankTransfer::where('status',0)->latest()->get();
                    @endphp

                    <div class="widget-heading ">
                        <h5 class="text-primary">
                            Order By Bank
                            <sup style="font-size: 20px;color: #9100ff">{{ $orderByBank->count()  }}</sup>
                        </h5>
                        <a href="{{ route('order_list') }}" class="btn btn-sm btn-info ml-1" title="Show List">View</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">

                    @php
                        $seller = \App\Models\Seller::latest()->get();
                    @endphp

                    <div class="widget-heading ">
                        <h5 class="text-primary">
                            New seller
                            <sup style="font-size: 20px;color: #9100ff">{{ $seller->count()  }}</sup>
                        </h5>
                        <a href="{{ route('seller_list') }}" class="btn btn-sm btn-success ml-1" title="Show List">View</a>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">

                    @php
                        $SoldByCoin = \App\Models\BuyCoin::latest()->get();
                    @endphp

                    <div class="widget-heading ">
                        <h5 class="text-primary">
                            New sell coins
                            <sup style="font-size: 20px;color: #9100ff">{{ $SoldByCoin->count()  }}</sup>
                        </h5>
                        <a href="{{ route('soldBy_index') }}" class="btn btn-sm btn-primary mt-2" title="Show List">View</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">
                    @php
                        $cates = \App\Models\Category::where('status',1)->get();
                    @endphp
                    <div class="widget-heading ">
                        <h5 class="text-success">
                            Total Category
                            <sup style="font-size: 20px;color: #02009a">{{ $cates->count()  }}</sup>
                        </h5>
                        <a href="{{ route('category.index') }}" class="btn btn-sm btn-dark mt-2" title="Show List">View</a>
                    </div>
                </div>
            </div>

            <div id="tableHover" class="col-lg-12 col-12 layout-spacing">

            </div>

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">

                <div class="widget widget-table-two">
                    @php
                        $user = \App\Models\User::all();
                    @endphp
                    <div class="widget-heading">
                        <h5 class="" style="color: #422b02">Total Users <sup style="font-size: 20px;color: #085a01">{{ $user->count()  }}</sup></h5>
                        <h5 class="text-center">Users List</h5>
                    </div>

                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="th-content">Name</div>
                                        </th>
                                        <th>
                                            <div class="th-content">E-mail</div>
                                        </th>
                                        <th>
                                            <div class="th-content">Register Date</div>
                                        </th>
                                    </tr>
                                </thead>
                                @php
                                    $users = \App\Models\User::latest()->take(5)->get();
                                @endphp
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>
                                            <div class="td-content">{{ $user->name }}</div>
                                        </td>

                                        <td><div class="td-content"><span class="">{{ $user->email }}</span></div></td>

                                        <td>
                                            <div class="td-content">
                                                <span class="badge badge-success">{{ $user->created_at->diffForHumans()  }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>
                                            <span class="text-center">No Data Found</span>
                                        </td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">
                    @php
                        $coins = \App\Models\Coin::all();
                    @endphp
                    <div class="widget-heading">
                        <h5 style="color: #c69a31">Total Coin <sup style="font-size: 20px;color: #294729">{{ $coins->count()  }}</sup></h5>
                        <h5 class="text-center">Coin List</h5>
                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><div class="th-content">Coin Amount</div></th>
                                        <th><div class="th-content">Coin Price</div></th>
                                        <th>
                                            <div class="th-content">Status</div>
                                        </th>
                                    </tr>
                                </thead>
                                @php
                                    $coinNew = \App\Models\Coin::latest()->take(5)->get();
                                @endphp
                                <tbody>
                                @forelse($coinNew as $coin)
                                <tr>
                                    <td>
                                        <div class="td-content">{{ $coin->coin_amount }}</div>
                                    </td>

                                    <td><div class="td-content"><span class="">${{$coin->coin_price}}</span></div></td>
                                    <td>
                                        <div class="td-content">
                                            @if($coin->status == 1)
                                                <span class="badge badge-primary">
                                                    Active
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    Inactive
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty

                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
