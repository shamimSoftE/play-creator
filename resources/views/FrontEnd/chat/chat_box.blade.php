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
                Chat list
            </p>
        </div>
        <div class="chat-box-inner">

            <div class="chat-conversation-box">
                <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
                    <div class="row">
                        <div class="offset-1 col-md-10">
                            @forelse($chats as $chat)

                                <div class="chat my-5 form-inline">
                                    <div class="bubble you">
                                        <div class="card component-card_1">
                                            <div class="card-body">
                                                @if($chat->sender_id == auth()->user()->id)

                                                    <span><b>{{  $chat->user->name }}</b></span>
                                                    <hr style="background-color: #151414;height: 1px; margin-top: -2px" />
                                                @else

                                                    <span>
                                                        <b>
                                                         @if(!empty($chat->adminSender->name))
                                                                {{ $chat->adminSender->name  }}
                                                            @else
                                                                {{  $chat->seller->name }}
                                                            @endif
                                                        </b>
                                                    </span>
                                                    <hr style="background-color: #151414;height: 1px; margin-top: -2px" />
                                                @endif
                                                <p>{{ $chat->message }}</p>
                                                <small>{{ $chat->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            @empty
                                <div class="offset-1 col-md-10">
                                    <div class="chat my-5">
                                        <div class="conversation-start">
                                            <span>Today, {{ now()->days() }}</span>
                                        </div>
                                        <div class="bubble you">
                                            start your conversation
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
            <div class="chat-footer mb-lg-5 offset-1 col-md-6">
                <div class="chat-input">
                    <form class="chat-form" action="{{ route('store_message') }}" method="post">
                        @csrf

                        @isset($receiver_id)
                            <input type="hidden" name="receiver_id" value="{{ $receiver_id }}"/>
                        @endisset

                        @isset($message->sender_id)
                            <input type="hidden" name="receiver_id" value="{{ $message->sender_id }}"/>
                        @endisset
                        <textarea class="mail-write-box form-control" rows="3" name="message" placeholder="Include your message"></textarea>
                        <button type="submit" class="btn btn-success float-right mt-3">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
