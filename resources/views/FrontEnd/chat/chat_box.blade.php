@extends('FrontEnd.master')

@section('title')
    Chatting list
@endsection

@section('content')

    <div class="chat-box">

        <div class="chat-not-selected">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                Chat with {{ $seller->name }}
            </p>
        </div>
        <div class="chat-box-inner">

            {{--<div class="chat-meta-user">
                <div class="current-chat-user-name">
                    <span>
                        <img src="{{ asset('Back') }}/assets/img/90x90.jpg" alt="dynamic-image">
                        <span class="name"></span>
                    </span>
                </div>

            </div>--}}
            <div class="chat-conversation-box">
                <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
{{--                    <div class="row">--}}
                        <div class="offset-1 col-md-8">
                            @forelse($chattings as $chat)
                                <div class="chat my-5 form-inline">
                                    <div class="bubble you">

                                        <sup style="
                                                font-size: 14px;
                                                padding-left: 4px;
                                                padding-bottom: 2px;
                                                 padding-top: 2px;
                                                  border: 1px solid #00d50b;
                                                   border-radius: 50%">
                                            {{\Str::substr($chat->user->name, 0,1)  }}
                                        </sup>

                                        <span class="ml-2">
                                        {{ $chat->message }}
                                    </span>

                                    </div>
                                    <div class="conversation-start ml-5">
                                        <span>{{ $chat->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="offset-1 col-md-8">
                                    <div class="chat my-5">
                                        {{-- <div class="conversation-start">
                                             <span>Today, 6:48 AM</span>
                                         </div>--}}
                                        <div class="bubble you">
                                            start your conversation
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        {{--<div class="col-md-4">
                            @forelse($chatReply as $reply)
                                <div class="chat my-5 form-inline">
                                    <div class="bubble you">

                                        <sup style="
                                                font-size: 14px;
                                                padding-left: 4px;
                                                padding-bottom: 2px;
                                                 padding-top: 2px;
                                                  border: 1px solid rgba(119,0,253,0.77);
                                                   border-radius: 50%">
                                            {{\Str::substr($reply->seller->name, 0,1)  }}
                                        </sup>

                                        <span class="ml-2">
                                        {{ $reply->message }}
                                    </span>

                                    </div>
                                    <div class="conversation-start ml-5">
                                        <span>{{ $reply->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="offset-1 col-md-8">
                                    <div class="chat my-5">
                                        --}}{{-- <div class="conversation-start">
                                             <span>Today, 6:48 AM</span>
                                         </div>--}}{{--
                                        <div class="bubble you">
                                            start your conversation
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>--}}
{{--                    </div>--}}
                   {{-- <div class="chat" data-chat="person12">
                    </div>--}}
                </div>
            </div>
            <div class="chat-footer mb-lg-5 offset-1 col-md-8">
                <div class="chat-input">
                    <form class="chat-form" action="{{ route('chatting_store') }}" method="post">
                        @csrf
                        {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>--}}
                        <input type="hidden" name="receiver_id" value="{{ $seller->id }}"/>
                        <input type="text" class="mail-write-box form-control" name="message" placeholder="Press enter to send message"/>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
