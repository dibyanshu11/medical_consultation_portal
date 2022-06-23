<div id="app">
    <div class="container">
        <ul class="doctor-profile d-flex justify-content-end">
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else

            <div class="doctor-pro d-flex">
                <li class="profile-img">
                    @if(auth()->user()->image !=null)

                    <img class="user-prf-img header-prf" alt="Profile" src="{{auth()->user()->image}}" />

                    @else
                    <img class="user-prf-img header-prf" alt="Profile" src="{{asset('images/no-image.png')}}" " />

                    @endif

                    <span class=" profile-dropdown">
                    <p><a class="dropdown-item" href="{{ route('admin-profile') }}">Profile</a>
                    </p>
                    <p><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('logout') }}
                        </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </p>
                    </span>

                </li>
                <li class=" profile-name">
                    <p class="sub-titel">Welome</p>
                    <p> {{ Auth::user()->first_name }}</p>
                   

                </li>
            </div>

            <!--<li class="massage"><img src="{{asset('/images/massage.png')}}"></li>-->
            <!--<li class="notification">-->
            <!--    <a href="#"><img src="{{(asset('/images/notification.png'))}}"></a>-->

            <!--    <span class="notification-dropdown">-->
            <!--        <p>abc</p>-->
            <!--        <p>abc</p>-->
            <!--    </span>-->
            <!--</li>-->

            @endguest
        </ul>
    </div>


</div>