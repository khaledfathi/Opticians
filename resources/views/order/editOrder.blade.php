@extends('layout.main')
@section('title', 'تحديث امر شغل')

@section('links')
    <link rel="stylesheet" href="{{ asset('assets/css/order/order.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/order/editOrder.css') }}">
@endsection

@section('scripts')
    <script src="{{ url('assets/js/lib/ajax.js') }}"></script>
    <script src="{{ url('assets/js/order/editOrder.js') }}"></script>
@endsection

@section('active-order', 'active-order')

@section('content')
    <div class="container">

        <div class="section-header">
            <h3>تحديث امر شغل</h3>
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
        </div>
        <form action="{{ url('order/update') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- Order --}}
            <div class="order">
                <input type="hidden" name="id" value="{{$order->id}}">
                <div class="order__block-a">
                    <div>
                        <label for="">تاريخ</label>
                        <input type="date" id="order-date" name="date" value="{{ $order->date }}">
                    </div>
                    <div>
                        <label for="">الوقت</label>
                        <input type="time" id="order-time" name="time"
                            value="{{ date('H:i', strtotime($order->time)) }}">
                    </div>
                    <div>
                        <label for="">تارخ التسليم</label>
                        <input type="date" name="delivery_date" value="{{ $order->delivery_date }}">
                    </div>
                </div>
                <div class="order__block-b">
                    <div>
                        <label for="">العميل</label>
                        <select name="customer_id">
                            @foreach ($customers as $customer)
                                @if ($order->customer_id == $customer->id)
                                    <option selected value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @else
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="">نوع الشغل</label>
                        <input type="text" name="work_type" value="{{$order->type}}" readonly>
                    </div>                
                    <input type="hidden" id="default-image-icon" value="{{ asset('assets/images/svg/default_image.svg') }}">
                    @if($order->type == 'صيانة')
                        <div class="order__image" id="order-single-image-div">
                            @if ($order->image)
                                <img id="order-upload-image" src="{{ asset($order->image) }}" alt=""
                                    style="width:200px !important;">
                            @else
                                <img id="order-upload-image" src="{{ asset('assets/images/svg/default_image.svg') }}"
                                    alt="">
                            @endif
                            <input type="file" accept="image/*" id="order-upload-image-file" name="image">
                            <input type="hidden" name="delete_order_image_status" id="delete-order-image-status" value="0" >
                            <button id="remove-order-image-button" type="button">الغاء الصورة</button>
                        </div>
                    @endif
                </div>
                <div>
                    <label for="">تفاصيل اخرى</label>
                    <textarea cols="10" rows="3" name="details">{{ $order->details }}</textarea>
                </div>
                @if ($order->type == 'صيانة')
                    <div class="order-revision-div">
                        <input type="hidden" name="order_revision_status" id="order-revision-status" value="{{$order->revision}}" >
                        @if ($order->revision)
                            <p id="order-revision-status-msg">تمت المراجعة بواسطة : {{$order->revisioner}}</p>
                            <button type="button" id="cancel-order-revision-button">الغاء المراجعة</button>
                        @else
                            <p>لم يتم مراجعتة</p>
                        @endif
                    </div>
                @endif
            </div>
            {{-- end Order --}}

            {{-- Order-details --}}
            <div class="order-details">
                {{-- work-container-div --}}
                <div class="order-details-container" id="work-container-div">
                    {{-- glasses (userd to clone from it) --}}
                    <div class="glasses" id="work-div" style="display:none" lang="en">
                        {{-- glasses__right --}}
                        <div class="glasses__lens glasses__lens--right">
                            <span>Left</span>
                            <div>
                                <label for="">sphere</label>
                                <input type="number" min="-30" max="30"
                                    oninvalid="this.setCustomValidity('القيمة من -30 الى 30')"
                                    oninput="setCustomValidity('')" step="0.01">
                            </div>

                            <div>
                                <label for="">cylinder</label>
                                <input type="number" min="-10" max="10"
                                    oninvalid="this.setCustomValidity('القيمة من -10 الى 10')"
                                    oninput="setCustomValidity('')" step="0.01">
                            </div>

                            <div>
                                <label for="">axis</label>
                                <input type="number" min="1" max="180"
                                    oninvalid="this.setCustomValidity('القيمة من 1 الى 180')"
                                    oninput="setCustomValidity('')" step="0.01">
                            </div>

                            <div name="add-option-div" hidden>
                                <label for="">add</label>
                                <input type="number" oninvalid="this.setCustomValidity('')" step="0.01">
                            </div>
                        </div>
                        {{-- end glasses__right --}}

                        {{-- glasses__left --}}
                        <div class="glasses__lens glasses__lens--left">
                            <span>Right</span>
                            <div>
                                <label for="">sphere</label>
                                <input type="number" min="-30" max="30"
                                    oninvalid="this.setCustomValidity('القيمة من -30 الى 30')"
                                    oninput="setCustomValidity('')" step="0.01">
                            </div>

                            <div>
                                <label for="">cylinder</label>
                                <input type="number" min="-10" max="10"
                                    oninvalid="this.setCustomValidity('القيمة من -10 الى 10')"
                                    oninput="setCustomValidity('')" step="0.01">
                            </div>

                            <div>
                                <label for="">axis</label>
                                <input type="number" min="1" max="180"
                                    oninvalid="this.setCustomValidity('القيمة من 1 الى 180')"
                                    oninput="setCustomValidity('')" step="0.01">
                            </div>

                            <div name="add-option-div" hidden>
                                <label for="">add</label>
                                <input type="number" step="0.01">
                            </div>

                        </div>
                        {{-- end glasses__left --}}

                        {{-- glasses__add --}}
                        <div class="add-option">
                            <div>
                                <input type="checkbox">
                                <label>add</label>
                            </div>
                            <div>
                                <input type="checkbox">
                                <label>bind</label>
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
                            <button type="button">الغاء الصورة</button>
                        </div>
                        {{-- end prescription --}}
                        <div class="glasses__buttons">
                            <button type="button">حذف</button>
                        </div>
                    </div>
                    {{-- end glasses --}}

                    {{-- work div (revived from backend) --}}
                    @if ($works)
                        @foreach ($works as $work)
                            <div class="glasses" id="work-div" lang="en">
                                {{-- glasses__right --}}
                                <div class="glasses__lens glasses__lens--right">
                                    <span>Left</span>
                                    <div>
                                        <label for="">sphere</label>
                                        <input type="number" min="-30" max="30"
                                            oninvalid="this.setCustomValidity('القيمة من -30 الى 30')"
                                            oninput="setCustomValidity('')" step="0.01"
                                            value="{{ $work->l_sphere }}">
                                    </div>

                                    <div>
                                        <label for="">cylinder</label>
                                        <input type="number" min="-10" max="10"
                                            oninvalid="this.setCustomValidity('القيمة من -10 الى 10')"
                                            oninput="setCustomValidity('')" step="0.01"
                                            value="{{ $work->l_cylinder }}">
                                    </div>

                                    <div>
                                        <label for="">axis</label>
                                        <input type="number" min="1" max="180"
                                            oninvalid="this.setCustomValidity('القيمة من 1 الى 180')"
                                            oninput="setCustomValidity('')" step="0.01" value="{{ $work->l_axis }}">
                                    </div>
                                    {{-- show add if it has value  --}}
                                    @if ($work->r_add || $work->l_add)
                                        <div name="add-option-div">
                                        @else
                                            <div name="add-option-div" hidden>
                                    @endif
                                    <label for="">add</label>
                                    <input type="number" oninvalid="this.setCustomValidity('')" step="0.01"
                                        value="{{ $work->l_add }}">
                                </div>
                            </div>
                            {{-- end glasses__right --}}

                            {{-- glasses__left --}}
                            <div class="glasses__lens glasses__lens--left">
                                <span>Right</span>
                                <div>
                                    <label for="">sphere</label>
                                    <input type="number" min="-30" max="30"
                                        oninvalid="this.setCustomValidity('القيمة من -30 الى 30')"
                                        oninput="setCustomValidity('')" step="0.01" value="{{ $work->r_sphere }}">
                                </div>

                                <div>
                                    <label for="">cylinder</label>
                                    <input type="number" min="-10" max="10"
                                        oninvalid="this.setCustomValidity('القيمة من -10 الى 10')"
                                        oninput="setCustomValidity('')" step="0.01" value="{{ $work->r_cylinder }}">
                                </div>

                                <div>
                                    <label for="">axis</label>
                                    <input type="number" min="1" max="180"
                                        oninvalid="this.setCustomValidity('القيمة من 1 الى 180')"
                                        oninput="setCustomValidity('')" step="0.01" value="{{ $work->r_axis }}">
                                </div>

                                {{-- show add if it has value  --}}
                                @if ($work->r_add || $work->l_add)
                                    <div name="add-option-div">
                                @else
                                    <div name="add-option-div" hidden>
                                @endif
                                        <label for="">add</label>
                                        <input type="number" step="0.01" value="{{ $work->r_add }}">
                                    </div>
                            </div>
                        {{-- end glasses__left --}}

                {{-- glasses__add --}}
                <div class="add-option">
                    <div>
                        @if ($work->r_add || $work->l_add)
                            <input type="checkbox" checked>
                        @else
                            <input type="checkbox">
                        @endif
                        <label>add</label>
                    </div>
                    <div>
                        <input type="checkbox">
                        <label>bind</label>
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
                                    @if ($lens->name == $work->lens_name)
                                        <option selected value="{{ $lens->id }}">{{ $lens->name }}</option>
                                    @else
                                        <option value="{{ $lens->id }}">{{ $lens->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="">نوع الفريم</label>
                            <select>
                                @foreach ($frames as $frame)
                                    @if ($frame->name == $work->frame_name)
                                        <option selected value="{{ $frame->id }}">{{ $frame->name }}</option>
                                    @else
                                        <option value="{{ $frame->id }}">{{ $frame->name }}</option>
                                    @endif
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
                    @if ($work->work_image)
                        <img class="presctiption-image" src="{{ url($work->work_image) }}" alt="" id="presctiption-upload-image" >
                    @else
                        <img src="{{ url('assets/images/svg/default_image.svg') }}" alt="" id="presctiption-upload-image">
                    @endif
                    <input type="file" accept="image/*" hidden>
                    <button type="button">الغاء الصورة</button>
                </div>
                {{-- end prescription --}}
                <div class="glasses__buttons">
                    <button type="button">حذف</button>

                </div>
                <div class="work-revision-div">
                    @if ($work->revision)
                        <input type="hidden" value="{{ $work->revision }}">
                        <p>تمت مراجعتة بواسطة {{ $work->revisioner }}</p>
                        <button type="button">الغاء المراجعة</button>
                    @else
                        <input type="hidden" value="{{ $work->revision }}">
                        <p>لم يتم مراجعتة</p>
                    @endif
                </div>
                <div hidden>
                    <input type="hidden" value="{{ $work->id }}"> {{-- work id --}}
                    <input type="hidden" value="0"> {{-- delete status --}}
                    <input type="hidden" value="0"> {{-- delete image status --}}
                </div>
            </div>
            @endforeach
            @endif

            {{-- end work div (revived from backend) --}}
    </div>
    {{-- end work-container-div --}}

    {{-- add more Order-details --}}
    <div class="glasses__more-order">
        <button id="add-work-button" type="button" hidden>اضافة طلب</button>
    </div>
    {{-- end add more Order-details --}}
    </div>
    <input type="hidden" id="order-details" name="order_details">
    {{-- end Order-details --}}


    {{-- order-buttons --}}
    <div class="order-buttons">
        <img class="loading-image" id="loading-image" src="{{ asset('assets/images/gif/loading.gif') }}"
            alt="">
        <input type="submit" value="تحديث امر شغل" id="submit-button">
    </div>
    {{-- end order-buttons --}}
    </form>
    </div>
@endsection
