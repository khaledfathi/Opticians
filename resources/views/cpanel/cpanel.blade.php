@extends('layout.main')
@section('title', 'لوحة التحكم')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/cpanel.css') }}">
@endsection
@section('active-cpanel', 'active-cpanel')

@section('scripts')
    <script src="{{ url('assets/js/cpanel/cpanel.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="admin-block">
            <a href="{{ url('cpanel/users') }}">
                <div class="card" id="users-button">
                    <img class="image" src="{{ url('assets/images/svg/users.svg') }}" alt="users_logo">
                    <label class="card-label" for="">ادارة المستخدمين</label>
                    <input type="hidden" id="users-link" value="{{ url('cpanel/users') }}">
                </div>
            </a>

            <a href="{{ url('cpanel/customers') }}">
                <div class="card" id="customers-button">
                    <img class="image" src="{{ url('assets/images/svg/customer.svg') }}" alt="users_logo">
                    <label class="card-label" for="">سجل العملاء</label>
                </div>
            </a>

            <a href="{{ url('cpanel/frames') }}">
                <div class="card" id="frames-button">
                    <img class="image" src="{{ url('assets/images/svg/glasses.svg') }}" alt="users_logo">
                    <label class="card-label" for="">قائمة الفريمات</label>
                </div>
            </a>

            <a href="{{ url('cpanel/lenses') }}">
                <div class="card" id="lenses-button">
                    <img class="image" src="{{ url('assets/images/svg/lens.svg') }}" alt="users_logo">
                    <label class="card-label" for="">قائمة العدسات</label>
                </div>
            </a>
        </div>

        <div class="about-app">
            <h4 class="about-app__about">About App</h4>
            <p>
                App : Optician Workshop System [OWS]<br>
                App Version : Pre-alpha<br>
                PHP Version : 8.1+ <br>
                Laravel Version : 10.5.1+<br>
                License : GPL v3<br>
                Support : dev@khaledfathi.com
            </p>
        </div>
    </div>

@endsection
