@extends('layout.main')
@section('title', 'ادارة العملاء')
@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel/customers/customers.css') }}">
@endsection
@section('active-cpanel', 'active-cpanel')

@section('scripts')
    <script src="{{ url('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('assets/js/cpanel/customers/customers.js') }}"></script>
    <script src="{{ url('assets/js/lib/ajax.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="section-header">
            <h4>ادارة العملاء</h4>
        </div>
        <div class="manage-buttons">
            <a href="{{ url('cp/customers/create') }}">اضافة عميل جديد</a>
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
                    <th>اسم العميل</th>
                    <th>التليفون</th>
                    <th>العنوان</th>
                    <th>تفاصيل اخرى</th>
                    <th>تعديل</th>
                    <th>حذف</th>
                </thead>
                @if ($records)
                    <tbody id="table-body">
                        @foreach ($records as $record)
                            <tr>
                                <input type="hidden" value="{{url('cp/customers/'.$record->id)}}">
                                <td>{{ $record->name }}</td>
                                <td>{{ $record->phone }}</td>
                                <td>{{ $record->address }}</td>
                                <td>{{ $record->details }}</td>
                                <td>
                                    <a href="{{ url('cp/customers/' . $record->id) }}">
                                        <img class="control-icon" src="{{ url('assets/images/svg/edit.svg') }}"
                                            alt="delete_icon">
                                    </a>
                                </td>
                                <td>
                                    <input type="hidden" value="{{ url('cp/customers/destroy/' . $record->id) }}">
                                    <img class="control-icon" src="{{ url('assets/images/svg/delete.svg') }}"
                                        alt="delete_icon" name="delete-button">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>

@endsection
