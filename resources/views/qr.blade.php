@extends('layout.app')

@section('css')
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-center">
                    <img src="{{asset('image/harat_qr.png')}}">
                </div>
            </div>

            <div class="text-center" style="margin-top: 20px">
                <a href="{{asset('image/harat_qr.png')}}" class="btn btn-warning btn-sm hrins_color">تحميل <i class="mdi mdi-download ml-1"></i></a>
                <a href="{{asset('menu')}}" class="btn btn-warning btn-sm hrins_color">عرض القائمة </a>
                <a href="{{url('/')}}/storage/food_menu.apk" class="btn btn-warning btn-sm hrins_color">تحميل نسخة الاندرويد </a>
            </div>

        </div>
    </div>
@stop


@section('js')
    <!-- Custom js for this page-->
    <script src="{{asset('theme/js/data-table.js')}}"></script>
    <script src="{{asset('theme/js/modal-demo.js')}}"></script>
    <!-- End custom js for this page-->
@stop
