@extends('layout.main')
@section('title', 'تحديث مستخدم')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/users/createUser.css') }}">
@endsection

@section('active-cpanel', 'active-cpanel')

@section('content')
    <div class="container">
        <div class="section-header">
            <h4>تحديث مستخدم</h4>
        </div>

        @if ($errors->any())
            <div class="msg">
                <img class="msg__image" src="{{ url('assets/images/svg/error.svg') }}" alt="error_icon">
                <span class="msg__error">
                    @foreach ($errors->all() as $error)
                        -{{ $error }}<br>
                    @endforeach
                </span>
            </div>
        @endif

        <form action="{{ url('cpanel/users/update') }}" method="post">
            @csrf
            <div class="user-data">
                <input type="hidden" name="id" value="{{$record->id}}">
                <div>
                    <label for="">اسم المستخدم</label>
                    <input type="text" name="name" value="{{ $record->name }}">
                </div>
                <div>
                    <label for="">كلمة المرور</label>
                    <input type="password" name="password" placeholder="اتركة فارغ - لن يتم تحديث كلمة المرور">
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

            <div class="user-options">
                <div>
                    <label for="">النوع</label>
                    <select name="type">
                        @foreach ($userTypes as $type)
                            @if ($type->value == $record->type)
                                <option selected value="{{$type->value}}">{{$type->value}}</option>
                            @else
                                <option value="{{$type->value}}">{{$type->value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">الحالة</label>
                    <select name="status">
                        @foreach ($userStatus as $status)
                            @if ($status->value == $record->status)
                                <option selected value="{{$status->value}}">{{$status->value}}</option>
                            @else
                                <option value="{{$status->value}}">{{$status->value}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="block-buttons">
                <input type="submit" value="تحديث">
                <a href="{{ url('cpanel/users') }}">الغاء</a>
            </div>
        </form>
    </div>
@endsection
