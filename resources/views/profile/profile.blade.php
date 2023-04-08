@extends('layout.main')
@section('title', 'ملف المستخدم')

@section('links')
    <link rel="stylesheet" href="{{ asset('') }}">
@endsection

@section('active-profile', 'active-profile')

@section('content')
    <div class="container">
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
            <form action="{{ url('profile/update') }}" method="post">
                @csrf
                <div>
                    <label for="">اسم المستخدم</label>
                    <input type="text" name="name" value="{{$record->name}}">
                </div>
                <div>
                    <label for="">كلمة المرور القديمة</label>
                    <input type="password" name="password" placeholder="اتركة فارغاً - لن يتم تحديث كلمة المرور">
                </div>
                <div>
                    <label for="">كلمة المرور الجديدة</label>
                    <input type="password" name="password" >
                </div>
                <div>
                    <label for="">تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation">
                </div>
                <div>
                    <label for="">تليفون</label>
                    <input type="text" name="phone"
                        value="{{$record->phone}}">
                </div>
                <div>
                    <input type="submit" value="تحديث" >
                    <a href="{{ url('/') }}">الغاء</a>
                </div>
            </form>
        </div>
    </div>
@endsection
