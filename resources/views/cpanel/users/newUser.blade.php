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
        <form action="{{ url('cpanel/users/store') }}" method="post">
            @csrf
            <div>
                <label for="">اسم المستخدم</label>
                <input type="text" name="name" value="{{(session('lastInputs'))?session('lastInputs')['name']:''}}">
            </div>
            <div>
                <label for="">كلمة المرور</label>
                <input type="password" name="password" >
            </div>
            <div>
                <label for="">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation">
            </div>
            <div>
                <label for="">تليفون</label>
                <input type="text" name="phone" value="{{(session('lastInputs'))?session('lastInputs')['phone']:''}}">
            </div>
            <div>
                <label for="">النوع</label>
                <select name="type">
                    @foreach ($userTypes as $type)
                        @if (session('lastInputs'))
                            <option {{(session('lastInputs')['type']==$type->value)?'selected':null}} value="{{$type->value}}">{{$type->name}}</option>
                        @else
                            <option value="{{$type->value}}">{{$type->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <label for="">الحالة</label>
                <select name="status">
                    @foreach ($userStatus as $status)
                        @if (session('lastInputs'))
                            <option {{(session('lastInputs')['type']==$status->value)?'selected':null}} value="{{$status->value}}">{{($status->value == 'enabled')?'نشط':'غير نشط'}}</option>
                        @else 
                            <option value="{{$status->value}}">{{($status->value == 'enabled')?'نشط':'غير نشط'}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <input type="submit" value="حفظ" id="save">
                <a href="{{ url('cpanel/users') }}">الغاء</a>
            </div>
        </form>
    </div>

@endsection
