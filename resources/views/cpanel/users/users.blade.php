@extends('layout.main')
@section('title', 'ادارة المستخدمين')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/users/users.css') }}">
@endsection
@section('active-cpanel', 'active-cpanel')

@section('scripts')
    <script src="{{ url('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('assets/js/cpanel/users/users.js') }}"></script>
    <script src="{{ url('assets/js/lib/ajax.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="section-header">
            <h3>ادارة المستخدمين</h3>
        </div>

        <div class="manage-buttons">
            <a href="{{ url('cp/users/create') }}">اضافة مستخدم جديد</a>
            <a href="{{ url('cp') }}">عودة للوحة التحكم</a>
        </div>

        @if ($errors->any())
            <div class="msg">
                <span class="msg__text msg__text--error">{{ $errors->first() }} <img class="msg__image"
                        src="{{ url('assets/images/svg/error.svg') }}" alt="error_icon"></span>
            </div>
        @elseif (session('ok'))
            <div class="msg">
                <span class="msg__text msg__text--ok">{{ session('ok') }} <img class="msg__image"
                        src="{{ url('assets/images/svg/ok.svg') }}" alt="ok_icon"></span>
            </div>
        @endif

        <div class="results">
            <table>
                <thead>
                    <th>#</th>
                    <th>اسم المستخدم</th>
                    <th>التليفون</th>
                    <th>النوع</th>
                    <th>الحالة</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </thead>
                @if ($records)
                    <tbody id="table-body">
                        @foreach ($records as $record)
                            <tr>
                                <input type="hidden" value="{{url('cp/users/'.$record->id)}}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $record->name }}</td>
                                <td>{{ $record->phone }}</td>
                                <td>{{ $record->type }}</td>
                                <td>{{ $record->status }}</td>
                                <td>
                                    <a href="{{ url('cp/users/' . $record->id) }}">
                                        <img class="control-icon" src="{{ url('assets/images/svg/edit.svg') }}"
                                            alt="edit_icon">
                                    </a>
                                </td>
                                <td>
                                    <input type="hidden" value="{{ url('cp/users/destroy/' . $record->id) }}">
                                    <img class="control-icon" src="{{ url('assets/images/svg/delete.svg') }}"
                                        alt="delete_icon" name="delete-button">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>

@endsection
