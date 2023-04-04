@extends('layout.main')
@section('title', 'مستخدم جديد')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/usersManagment/newUser.css') }}">
@endsection

@section('active-cpanel', 'active-cpanel')

@section('content')
    <div class="container">
        <div class="msg">
            @if ($errors->any())
                <p class="msg__error">
                    @foreach ($errors->all() as $error)
                        - {{ $error }} <br>
                    @endforeach
                </p>
            @endif
        </div>
        <form action="{{ url('cpanel/usersmanagment/createuser') }}" method="post">
            @csrf
            <input type="hidden" value="{{ csrf_token() }}" id="csrf_token">
            <div>
                <label for="">اسم المستخدم</label>
                <input type="text" name="name">
            </div>
            <div>
                <label for="">كلمة المرور</label>
                <input type="password" name="password">
            </div>
            <div>
                <label for="">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation">
            </div>
            <div>
                <label for="">تليفون</label>
                <input type="text" name="phone">
            </div>
            <div>
                <label for="">النوع</label>
                <select name="type">
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
            </div>
            <div>
                <label for="">الحالة</label>
                <select name="status">
                    <option value="enabled">نشط</option>
                    <option value="disabled">غير نشط</option>
                </select>
            </div>
            <div>
                <input type="submit" value="حفظ" id="save">
                <a href="{{ url('cpanel/usersmanagment') }}">الغاء</a>
            </div>
        </form>
    </div>

@endsection
