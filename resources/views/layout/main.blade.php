<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('assets/css/external/normalize.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/layout/main.css')}}">
    @yield('links')
</head>

<body>
    <nav>
        <div class="nav-wrapper">
            <ul class="nav-ul nav-ul--right">
                <li class=@yield('active-search')><a href="{{url('search')}}">استعلام</a></li>
                <li class=@yield('active-order')><a href="{{url('order')}}">تسجيل شغل</a></li>
                <li class=@yield('active-revision')><a href="{{url('revision')}}">مراجعة</a></li>
            </ul>
            <ul class="nav-ul nav-ul--left">
                <li class=@yield('active-cpanel')><a href="{{url('cpanel')}}">لوحة التحكم</a></li>
                <li class=@yield('active-profile')><a href="{{url('profile')}}">{{auth()->user()->name}}</a></li>
                <li><a href="{{ url('logout') }}">خروج</a></li>
            </ul>
        </div>
    </nav>
    @yield('content')
    @yield('scripts')
</body>

</html>
