@extends('layout.main')
@section('title', 'مراجعة')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/revision/revision.css') }}">
@endsection

@section('scripts')
    <script src="{{url('assets/js/lib/dateTime.js')}}"></script>
    <script src="{{url('assets/js/revision/revision.js')}}"></script>
@endsection

@section('active-revision', 'active-revision')

@section('content')
    <div class="container">
        <form class="date-div">
            <p>شغل يوم</p>
            <input type="date" name="date" id="date">
            <input type="submit" value="عرض">
        </form>
        <div class="results">
            @if($orders)
                <p> عدد اوامر الشغل = {{$ordersCount}}</p>
            @endif 
            <table>
                <thead>
                    <th>رقم الشغل</th>
                    <th>الوقت</th>
                    <th>تاريخ التسليم</th>
                    <th>العميل</th>
                    <th>نوع الشغل</th>
                    <th>الطلبات</th>
                    <th>صورة</th>
                    <th>تفاصيل</th>
                    <th>مطلوب للمراجعة</th>
                    <th>عرض</th>
                </thead>
                @if ($orders)
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->time}}</td>
                            <td>{{$order->delivery_date}}</td>
                            <td>{{$order->customer_name}}</td>
                            <td>{{$order->type}}</td>
                            <td>{{($order->works_count)?$order->works_count:1}}</td>
                            <td>{{$order->image}}</td>
                            <td>{{$order->details}}</td>
                            <td>NO</td>
                            <td><a href="{{url('revision/'.$order->id)}}">View</a></td>
                        </tr>
                    @endforeach                    
                @endif
            </table>
        </div>
    </div>
@endsection
