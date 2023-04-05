@extends('layout.main')
@section('title', 'ادارة المستخدمين')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/usersManagment/usersManagment.css') }}">
@endsection
@section('active-cpanel', 'active-cpanel')

@section('content')
    <div class="container">
        <div>
            <a href="{{ url('cpanel/users/new') }}">اضافة مستخدم جديد</a>
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
                    <th>اسم المستخدم</th>
                    <th>التليفون</th>
                    <th>النوع</th>
                    <th>الحالة</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </thead>
                @if ($records)
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td>{{$record->name}}</td>
                                <td>{{$record->phone}}</td>
                                <td>{{$record->type}}</td>                                
                                @if ($record->status=='enabled')
                                    <td>نشط</td>
                                @elseif($record->status=='disabled')
                                    <td>غير نشط</td>
                                @endif
                                <td>edit</td>
                                <td><a href="{{url('cpanel/users/delete/'.$record->id)}}">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>

@endsection
