<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="{{route('home')}}"><h3><b><i>BuySmart</i></b></h3></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><a href="{{route('women')}}">Women’s</a></li>
                        <li><a href="{{route('men')}}">Men’s</a></li>
                        <li><a href="{{route('kids')}}">Kid's</a></li>
                        <li><a href="{{route('contactus')}}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <ul class="header__right__widget">
                        <li><a href="{{route('cart')}}"><span class="icon_bag_alt"></span></a></li>
                        <li>@auth
                                @if (Auth::user()->avatar != null)
                                    <img class="img-profile rounded-circle" src="{{url('storage/users/', Auth::user()->avatar)}}" alt="{{Auth::user()->avatar}}" width="40" height="40"/>
                                @endif
                            @endauth
                        </li>
                    </ul>    
                    @guest
                        <div class="header__right__auth">
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        </div>                       
                    @else
                    <div class="header__right__auth">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                        
                    </div>
                    @endguest
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>