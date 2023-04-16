@extends('layout.main')
@section('title', 'تحديث عدسة')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/lenses/createLens.css') }}">
@endsection

@section('active-cpanel', 'active-cpanel')

@section('content')
    <div class="container">
        <div class="section-header">
            <h3>تحديث عدسة</h3>
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
        <form action="{{ url('cpanel/lenses/update') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$record->id}}">
            <div class="lens-data">
                <div>
                    <label for="">نوع العدسة</label>
                    <input type="text" name="name" value="{{$record->name}}">
                </div>
                <div>
                    <label for="">الوصف</label>
                    <textarea name="description">{{$record->description}}</textarea>
                </div>
            </div>
            <div class="block-buttons">
                <input type="submit" value="تحديث">
                <a href="{{ url('cpanel/lenses') }}">الغاء</a>
            </div>
        </form>
    </div>
@endsection
