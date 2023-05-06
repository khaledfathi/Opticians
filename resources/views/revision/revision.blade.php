@extends('layout.main')
@section('title', 'مراجعة')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/revision/revision.css') }}">
@endsection

@section('active-revision', 'active-revision')

@section('scripts')
    <script src="{{ url('assets/js/lib/ajax.js') }}"></script>
    <script src="{{ url('assets/js/lib/dateTime.js') }}"></script>
    <script src="{{ url('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('assets/js/revision/revision.js') }}"></script>
@endsection

@section('active-revision', 'active-revision')

@section('content')
    <div class="container">
        <form class="date-div" action="{{ url('revision/showindate') }}">
            <input type="date" name="date" id="date">
            <input type="submit" value="عرض">
        </form>
        @if ($orders)
            <p style="text-align:center;"> عدد اوامر الشغل = {{ $ordersCount }}  {{($orders->count()) ? ' | تاريخ = '.$orders[0]->date : ''}}</p>
        @endif
        <div class="results">
            <table>
                <thead>
                    <th>رقم الشغل</th>
                    <th>بواسطة</th>
                    <th>الوقت</th>
                    <th>تاريخ التسليم</th>
                    <th>العميل</th>
                    <th>نوع الشغل</th>
                    <th>الطلبات</th>
                    <th>مطلوب للمراجعة</th>
                    {{-- <th>صورة</th> --}}
                    <th>تفاصيل</th>
                    @if (auth()->user()->type == 'admin')
                        <th>تعديل</th>
                        <th>حذف</th>
                    @endif
                    <th>عرض</th>
                </thead>
                <tbody id="table-body">
                    @if ($orders)
                        @foreach ($orders as $order)
                            <tr>
                                <input type="hidden" value="{{ url('revision/show/' . $order->id) }}">
                                <td width="5%">{{ $order->id }}</td>
                                <td>{{ $order->user_name }}</td>
                                <td >{{ date('h:i a', strtotime($order->time)) }}</td>
                                <td>{{ $order->delivery_date }}</td>
                                <td width="15%">{{ $order->customer_name }}</td>
                                <td width="5%">{{ $order->type }}</td>
                                <td width="5%">{{ $order->works_count }}</td>
                                <td width="5%">{{ $order->required_revision_count }}</td>
                                <td width="30%">{{ $order->details }}</td>
                                @if (auth()->user()->type == 'admin')
                                    <td><a href="{{ url('order/edit/' . $order->id) }}"><img
                                                class="icon-buttons"src="{{ asset('assets/images/svg/edit.svg') }}"
                                                alt=""></a></td>
                                    <td><input type="hidden" value="{{ url('revision/destroy/' . $order->id) }}"><img
                                            class="icon-buttons" name="delete-button"
                                            src="{{ asset('assets/images/svg/delete.svg') }}" alt=""></td>
                                @endif
                                <td><a href="{{ url('revision/show/' . $order->id) }}"><img class="icon-buttons"
                                            src="{{ asset('assets/images/svg/view.svg') }}" alt=""></a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
