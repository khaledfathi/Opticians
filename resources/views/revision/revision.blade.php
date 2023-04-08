@extends('layout.main')
@section('title', 'مراجعة')

@section('links')
    <link rel="stylesheet" href="{{ asset('') }}">
@endsection

@section('active-revision', 'active-revision')

@section('content')
    <div class="container">
        <div>
            <p>قائمة الشغل</p>
            <input type="date">
            <button>عرض</button>
        </div>
        <table>
            <thead>
                <th>رقم الشغل</th>
                <th>الوقت</th>
                <th>العميل</th>
                <th>نوع الشغل</th>
                <th>تفاصيل</th>
                <th>مراجعة</th>
                <th>عرض</th>
            </thead>
        </table>
    </div>
@endsection
