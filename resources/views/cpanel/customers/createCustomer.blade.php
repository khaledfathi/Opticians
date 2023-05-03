@extends('layout.main')
@section('title', 'عميل جديد')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/customers/createCustomer.css') }}">
@endsection

@section('active-cpanel', 'active-cpanel')

@section('content')
    <div class="section-header">
        <h3>عميل جديد</h3>
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
        <form action="{{ url('cp/customers/store') }}" method="post">
            @csrf
            <div class="customer-data">

                <div>
                    <label for="">اسم العميل</label>
                    <input type="text" name="name"
                        value="{{ session('lastInputs') ? session('lastInputs')['name'] : '' }}">
                </div>
                <div>
                    <label for="">التليفون</label>
                    <input type="text" name="phone"
                        value="{{ session('lastInputs') ? session('lastInputs')['phone'] : '' }}">
                </div>
                <div>
                    <label for="">العنوان</label>
                    <textarea name="address">{{ session('lastInputs') ? session('lastInputs')['address'] : '' }}</textarea>
                </div>
                <div>
                    <label for="">تفاصيل اخرى</label>
                    <textarea name="details">{{ session('lastInputs') ? session('lastInputs')['details'] : '' }}</textarea>
                </div>
            </div>
            <div class="block-buttons">
                <input type="submit" value="حفظ" >
                <a href="{{ url('cp/customers') }}">الغاء</a>
            </div>
        </form>
    </div>

@endsection
