@extends('layout.main')
@section('title', 'تحديث عميل')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/customers/createCustomer.css') }}">
@endsection

@section('active-cpanel', 'active-cpanel')

@section('content')
    <div class="section-header">
        <h3>تحديث عميل</h3>
    </div>
    <div class="container">
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
        <form action="{{ url('cpanel/customers/update') }}" method="post">
            @csrf
            <div class="customer-data">
                <input type="hidden" name="id" value="{{$record->id}}">
                <div>
                    <label for="">اسم العميل</label>
                    <input type="text" name="name" value="{{$record->name}}">
                </div>
                <div>
                    <label for="">التليفون</label>
                    <input type="text" name="phone" value="{{$record->phone}}">
                </div>
                <div>
                    <label for="">العنوان</label>
                    <textarea name="address">{{$record->address}}</textarea>
                </div>
                <div>
                    <label for="">تفاصيل اخرى</label>
                    <textarea name="details">{{$record->details}}</textarea>
                </div>
            </div>
            <div class="block-buttons">
                <input type="submit" value="تحديث">
                <a href="{{ url('cpanel/customers') }}">الغاء</a>
            </div>
        </form>
    </div>

@endsection
