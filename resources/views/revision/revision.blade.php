@extends('layout.main')
@section('title', 'مراجعة')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/revision/revision.css') }}">
@endsection

@section('active-revision', 'active-revision')

@section('scripts')
    <script src="{{url('assets/js/lib/dateTime.js')}}"></script>
    <script src="{{url('assets/js/revision/revision.js')}}"></script>
@endsection

@section('active-revision', 'active-revision')

@section('content')
    <div class="container">
        <form class="date-div" action="{{url('revision/showindate')}}">
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
                    <th>مطلوب للمراجعة</th>
                    <th>صورة</th>
                    <th>تفاصيل</th>
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
                            <td>{{$order->works_count}}</td>
                            <td>{{$order->required_revision_count}}</td>
                            @if ($order->image !=null)
                                <td><a href="{{url($order->image)}}"><img src="{{url('assets/images/svg/default_image.svg')}}" alt="" width="25"></a></td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$order->details}}</td>
                            <td><a href="{{url('revision/show/'.$order->id)}}">View</a></td>
                        </tr>
                    @endforeach                    
                @endif
            </table>
        </div>
    </div>
@endsection
