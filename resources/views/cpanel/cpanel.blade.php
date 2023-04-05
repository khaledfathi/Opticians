@extends('layout.main')
@section('title', 'لوحة التحكم')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/cpanel.css') }}">
@endsection
@section('active-cpanel' , 'active-cpanel') 

@section('content')
    <div class="container">
        <div class="admin-block">
            <a href="{{ url('cpanel/users') }}">ادارة المستخدمين</a>
            <a href="{{ url('cpanel/customers') }}">سجل العملاء</a>
            <a href="{{ url('cpanel/frames') }}">قائمة انواع الفريم</a>
            <a href="{{ url('cpanel/lenses') }}">قائمة انواع العدسات</a>
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
