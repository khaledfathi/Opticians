@extends('layout.main')
@section('title', 'عدسة جديدة')

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
        <form action="{{ url('cpanel/lenses/store') }}" method="get">
            @csrf
            <div>
                <label for="">نوع العدسة</label>
                <input type="text" name="name" value="{{(session('lastInputs'))?session('lastInputs')['name']:''}}">
            </div>
            <div>
                <label for="">الوصف</label>
                <input type="text" name="description" value="{{(session('lastInputs'))?session('lastInputs')['description']:''}}">
            </div>
            <div>
                <input type="submit" value="حفظ" id="save">
                <a href="{{ url('cpanel/lenses') }}">الغاء</a>
            </div>
        </form>
    </div>
@endsection
