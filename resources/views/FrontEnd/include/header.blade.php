<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('Back') }}/assets/img/pubgamesdz_logo.png" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="{{ url('/') }}" class="nav-link"> Logo </a>
            </li>
        </ul>

        <ul class="navbar-item flex-row ml-md-0 ml-auto">
            <li class="nav-item align-self-center search-animated">

                @php
                  $category = \App\Models\Category::where('status',1)->get();

                @endphp
                <form class="form-inline search-full form-inline search" method="GET" action="{{ route('search_item') }}" role="search">
                    <div class="input-group search-form-control  ml-lg-auto">
                        <select type="search" name="query" class="custom-select" id="inputGroupSelect04">
                            <option selected value="">Choose an category...</option>
                            @forelse($category as $cate)
                                <option value="{{ $cate->id}}">
                                    {{ $cate->name }}
                                </option>
                            @empty
                                <span>No Data Found</span>
                            @endforelse
                        </select>

                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary ml" type="submit">
                                Search Products
                            </button>
                        </div>
                    </div>
                </form>
            </li>
        </ul>

        <ul class="navbar-item flex-row ml-md-auto">
            <li class="nav-item theme-text">
                <a href="{{ route('coin_list') }}" class="nav-link text-white"> Buy Coin | </a>
            </li>

            @auth

                @php
                    $me = auth()->user()->id;

                    $chats = \App\Models\Chat::where('receiver_id',$me)
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
                            <a href="{{ route('user_sms_view',$chat->id) }}" class="dropdown-item">
                                <div class="">
                                    <div class="media">
                                        <div class="user-img">
                                            <div class="avatar avatar-xl">
                                                    <span class="avatar-title rounded-circle">
                                                        @if(!empty($chat->adminSender->name))
                                                            {{ \Str::substr($chat->adminSender->name,0,1) }}
                                                        @else
                                                            {{ \Str::substr($chat->seller->name,0,1) }}
                                                        @endif
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h5 class="usr-name">
                                                    @if(!empty($chat->adminSender->name))
                                                        {{ $chat->adminSender->name }}
                                                    @else
                                                        {{ $chat->seller->name }}
                                                    @endif
                                                </h5>
                                                <p class="msg-title">{{ $chat->message }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <span class="dropdown-item">Oops. No new message!</span>
                        @endforelse

                    </div>
                </div>
            </li>
            @endauth
            @auth
                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        @php
                            //$user = auth()->user()->id;
                        $user = Auth::user();
                        $userBalance = DB::table('users')->where('id', $user->id)->value('balance');
                        @endphp

                        <span style="color: white">
                            {{ auth()->user()->name }} <sup title="Your Coins">{{ $userBalance }}</sup>
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </a>

                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a class="" href="{{ route('user_profile') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                    Profile
                                </a>
                            </div>

                            @php
                                $user = auth()->user()->id;

                                $seller = \App\Models\Seller::where('user_id',$user)->first();
                            @endphp

                            @if(isset($seller->status))

                                @if($seller->status == 1 )

                                @else
                                    <div class="dropdown-item">
                                        <a class="" href="{{ route('seller_form') }}" title="Request to be a seller">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            Create Seller Account
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="dropdown-item">
                                    <a class="" href="{{ route('seller_form') }}" title="Request to be a seller">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        Create Seller Account
                                    </a>
                                </div>
                            @endif

                            <div class="dropdown-item">
                                <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    Sign Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            @else
                <li class="nav-item dropdown notification-dropdown mr-2" title="Login">
                    <a href="{{ route('login') }}" class="nav-link dropdown-toggle">
                        <span class="text-white">Login</span>
                    </a>
                </li>
                <li class="nav-item dropdown notification-dropdown mr-4" title="Register">
                    <a href="{{ route('register') }}" class="nav-link dropdown-toggle">
                        <span class="text-white">Register</span>
                    </a>
                </li>
            @endauth


        </ul>
    </header>
</div>
