<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{ route('admin_dashboard') }}">
                    <img src="{{ asset('/Back') }}/images/logo/logo.png" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="{{ route('admin_dashboard') }}" class="nav-link"> pubgamesdz </a>
            </li>
        </ul>

        <ul class="navbar-item flex-row ml-md-0 ml-auto">
            <li class="nav-item align-self-center search-animated">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search toggle-search">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <form class="form-inline search-full form-inline search" role="search">
                    <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                    </div>
                </form>
            </li>
        </ul>

        <ul class="navbar-item flex-row ml-md-auto">
            @php
                $me = auth()->guard('admin')->user()->id;

                $chats = \App\Models\Chat::where('receiver_id', $me)
                                            ->where('status',0)
                                            ->latest()->get();
            @endphp

            <li class="nav-item dropdown message-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-mail">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    @if($chats->count() == 0)

                    @else
                        <sup style="color: #fd55e9; font-size: 15px">{{ $chats->count() }}</sup>
                    @endif
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="messageDropdown">
                    <div class="">

                        @forelse($chats as $chat)
                        <a href="{{ route('message_read',$chat->id) }}" class="dropdown-item">
                            <div class="">
                                <div class="media">
                                    <div class="user-img">
                                        <div class="avatar avatar-xl">
                                            <span class="avatar-title rounded-circle">{{ \Str::substr($chat->user->name,0,1) }}</span>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div class="">
                                            <h5 class="usr-name">{{ $chat->user->name }}</h5>
                                            <p class="msg-title">{{ $chat->message }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                            @php
                                $me = auth()->guard('admin')->user()->id;
                                $chatting = \App\Models\Chat::where('receiver_id',$me)
                                                            ->where('status',1)
                                                            ->latest()->get();
                            @endphp
{{--                            <span class="dropdown-item">Oops. No new message!</span>--}}
                            <strong>Your chatting history</strong>
                            <hr style="margin-top: -2px; height: 1px; background-color: #0e1726"/>
                            @foreach($chatting as $sms)
                                <a href="{{ route('user_sms_view',$sms->id) }}" class="dropdown-item">
                                    <div class="">
                                        <div class="media">
                                            <div class="user-img">
                                                <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        @if(!empty($sms->adminSender->name))
                                                            {{ \Str::substr($sms->adminSender->name,0,1) }}
                                                        @else
                                                            {{ \Str::substr($sms->seller->name,0,1) }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div class="">
                                                    <h5 class="usr-name">
                                                        @if(!empty($sms->adminSender->name))
                                                            {{ $sms->adminSender->name }}
                                                        @else
                                                            {{ $sms->seller->name }}
                                                        @endif
                                                    </h5>

                                                    <p class="msg-title">{{ $sms->message }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endforelse

                    </div>
                </div>
            </li>

            <li class="nav-item dropdown user-profile-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <img src="{{ asset('/Back') }}/images/logo/admin.png" alt="avatar">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="">
                        <div class="dropdown-item">
                            <a class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle></svg>
                                {{ auth()->guard('admin')->user()->name }}
                            </a>
                        </div>
                        <div class="dropdown-item">
                            @php
                                $admin = auth()->guard('admin')->user();
                            @endphp
                            <a class="" href="{{ route('admin_profile', $admin->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                Profile
                            </a>
                        </div>

                        <div class="dropdown-item">
                            <a class="" href="{{ route('admin_create') }}">
                                <i class="fas fa-plus"></i>
                                Create Admin
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a class="" href="{{ route('admin_logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('admin_logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>

                    </div>
                </div>
            </li>

        </ul>
    </header>
</div>
