@extends('layout.main')
@section('title', 'عميل جديد')

@section('links')
    <link rel="stylesheet" href="{{ asset('') }}">
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
        <form action="{{ url('cpanel/customers/store') }}" method="post">
            @csrf
            <div>
                <label for="">اسم العميل</label>
                <input type="text" name="name" value="{{(session('lastInputs'))?session('lastInputs')['name']:''}}">
            </div>
            <div>
                <label for="">التليفون</label>
                <input type="text" name="phone" value="{{(session('lastInputs'))?session('lastInputs')['phone']:''}}">
            </div>
            <div>
                <label for="">العنوان</label>
                <textarea name="address">{{(session('lastInputs'))?session('lastInputs')['address']:''}}</textarea>
            </div>
            <div>
                <label for="">تفاصيل اخرى</label>
                <textarea name="details">{{(session('lastInputs'))?session('lastInputs')['details']:''}}</textarea>
            </div>
            <div>
                <input type="submit" value="حفظ" id="save">
                <a href="{{ url('cpanel/customers') }}">الغاء</a>
            </div>
        </form>
    </div>

@endsection
