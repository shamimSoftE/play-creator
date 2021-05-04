@extends('BackEnd.master')

@section('title')
 Admin-Home
@endsection

@section('content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-two">

                        @php
                            $coins = \App\Models\Coin::all();
                        @endphp
                        <div class="widget-heading">
                            <h5 class="">Total Coin {{ $coins->count()  }}</h5>
                            <h5 class="text-center">New Coin</h5>
                        </div>
                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th><div class="th-content">Coin Amount</div></th>
                                        <th><div class="th-content">Coin Price</div></th>
                                        <th><div class="th-content">Status</div></th>
                                    </tr>
                                    </thead>
                                    @php
                                        $coinNew = \App\Models\Coin::latest()->take(5)->get();
                                    @endphp
                                    <tbody>
                                    @forelse($coinNew as $coin)
                                    <tr>
                                        <td>
                                            <div class="td-content product-brand text-primary">{{ $coin->coin_amount }}</div>
                                        </td>

                                        <td><div class="td-content pricing"><span class="">${{$coin->coin_price}}</span></div></td>
                                        <td>
                                            <div class="td-content">
                                                @if($coin->status == 1)
                                                    <span class="badge badge-success">
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
                {{-- end post--}}
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-two">
                        @php
                            $cates = \App\Models\Category::all();
                        @endphp
                        <div class="widget-heading">
                            <h5 class="">
                                Total Categories
                                @isset($cates)
                                    {{ $cates->count()  }}
                                @endisset
                            </h5>
                            <h5 class="text-center">
                                Latest Category
                            </h5>
                        </div>

                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th><div class="th-content">SL</div></th>
                                        <th><div class="th-content">Category Image</div></th>
                                        <th><div class="th-content">Status</div></th>
                                    </tr>
                                    </thead>
                                    @php
                                        $cateRecent = \App\Models\Category::latest()->take(5)->get();
                                    @endphp
                                    <tbody>
                                    @forelse($cateRecent as $cate)
                                        <tr>
                                            <td>
                                                <div class="td-content product-brand text-primary">
                                                    {{ $cate->id }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="td-content product-brand text-primary">
                                                    <img  src="{{ asset("Back/images/category/".$cate->image ) }}" width="90px" alt="avatar">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="td-content">
                                                    @if( $cate->status == 1 )
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <div class="td-content product-brand text-primary">No Category Found</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{--end category--}}

                {{--<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-three">
                        @php
                            $users = \App\Models\User::all();
                        @endphp
                        <div class="widget-heading">
                            <h5 class="">Total  Users {{ $users->count()  }}</h5>
                        </div>
                        <h5 class="text-center">Recent User's </h5>

                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table table-scroll">
                                    <thead>
                                    <tr>
                                        <th><div class="th-content">ID</div></th>
                                        <th><div class="th-content th-heading">Name</div></th>
                                        <th><div class="th-content th-heading">E-mail</div></th>
                                        <th><div class="th-content">Date</div></th>
                                        <th><div class="th-content">View</div></th>
                                    </tr>
                                    </thead>
                                    @php
                                        $userRecent = \App\Models\User::latest()->take(5)->get();
                                    @endphp
                                    <tbody>

                                        @forelse($userRecent as $user)
                                            <tr>
                                               <td><div class="td-content"><span class="pricing">{{ $user->id }}</span></div></td>
                                                <td><div class="td-content"><span class="discount-pricing">{{ $user->name }}</span></div></td>
                                                <td><div class="td-content">{{ $user->email }}</div></td>
                                                <td>
                                                    <div class="td-content">
                                                        --}}{{--{{ $user->created_at->diffForHumans() }}--}}{{--
                                                        {{ $user->created_at->format('d M Y')  }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="td-content">
                                                        <a href="{{ route('users_list') }}" class="text-primary ml-2"> See</a>
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
                </div>--}}
                {{-- end user --}}

                {{--<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-three">
                        @php
                            $categories = \App\Models\Category::all();
                        @endphp
                        <div class="widget-heading">
                            <h5 class="">Total Sub-Categories {{ $categories->count()  }}</h5>
                            <h5 class="text-center">New Sub-Categories</h5>
                        </div>

                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table table-scroll">
                                    <thead>
                                        <tr>
                                            <th><div class="th-content">Category</div></th>
                                            <th><div class="th-content th-heading">Parent</div></th>
                                            <th><div class="th-content th-heading">Sub-Category</div></th>
                                            <th><div class="th-content">Status</div></th>
                                        </tr>
                                    </thead>
                                    @php
                                        $subCate = \App\Models\Category::latest()->with(['category','parent'])->latest()->take(5)->get();
                                    @endphp
                                    <tbody>
                                    @forelse($subCate as $sub)
                                        <tr>
                                           <td>
                                               <div class="td-content">
                                                   <span class="pricing">
                                                       @isset($sub->category->name)
                                                       {{ $sub->category->name }}
                                                       @endisset
                                                   </span>
                                               </div>
                                           </td>

                                            @if(isset($sub->parent->name))
                                                <td>
                                                    <div class="td-content">
                                                        <span class="discount-pricing">
                                                            {{ $sub->parent->name }}
                                                        </span>
                                                    </div>
                                                </td>
                                            @else
                                                <td>
                                                    <div class="td-content">
                                                        <span class="discount-pricing">
                                                           Root
                                                        </span>
                                                    </div>
                                                </td>
                                            @endif
                                            <td><div class="td-content">{{ $sub->name  }}</div></td>
                                            <td>
                                                <div class="td-content">
                                                    @if($sub->status = 1)
                                                        <a href="" class="text-success">Active</a>
                                                    @else
                                                        <a href="" class="text-danger">Inactive</a>
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
                </div>--}}
                {{-- end sub-category --}}
           {{-- @else

            @endif--}}


        </div>

    </div>
@endsection
