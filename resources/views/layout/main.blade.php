<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/external/normalize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/layout/main.css') }}">
    @yield('links')
</head>

<body>
    <nav>
        <div class="nav-wrapper" >
            <ul class="nav-ul nav-ul--right">
                <li class=@yield('active-search')><a href="{{ url('search') }}">استعلام</a></li>
                <li class=@yield('active-order')><a href="{{ url('order') }}">تسجيل شغل</a></li>
                <li class=@yield('active-revision')><a href="{{ url('revision') }}">مراجعة</a></li>
            </ul>
            <ul class="nav-ul nav-ul--left">
                <li class=@yield('active-cpanel')><a href="{{ url('cpanel') }}">لوحة التحكم</a></li>
                <li class=@yield('active-profile')><a href="{{ url('profile') }}">{{ auth()->user()->name }}</a></li>
                <li><a href="{{ url('logout') }}">خروج</a></li>
            </ul>
        </div>

        <div class="nav-wrapper nav-wrapper--mobile">
            <img class="menu-icon" src="{{ asset('assets/images/svg/menu_icon.svg') }}" alt="menu_icon"
                id='menu-button'>
            <div class="mobile-menu" id="mobile-menu" hidden>
                <ul class="mobile-menu__list">
                    <li class=@yield('active-search')><a href="{{ url('search') }}">استعلام</a></li>
                    <li class=@yield('active-order')><a href="{{ url('order') }}">تسجيل شغل</a></li>
                    <li class=@yield('active-revision')><a href="{{ url('revision') }}">مراجعة</a></li>
                    <li class=@yield('active-cpanel')><a href="{{ url('cpanel') }}">لوحة التحكم</a></li>
                    <li class=@yield('active-profile')><a href="{{ url('profile') }}">{{ auth()->user()->name }}</a></li>
                    <li><a href="{{ url('logout') }}">خروج</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="{{ url('assets/js/layout/main.js') }}"></script>
    @yield('content')
    @yield('scripts')
</body>

</html>
