@php
$setting = App\Models\SiteSetting::find(1);
@endphp
<header class="top-header top-header-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-2 pr-0">
                <div class="language-list">

                </div>
            </div>

            <div class="col-lg-9 col-md-10">
                <div class="header-right">
                    <ul>
                        <li>
                            <i class='bx bx-home-alt'></i>
                            <a href="#">{{ $setting->address }}</a>
                        </li>
                        <li>
                            <i class='bx bx-phone-call'></i>
                            <a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a>
                        </li>
                        @auth
                        <li>
                            <i class='bx bx-user'></i>
                            <a href="{{ route('user.booking') }}">Dashboard</a>
                        </li>
                        <li>
                            <i class='bx bx-log-out'></i>
                            <a href="{{route('user.logout')}}">Logout</a>
                        </li>
                        @else
                        <li>
                            <i class='bx bxs-user-pin'></i>
                            <a href="{{route('login')}}">Login</a>
                        </li>
                        <li>
                            <i class='bx bxs-user-rectangle'></i>
                            <a href="{{route('register/form')}}">Register</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>