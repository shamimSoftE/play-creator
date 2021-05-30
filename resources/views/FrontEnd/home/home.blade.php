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

            <div class="col-lg-12 col-md-12">
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

            @forelse($sections as $section)
                <div class="col-lg-12 col-md-12 layout-spacing layout-top-spacing">
{{--                    <div id="card_9" class="col-lg-12 layout-spacing">--}}
                        <div class="statbox widget box box-shadow">
{{--                            <div class="statbox widget box box-shadow">--}}

                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>{{ $section->title }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        @php
                                            $products  = \App\Models\Post::where([ ['status',1],'section_id' =>$section->id] )->latest()->get();
                                        @endphp

                                        @forelse($products as $pro)
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-5">
                                                <div class="card component-card_9">
                                                    @if(!empty($pro->category->image))
                                                        <img src="{{ asset("Back/images/category/". $pro->category->image) }}" class="card-img-top" style="height: 180px" alt="widget-card-2">
                                                    @endif

                                                    <div class="card-body">
                                                        <p class="meta-date">{{ $pro->created_at->format('d M Y') }}</p>

                                                        <h5 class="card-title">{{ $pro->point }} coins / {{ $pro->quantity }}.</h5>

                                                        <div class="meta-info">
                                                            <div class="meta-user">
                                                                @isset($pro->user->name)
                                                                    <div class="avatar avatar-sm">
                                                                        <span class="avatar-title rounded-circle">
                                                                            {{ \Str::substr($pro->user->name, 0,1) }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="user-name">{{ \Str::words($pro->user->name,1) }}</div>
                                                                @endisset
                                                                @isset($pro->admin->name)
                                                                    <div class="avatar avatar-sm">
                                                                        <span class="avatar-title rounded-circle">{{ \Str::substr($pro->admin->name, 0,1) }}</span>
                                                                    </div>
                                                                    <div class="user-name">{{ \Str::words($pro->admin->name,1) }}</div>
                                                                @endisset
                                                            </div>

                                                            <div class="meta-action">
                                                                <div class="meta-likes">
                                                                    @auth
                                                                        @isset($pro->user->name)
                                                                            <a href="{{ route('chat_box',$pro->user->id) }}" style="margin-left: -13px; margin-right: 7px;" class="btn btn-sm btn-primary" title="with {{ $pro->user->name }}">
                                                                                Message
                                                                            </a>
                                                                        @endisset
                                                                        @isset($pro->admin->name)
                                                                            <a href="{{ route('chat_box',$pro->admin->id) }}" style="margin-left: -13px; margin-right: 7px;" class="btn btn-sm btn-primary" title="with {{ $pro->admin->name }}">
                                                                                Message
                                                                            </a>
                                                                        @endisset
                                                                    @else
                                                                        <a href="{{ route('login') }}" style="margin-left: -13px; margin-right: 7px;" class="btn btn-sm btn-primary">
                                                                            Message
                                                                        </a>
                                                                    @endauth
                                                                </div>

                                                                <div class="meta-view mr-1">
                                                                    @auth
                                                                        <a title="this item" style="margin-left: -15px;" class="btn btn-sm btn-success" data-toggle="modal" data-target="#proView{{ $pro->id }}">
                                                                            Buy
                                                                        </a>
                                                                    @else
                                                                        <a title="Login/Register First" style="margin-left: -15px;" href="{{ route('login') }}" class="btn btn-sm btn-success">Buy</a>
                                                                    @endauth
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade modal-notification" id="proView{{ $pro->id }}" tabindex="-1" role="dialog" aria-labelledby="standardModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document" id="standardModalLabel">
                                                    <div class="modal-content">
                                                        <form action="{{ route('buy_product') }}" method="post">
                                                            @csrf
                                                            <div class="modal-body text-center">
                                                                <div class="icon-content">
                                                                    <img src="{{ asset("Back/images/category/". $pro->category->image) }}" width="120" alt="pro_img">
                                                                    <input type="hidden" name="id" value="{{ $pro->id }}" />
                                                                </div>
                                                                <div class="modal-text">
                                                                    {{ $pro->title }} <br/>
                                                                    You need to <strong>{{ $pro->point }} coins</strong> to buy this {{ $pro->quantity }} <strong>{{ $pro->section->title }}</strong>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="card-element">Enter ID Number</label>
                                                                    <input type="text" name="game_id" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                                                <button type="submit" class="btn btn-primary">Confirm To Buy This</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--modal end--}}

                                        @empty
                                            <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12">
                                                <div class="card component-card_3">
                                                    <div class="card-body">
                                                        <span class="text-center text-success"> Oops No Product Found</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                </div>
            @empty

            @endforelse
        </div>

    </div>

@endsection
