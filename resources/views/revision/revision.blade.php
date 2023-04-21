@extends('layout.main')
@section('title', 'مراجعة')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/revision/revision.css') }}">
@endsection

@section('active-revision', 'active-revision')

@section('content')
    <div class="container">
        <form class="date-div">
            <p>شغل يوم</p>
            <input type="date">
            <input type="submit" value="عرض">
        </form>
        <div class="results">
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
    </div>
@endsection
