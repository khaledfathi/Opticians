@extends('layout.main')
@section('title', 'ادارة العملاء')
@section('links')
    <link rel="stylesheet" href="{{ asset('') }}">
@endsection
@section('active-cpanel', 'active-cpanel')

@section('content')
    <div class="container">
        <div>
            <a href="{{ url('cpanel/customers/new') }}">اضافة عميل جديد</a>
            <a href="{{ url('cpanel') }}">عودة للوحة التحكم</a>
        </div>
        <div class="msg">
            @if ($errors->any())
                <p>{{ $errors->first() }}</p>
            @elseif (session('ok'))
                <p class="msg_ok">{{ session('ok') }}</p>
            @endif
        </div>
        <div>
            <table>
                <thead>
                    <th>اسم العميل</th>
                    <th>التليفون</th>
                    <th>العنوان</th>
                    <th>تفاصيل اخرى</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </thead>
                @if ($records)
                    <tbody>
                        @foreach ($records as $record)
                            <tr>
                                <td>{{ $record->name }}</td>
                                <td>{{ $record->phone }}</td>
                                <td>{{ $record->address }}</td>
                                <td>{{ $record->details }}</td>
                                <td>Edit</td>
                                <td><a href="{{url('cpanel/customers/delete/'.$record->id)}}">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>

@endsection
