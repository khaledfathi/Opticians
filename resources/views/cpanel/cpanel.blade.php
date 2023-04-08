@extends('layout.main')
@section('title', 'لوحة التحكم')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/cpanel.css') }}">
@endsection
@section('active-cpanel', 'active-cpanel')

@section('content')
    <div class="container">
        <div class="admin-block">

            <div class="card" id="users-button">
                <img class="image" src="{{ url('assets/images/svg/users.svg') }}" alt="users_logo">
                <label class="card-label" for="">ادارة المستخدمين</label>
                <input type="hidden" id="users-link" value="{{ url('cpanel/users') }}">
            </div>

            <div class="card" id="customers-button">
                <a href="{{ url('cpanel/customers') }}">سجل العملاء</a>
            </div>

            <div class="card" id="frames-button">
                <a href="{{ url('cpanel/frames') }}">قائمة انواع الفريم</a>
            </div>

            <div class="card" id="lenses-button">
                <a href="{{ url('cpanel/lenses') }}">قائمة انواع العدسات</a>
            </div>
        </div>

        <div class="about-app">
            <p>App Version : Pre-alpha</p>
            <p>PHP Version : 8.2 </p>
            <p>Laravel Version : 10.5.1</p>
            <p>License : GPL v3</p>
            <p>Support : dev@khaledfathi.com</p>
        </div>
    </div>

@endsection
