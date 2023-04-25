@extends('layout.main')
@section('title', 'مراجعة امر شغل')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/revision/showOrder.css') }}">
@endsection

@section('active-revision', 'active-revision')

@section('scripts')
    <script src="{{ url('assets/js/lib/ajax.js') }}"></script>
    <script src="{{ url('assets/js/external/sweatAlert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ url('assets/js/order/showOrder.js') }}"></script>
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
                            <label>صورة </label>
                            <a href="{{ url($order->image) }}"><img
                                    src="{{ asset('assets/images/svg/default_image.svg') }}" alt="صورة الشغل"></a>
                        @endif
                    </div>
                </div>
                @if ($order->type == 'صيانة')
                    @if ($order->revision)
                        <button class="order-data__revision-button order-data__revision-button--green" >تمت المراجعة بواسطة : {{$order->revisioner}}</button>
                    @else
                        <button class="order-data__revision-button" id="order-revision-button">مراجعة</button>
                    @endif
                    <input type="hidden" id="order-revision-link" value="{{ url('revision/setrevision?id=' . $order->id) }}">
                @endif
            </div>
            <div class="works">
                @if ($orderDetails)
                    @foreach ($orderDetails as $work)
                        <div class="work">
                            <div class="lenses">
                                <div class="lens">
                                    <span>Left</span>
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
                                    <span>Right</span>
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
                            <div class="work-data">
                                <div class=work-date__block-a>
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
                                </div>
                                <div class=work-date__block-b>
                                    <div>
                                        <label for="">تفاصيل</label>
                                        <textarea readonly>{{ $work->details }}</textarea>
                                    </div>

                                    @if ($work->work_image)
                                        <div>
                                            <label for="">روشتة</label>
                                            <a href="{{ url($work->work_image) }}"><img
                                                    src="{{ asset('assets/images/svg/default_image.svg') }}"><a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="work-buttons">
                                <button type="button">مراجعة (تمت المراجعة بواسطة admin)</button>
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
