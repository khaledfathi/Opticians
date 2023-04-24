<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login/login.css') }}">
</head>

<body>
    @if ($errors->any())
        <div class="msg">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif
    <form action="{{ url('login') }}" method="post">
        @csrf
        <div>
            <label for="">اسم المستخدم</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="">كلمة المرور</label>
            <input type="password" name="password">
        </div>
        <input type="submit" value="دخول">
    </form>
</body>

</html>
