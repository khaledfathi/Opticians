@extends('layout.main')
@section('title', 'الفريمات')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/usersManagment/usersManagment.css') }}">
@endsection
@section('active-cpanel', 'active-cpanel')

@section('content')
    <div class="container">
        <div>
            <a href="{{ url('cpanel/frames/new') }}">اضافة فريم</a>
            <a href="{{ url('cpanel') }}">عودة للوحة التحكم</a>
        </div>
        <div class="msg">
            @if($errors->any())
                <p>{{$errors->first()}}</p>
            @elseif (session('ok'))
                <p class="msg_ok">{{ session('ok') }}</p>
            @endif
        </div>
        <div>
            <table>
                <thead>
                    <th>نوع الفريم</th>
                    <th>الوصف</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </thead>
                @if ($records)
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td>{{$record->name}}</td>
                                <td>{{$record->description}}</td>
                                <td>edit</td>
                                <td><a href="{{url('cpanel/frames/delete/'.$record->id)}}">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>

@endsection
