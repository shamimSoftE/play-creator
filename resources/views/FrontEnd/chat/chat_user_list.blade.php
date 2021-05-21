@extends('FrontEnd.master')

@section('title')
    Chatting list
@endsection

@section('content')
    {{--<div class="chat-section layout-top-spacing">
        <div class="row">

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">--}}
                {{--<div class="card" data-spy="scroll">
                    <h3 class="card-header">
                        User list
                    </h3>
                    <div class="card-body">
                        @forelse($users as $key => $user)
                            <div class="form-inline">
                                <div class="card-img">
                                    <img src="{{ asset('Back') }}/assets/img/90x90.jpg" alt="avatar">
                                </div>
                                <div class="card-title">
                                    {{ $user->name }}
                                </div>
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
                </div>--}}
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
                                        @forelse($users as $key => $user)
                                            <div class="person" data-chat="person{{ ++$key }}">
                                                {{--                                        <div class="user-info">--}}
                                                <a  class="user-info" href="{{ route('chat_user',$user->name) }}">
                                                    <div class="f-head">
                                                        <img src="{{ asset('Back') }}/assets/img/90x90.jpg" alt="avatar">
                                                    </div>
                                                    <div class="f-body">
                                                        <div class="meta-info">
                                                        <span class="user-name" data-name="Sean Freeman">
                                                            {{ $user->name }}
                                                        </span>
                                                            {{--<span class="user-meta-time">
                                                                2:09 PM
                                                            </span>--}}
                                                        </div>
                                                    </div>
                                                </a>
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
                            </div>

                        </div>
                    </div>
                </div>
           {{-- </div>--}}

           {{-- <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                <h3>chatting box</h3>
            </div>--}}
        {{--</div>
    </div>--}}
@endsection
