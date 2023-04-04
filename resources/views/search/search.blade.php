@extends('layout.main')
@section('title', 'استعلام')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/search/search.css') }}">
@endsection
@section('active-search' , 'active-search') 

@section('content')
    <div class="content">
        <form action="">
            @csrf
            {{-- Search For --}}
            <div class="search-options">
                <div class="search-option__for">
                    <label for="">استعلام عن</label>
                    <select name="" id="">
                        <option value="">عميل</option>
                        <option value="">شغل</option>
                    </select>
                </div>
                <div class="search-option__by">
                    <label for="">استعلام بـ </label>
                    <div class="customer-by">
                        <select name="" id="">
                            <option value="">رقم العميل</option>
                            <option value="">اسم العميل</option>
                            <option value="">تليفون العميل</option>
                        </select>
                    </div>

                    <div class="order-by" hidden>
                        <select name="" id="">
                            <option value="">رقم التسجيل</option>
                            <option value="">التاريخ</option>
                            <option value="">اسم العميل</option>
                            <option value="">تليفون العميل</option>
                        </select>
                    </div>

                </div>
            </div>
            {{-- Find --}}
            <div class="find">
                <div class="find__text">
                    <input type="text">
                </div>
                <div class="find__date" hidden>
                    <input type="date">
                </div>
            </div>
            <div class="submit-block">
                <input type="submit" value="استعلام">
            </div>
        </form>
    </div>
@endsection
