@extends('layout.main')
@section('title', 'مراجعة امر شغل')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/revision/showOrder.css') }}">
@endsection

@section('active-revision', 'active-revision')

@section('scripts')
@endsection

@section('active-revision', 'active-revision')

@section('content')
    <div class="container">
        @if ($order)
            <div class="order-data">
                <div>
                    <div>
                        <label> تاريخ </label>
                        <input type="text" readonly value="{{ $order->date }}">
                    </div>
                    <div>
                        <label>الوقت</label>
                        <input type="text" readonly value="{{ $order->time }}">
                    </div>
                    <div>
                        <label>تاريخ التسليم</label>
                        <input type="text" readonly value="{{ $order->delivery_date }}">
                    </div>
                    <div>
                        <label>العميل</label>
                        <input type="text" readonly value="{{ $order->customer_name }}">
                    </div>
                </div>
                <div>
                    <div>
                        <label>نوع الشغل</label>
                        <input type="text" readonly value="{{ $order->type }}">
                    </div>
                    <div>
                        <label>عدد الطلبات</label>
                        <input type="text" readonly value="{{ $order->works_count }}">
                    </div>
                    <div>
                        <label>تفاصيل</label>
                        <textarea readonly>{{ $order->details }}</textarea>
                    </div>
                    <div>
                        @if ($order->image)
                            <label >صورة </label>
                            <img src="{{ url($order->image) }}" alt="صورة الشغل" width="100">
                        @endif
                    </div>
                </div>
            </div>
            <div class="works">
                @if ($orderDetails)
                    @foreach ($orderDetails as $work)
                        <div class="work">
                            <div class="lenses">
                                <div class="lens">
                                    <p>Left</p>
                                    <div>
                                        <label for="">sphere</label>
                                        <input type="text" readonly value={{ $work->l_sphere }}>
                                    </div>
                                    <div>
                                        <label for="">cylinder</label>
                                        <input type="text" readonly value={{ $work->l_cylinder }}>
                                    </div>
                                    <div>
                                        <label for="">axis</label>
                                        <input type="text" readonly value={{ $work->l_axis }}>
                                    </div>
                                    <div>
                                        <label for="">add</label>
                                        <input type="text" readonly value={{ $work->l_add }}>
                                    </div>
                                </div>
                                <div class="lens">
                                    <p>Right</p>
                                    <div>
                                        <label for="">sphere</label>
                                        <input type="text" readonly value={{ $work->r_sphere }}>
                                    </div>
                                    <div>
                                        <label for="">cylinder</label>
                                        <input type="text" readonly value={{ $work->r_cylinder }}>
                                    </div>
                                    <div>
                                        <label for="">axis</label>
                                        <input type="text" readonly value={{ $work->r_axis }}>
                                    </div>
                                    <div>
                                        <label for="">add</label>
                                        <input type="text" readonly value={{ $work->r_add }}>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="">نوع العدسة</label>
                                <input type="text" readonly value={{ $work->lens_name }}>
                            </div>
                            <div>
                                <label for="">نوع الفريم</label>
                                <input type="text" readonly value={{ $work->frame_name }}>
                            </div>
                            <div>
                                <label for="">العدد</label>
                                <input type="text" readonly value={{ $work->count }}>
                            </div>
                            <div>
                                <label for="">تفاصيل</label>
                                <input type="text" readonly value={{ $work->details }}>
                            </div>

                            @if ($work->work_image)
                                <div>
                                    <label for="">روشتة</label>
                                    <img src="{{ url($work->work_image) }}" alt="" width="100">
                                </div>
                            @endif

                            <div>
                                <button>مراجعة (تمت المراجعة بواسطة admin)</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @else
            <div>
                <h3>امر الشغل المستهدف غير مسجل بالنظام</h3>
            </div>
        @endif
    </div>
@endsection
