<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>قائمة طعام مطعم بيت حلب</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/menu.css')}}">

    <!-- jQuery library -->
    <script src="{{asset('theme/js/jquery-3.4.1.min.js')}}"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<style>
    @font-face {
        font-family: 'Cairo'; src: url('{{asset('theme/fonts/Cairo/Cairo-Regular.ttf')}}')
    }

    body,a,p,h1,h2,h3,h4,h5,h6
    {
        font-family: 'Cairo', sans-serif !important;
    }
    body{
        background-image: url("{{asset('image/harat.jpg')}}");
        background-size: cover;
    }
</style>
<body>



<div dir="rtl" id="nav" class="sc-dIvqjp dDJAXc">
    <div class="container">
        <div class="justify-content-between align-items-center row">
            <div class="text-center col">
                <a class="brand" href="#">
                    <img src="{{asset('image/harat_logo.png')}}" alt="مطعم بيت حلب" style="height: 50px;">

                </a>
            </div>
        </div>
    </div>
</div>

<div dir="rtl" id="nav2" class="sc-dlnjPT dakihv">
    <div class="px-0 px-md-auto container" style="padding: 10px 0px">
        <div class="sc-hKFyIo bdDYJz row no-gutters" id="categories-list">
            @foreach($data['categories'] as $category)
                <div class="col">

                    <div dir="rtl" class="sc-eCApGN kJRDqT" onclick="getFood('{{route('menu.foodByCategory',$category->id)}}','{{$category->id}}')">
                        <div class="category-inner with-border remove_all_style" id="category_img_{{$category->id}}" style="@if($category->id == $data['foods'][0]->category_id) background: linear-gradient(0deg, rgba(129, 49, 50,0.3), rgba(129, 49, 50,0.3)), url('/{{$category->image}}');@endif">
{{--                            <div class="category-icon with-border"><img src="/{{$category->image}}"></div>--}}
                            <div class="category-title">{{$category->name_ar}}</div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="sc-crzoUp ixASIj">
<div class="container">
    <center><div class="spinner-border text-info" id="loader" style="margin-top: 30px; display: none"></div></center>
    <div class="no-gutters row" style="margin-top: 30px" id="foods">
        @foreach($data['foods'] as $value)
            <div class="product-col col-4 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                <a href="#Input"  data-toggle="modal" class="mt-2 ml-3" id="description" data-target="#modal" data-attr="{{route('menu.description', $value->id)}}">
                <div dir="rtl" class="sc-pNWxx cSBMRi">
                    <div class="product-image">
                        <div class="product-image-container">
                            <div class="lazyload-wrapper">
                                <img src="/{{$value->image}}" alt="{{$value->name_ar}}">
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-title d-flex align-items-start align-items-lg-center">{{$value->name_ar}}</div>
                        <div class="product-price ltr"><span class="current-price">{{number_format($value->price)}}</span></div>
                    </div>
                </div>
                </a>
            </div>

        @endforeach
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modalBody">
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=+9647733366900" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
</a>

</body>
<script>
    // display a buy_modal (small modal)
    $(document).on('click', '#description', function(event) {
        event.preventDefault();
        let href = $(this).attr('data-attr');
        displayModal(href);
    });

    function displayModal(href){

        $.ajax({
            url: href,
            beforeSend: function() {
                $('#loader').show();
            },
            // return the result
            success: function(result) {
                //alert('success');

                $('#modal').modal("show");
                $('#modalBody').html(result).show();
            },
            complete: function() {
                $('#loader').hide();
            },
            error: function(jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    }

    function getFood(url,category_id) {
        $.ajax({
            url: url,
            beforeSend: function () {
                $('#foods').fadeOut();
                $('#loader').show();
            },
            // return the result
            success: function (result) {
                //alert('success');

                $('#foods').html(result['foods']);
                $('#foods').fadeIn();
                $(".remove_all_style").removeAttr("style");
                $("#category_img_"+category_id).css({"background":"linear-gradient(0deg, rgba(129, 49, 50,0.3), rgba(129, 49, 50,0.3)), url('/"+result['category']['image']+"'"});
            },
            complete: function () {
                $('#loader').hide();
            },
            error: function (jqXHR, testStatus, error) {
                console.log(error);
                alert("Page " + href + " cannot open. Error:" + error);
                $('#loader').hide();
            },
            timeout: 8000
        })
    };

    // // Basice Code keep it
    // $(document).ready(function () {
    //     $(document).on("scroll", onScroll);
    //
    //     //smoothscroll
    //     $('a[href^="#"]').on('click', function (e) {
    //         e.preventDefault();
    //         $(document).off("scroll");
    //
    //         $('a').each(function () {
    //             $(this).removeClass('active');
    //         })
    //         $(this).addClass('active');
    //
    //         var target = this.hash,
    //             menu = target;
    //         $target = $(target);
    //         $('html, body').stop().animate({
    //             'scrollTop': $target.offset().top+2
    //         }, 500, 'swing', function () {
    //             window.location.hash = target;
    //             $(document).on("scroll", onScroll);
    //         });
    //     });
    // });
    //
    //
    // function onScroll(event){
    //     var scrollPos = $(document).scrollTop();
    //    // $('#nav2').removeClass('dakihv');
    // //    $('#nav2').addClass('cCREur');
    //
    //         if ($('#nav2').position().top <= scrollPos && $('#nav2').position().top + $('#nav2').height() > scrollPos) {
    //             $('#nav2').removeClass('dakihv');
    //             $('#nav2').addClass('cCREur');
    //         }
    //         else{
    //             $('#nav2').removeClass('cCREur');
    //             $('#nav2').addClass('dakihv');
    //         }
    //
    // }
</script>
</html>
