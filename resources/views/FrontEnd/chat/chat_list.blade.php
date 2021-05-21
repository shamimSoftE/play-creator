@extends('FrontEnd.master')

@section('title')
    Chatting list
@endsection

@section('content')


    <div class="chat-section layout-top-spacing">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="chat-system">
                    <div class="hamburger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none">
                            <line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </div>
                    <div class="user-list-box">
                        <div class="people">
                            @forelse($sellers as $seller)
                            <div class="person" >
                                @auth
                                <a  class="user-info" href="{{ route('chat_user',$seller->id) }}">
                                    <div class="f-head">
                                        <img src="{{ asset('Back') }}/assets/img/90x90.jpg" alt="avatar">
                                    </div>
                                    <div class="f-body">
                                        <div class="meta-info">

                                            {{--@php
                                                $auth_user = auth()->user()->id;
                                                $sms = \App\Models\Chatting::where('user_id',$auth_user)->where('seller_id',$seller->id)
                                            @endphp--}}
                                            <span class="user-name" data-name="Sean Freeman">
                                                {{ $seller->name }} {{--<sup>{{ $sms->count() }}</sup>--}}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                @else
                                    <a class="user-info" href="{{ route('login') }}" title="please login first to chat a seller">
                                        <div class="f-head">
                                            <img src="{{ asset('Back') }}/assets/img/90x90.jpg" alt="avatar">
                                        </div>
                                        <div class="f-body">
                                            <div class="meta-info">
                                            <span class="user-name" data-name="Sean Freeman">
                                                {{ $seller->name }}
                                            </span>
                                                {{--<span class="user-meta-time">
                                                    2:09 PM
                                                </span>--}}
                                            </div>
                                        </div>
                                    </a>
                                @endauth

{{--                                        </div>--}}
                            </div>
                            @empty
                                <div class="person">
                                    <div class="user-info">
                                        <div class="f-body">
                                            <div class="meta-info">
                                                <span class="user-name">
                                                    Oops no user found.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
{{--                    @include('FrontEnd.chat.chat_box')--}}
                </div>

            </div>
        </div>
    </div>
@endsection

@section('style')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('Back') }}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('Back') }}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('Back') }}/assets/css/apps/mailing-chat.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->

    <!-- END PAGE LEVEL STYLES -->
@endsection

@section('script')

    <script src="{{ asset('Back') }}/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('Back') }}/assets/js/apps/mailbox-chat.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection
