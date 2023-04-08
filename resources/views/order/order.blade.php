@extends('layout.main')
@section('title', 'ملف المستخدم')

@section('links')
    <link rel="stylesheet" href="{{ asset('') }}">
@endsection

@section('active-order', 'active-order')

@section('content')
    <div class="container">
        <form action="">

            <div>
                <label for="">تاريخ</label>
                <input type="date">
            </div>
            <div>
                <label for="">وقت</label>
                <input type="time">
            </div>
            <div>
                <label for="">تاريخ التسليم</label>
                <input type="date">
            </div>
            <div>
                <label for="">العميل</label>
                <select name="" id="">
                    <option value="">عميل</option>
                    <option value="">عميل</option>
                    <option value="">عميل</option>
                    <option value="">عميل</option>
                </select>
            </div>
            <div>
                <label for="">نوع الشغل</label>
                <select name="" id="">
                    <option value="">صيانة</option>
                    <option value="">شغل</option>
                </select>
            </div>
            <div>
                <label for="">تفاصيل</label>
                <textarea name="" id="" cols="30" rows="10"></textarea>
            </div>

            {{-- ORDERS --}}
            <div>
                <div>
                    <div class="right">
                        <p>RIGHT</p>
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
                        <div>
                            <img src="" alt="order_image">
                            <input type="file" accept='image/*'>                
                        </div>
                        <div>
                            <button type="button">حذف</button>
                        </div>
                    </div>

                    <div class="right">
                        <p>LEFT</p>
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
                        <div>
                            <img src="" alt="order_image">
                            <input type="file" accept='image/*'>                
                        </div>
                        <div>
                            <button type="button">حذف</button>
                        </div>
                        <div class='left'>

                        </div>
                    </div>
                </div>
                <div>
                    <button type="button">اضافة طلب اخر</button>
                </div>
                <div>
                    <input type="submit" value="تسجيل">
                </div>
        </form>
    </div>
@endsection
