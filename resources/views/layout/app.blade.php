<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    @include('layout.head')
    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="sidebar-mini">
    <div class="container-scroller">
        @include('layout.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('layout.setting_wrapper')
            @include('layout.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    @include('layout.alert')
                    @yield('content')
                </div>
                @include('layout.footer')
            </div>

        </div>
    </div><!-- container-scroller -->
</body>
    @include('layout.script')
    @yield('js')
</html>
