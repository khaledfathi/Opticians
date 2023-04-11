@extends('layout.main')
@section('title', 'فريم جديد')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/frames/newFrame.css') }}">
@endsection

@section('active-cpanel', 'active-cpanel')

@section('content')
    <div class="container">
        <div class="section-header">
            <h3>فريم جديد</h3>
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
        <form action="{{ url('cpanel/frames/store') }}" method="get">
            @csrf
            <div class="frame-data">
                <div>
                    <label for="">نوع الفريم</label>
                    <input type="text" name="name"
                        value="{{ session('lastInputs') ? session('lastInputs')['name'] : '' }}">
                </div>
                <div>
                    <label for="">الوصف</label>
                    <textarea name="description">{{ session('lastInputs') ? session('lastInputs')['description'] : '' }}</textarea>
                </div>
            </div>
            <div class="block-buttons">
                <input type="submit" value="حفظ" id="save">
                <a href="{{ url('cpanel/frames') }}">الغاء</a>
            </div>
        </form>
    </div>
@endsection
