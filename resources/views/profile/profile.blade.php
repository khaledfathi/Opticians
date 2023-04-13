@extends('layout.main')
@section('title', 'ملف المستخدم')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/profile/profile.css') }}">
@endsection

@section('active-profile', 'active-profile')

@section('content')
    <div class="container">
        <div class="section-header">
            <h3>ملف المستخدم</h3>
        </div>
        @if ($errors->any())
            <div class="msg">
                <span class="msg__text msg__text--error">{{ $errors->first() }} <img class="msg__image"
                        src="{{ url('assets/images/svg/error.svg') }}" alt="error_icon"></span>
            </div>
        @elseif (session('ok'))
            <div class="msg">
                <span class="msg__text msg__text--ok">{{ session('ok') }} <img class="msg__image"
                        src="{{ url('assets/images/svg/ok.svg') }}" alt="ok_icon"></span>
            </div>
        @endif

        <form action="{{ url('profile/update') }}" method="post">
            @csrf
            <div class="user-data">                
                <input type="hidden" name="id" value="{{$record->id}}">
                <div>
                    <label for="">اسم المستخدم</label>
                    <input type="text" value="{{ $record->name }}" disabled>
                </div>
                <div>
                    <label for="">كلمة المرور القديمة</label>
                    <input type="password" name="oldPassword" placeholder="اتركة فارغاً - لن يتم تحديث كلمة المرور">
                </div>
                <div>
                    <label for="">كلمة المرور الجديدة</label>
                    <input type="password" name="password">
                </div>
                <div>
                    <label for="">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation">
                </div>
                <div>
                    <label for="">تليفون</label>
                    <input type="text" name="phone" value="{{ $record->phone }}">
                </div>
            </div>
            <div class="block-buttons">
                <input type="submit" value="تحديث">
                <a href="{{ url('/') }}">الغاء</a>
            </div>
        </form>
    </div>
@endsection
