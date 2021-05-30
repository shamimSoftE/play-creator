@extends('BackEnd.master')

@section('title')
    Chatting
@endsection

@section('content')

    <div class="chat-box">

        <div class="chat-not-selected">
            <p>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                Chat with
                 @if(!empty($sms->user->name))
                 {{ $sms->user->name }}
                @endif

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
                                                @if($chat->sender_id == auth()->guard('admin')->user()->id)

                                                    <span><b>{{  $chat->adminSender->name }}</b></span>
                                                    <hr style="background-color: #151414;height: 1px; margin-top: -2px" />
                                                @else

                                                    <span>
                                                        <b>
                                                         @if(!empty($chat->seller->name))
                                                                {{ $chat->seller->name  }}
                                                            @else
                                                                {{  $chat->user->name }}
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
                                <div class="col-md-10">
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


            <div class="chat-footer mb-lg-5 offset-1 col-md-8">
                <div class="chat-input">
                    <form class="chat-form" action="{{ route('reply_sms') }}" method="post">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $sms->user->id }}"/>
                        <textarea class="mail-write-box form-control" rows="3" name="message" placeholder="Include your message"></textarea>
                        <button type="submit" class="btn btn-success float-right mt-3">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
