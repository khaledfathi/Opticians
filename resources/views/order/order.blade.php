@extends('layout.main')
@section('title', 'ملف المستخدم')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/order/order.css') }}">
@endsection

@section('scripts')
    <script src="{{ url('assets/js/lib/dateTime.js') }}"></script>
    <script src="{{ url('assets/js/lib/ajax.js') }}"></script>
    <script src="{{ url('assets/js/order/order.js') }}"></script>
@endsection

@section('active-order', 'active-order')

@section('content')
    <div class="container">
        <div class="section-header">
            <h3>امر شغل</h3>
        </div>
        <form action="order/create" method="post" enctype="multipart/form-data">
            {{-- Order --}}
            <div class="order">
                <div class="order__block-a">
                    <div>
                        <label for="">تاريخ</label>
                        <input type="date" id="order-date" name="date">
                    </div>
                    <div>
                        <label for="">الوقت</label>
                        <input type="time" id="order-time" name="time">
                    </div>
                    <div>
                        <label for="">تارخ التسليم</label>
                        <input type="date" name="delivery_date">
                    </div>
                </div>
                <div class="order__block-b">
                    <div>
                        <label for="">العميل</label>
                        <select name="customer_id">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="">نوع الشغل</label>
                        <select id="work-type" name="work_type">
                            @foreach ($orderTypes as $type)
                                <option value="{{ $type->value }}">{{ $type->value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="order__image">
                        <img id="order-upload-image" src="{{ url('assets/images/svg/default_image.svg') }}" alt="">
                        <input type="file" accept="image/*" id="order-upload-image-file" name="order_image">
                        <button id="remove-order-image-button" type="button">الغاء الصورة</button>
                    </div>
                </div>
                <div>
                    <label for="">تفاصيل اخرى</label>
                    <textarea cols="10" rows="3"></textarea>
                </div>
            </div>
            {{-- end Order --}}

            {{-- Order-details --}}
            <div class="order-details">
                {{-- work-container-div --}}
                <div class="order-details-container" id="work-container-div">
                    {{-- glasses --}}
                    <div class="glasses" id="work-div" style="display:none">
                        {{-- glasses__right --}}
                        <div class="glasses__lens glasses__lens--right">
                            <span>Left</span>
                            <div>
                                <label for="">sphere</label>
                                <input type="number">
                            </div>

                            <div>
                                <label for="">cylinder</label>
                                <input type="number">
                            </div>

                            <div>
                                <label for="">axis</label>
                                <input type="number">
                            </div>

                            <div name="add-option-div" hidden>
                                <label for="">add</label>
                                <input type="number">
                            </div>
                        </div>
                        {{-- end glasses__right --}}

                        {{-- glasses__left --}}
                        <div class="glasses__lens glasses__lens--left">
                            <span>Right</span>
                            <div>
                                <label for="">sphere</label>
                                <input type="number">
                            </div>

                            <div>
                                <label for="">cylinder</label>
                                <input type="number">
                            </div>

                            <div>
                                <label for="">axis</label>
                                <input type="number">
                            </div>

                            <div name="add-option-div" hidden>
                                <label for="">add</label>
                                <input type="number">
                            </div>

                        </div>
                        {{-- end glasses__left --}}

                        {{-- glasses__add --}}
                        <div class="add-option">
                            <div>
                                <input type="checkbox">
                                <label >add</label>
                            </div>
                            <div>
                                <input  type="checkbox">
                                <label >bind</label>
                            </div>
                        </div>
                        {{-- endglasses__add --}}

                        {{-- lens type --}}
                        <div class="lens-options">
                            <div class="lens-options__block-a">
                                <div>
                                    <label for="">نوع العدسة</label>
                                    <select>
                                        @foreach ($lenses as $lens)
                                            <option value="{{ $lens->id }}">{{ $lens->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="">نوع الفريم</label>
                                    <select>
                                        @foreach ($frames as $frame)
                                            <option value="{{ $frame->id }}">{{ $frame->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="">العدد</label>
                                    <input type="number" min=0 value=1>
                                </div>
                            </div>
                            <div class="lens-options__block-b">
                                <div>
                                    <label for="">تفاصيل</label>
                                    <textarea></textarea>
                                </div>
                            </div>
                        </div>
                        {{-- end lens type --}}

                        {{-- prescription --}}
                        <div class="glasses_presctiption">
                            <label for="">روشتة</label>
                            <img src="{{ url('assets/images/svg/default_image.svg') }}" alt=""
                                id="presctiption-upload-image">
                            <input type="file" accept="image/*" hidden>
                            <button  type="button">الغاء الصورة</button>
                        </div>
                        {{-- end prescription --}}
                        <div class="glasses__buttons">
                            <button type="button">حذف</button>
                        </div>
                    </div>
                    {{-- end glasses --}}

                </div>
                {{-- end work-container-div --}}

                {{-- add more Order-details --}}
                <div class="glasses__more-order">
                    <button id="add-work-button" type="button" hidden>اضافة طلب</button>
                </div>
                {{-- end add more Order-details --}}
            </div>
            <input type="hidden" name="order_details">
            {{-- end Order-details --}}


            {{-- order-buttons --}}
            <div class="order-buttons">
                <input type="submit" value="تسجيل امر شغل">
            </div>
            {{-- end order-buttons --}}
        </form>
    </div>
@endsection
