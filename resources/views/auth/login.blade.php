<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <title>Login</title>

    <style>
        @font-face {
            font-family: 'Cairo'; src: url('{{asset('theme/fonts/Cairo/Cairo-Regular.ttf')}}')
        }

        body,a,p,h1,h2,h3,h4,h5,h6
        {
            font-family: 'Cairo', sans-serif !important;
        }
        body {
            background: #eee !important;
        }

        .wrapper {
            margin-top: 80px;
            margin-bottom: 80px;
        }

        .form-signin {
            max-width: 380px;
            padding: 15px 35px 45px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 30px;
        }
        .form-signin .checkbox {
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type=text] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        .form-signin input[type=password] {
            margin-bottom: 20px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body>
<div class="wrapper" style="text-align: center">
    <img src="{{asset('/theme/images/trend.png')}}" width="150px" style="margin-bottom: 50px">
    <form method="POST" action="{{ route('login') }}" class="form-signin">
        @csrf
        <h2 class="form-signin-heading">تسجيل الدخول</h2>
        <input type="email" class="form-control" name="email"   placeholder="اسم المستخدم" required=""  value="{{ old('emial') }}"/>
        <input type="password" class="form-control" name="password" placeholder="كلمة السر" required="" value="{{ old('password') }}"/>
        <button class="btn btn-lg btn-warning btn-block" type="submit">تسجيل الدخول</button>
    </form>
</div>
</body>
</html>
