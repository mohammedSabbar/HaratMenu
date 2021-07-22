<!DOCTYPE html>
<html lang="en"  dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>طباعة الاستبيان</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{asset('theme/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css')}}">
    <style>
        @font-face {
            font-family: 'Cairo'; src: url('{{asset('theme/fonts/Cairo/Cairo-Regular.ttf')}}')
        }

        body,a,p,h1,h2,h3,h4,h5,h6,th
        {
            font-family: 'Cairo', sans-serif !important;
        }
        select.form-control{
            color: black;
            text-align: center;
        }
        @page
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
        {{--body{--}}
        {{--    background-image: url("{{asset('img/logo_invoice.png')}}");--}}
        {{--}--}}
        .content {
            position: relative;
            margin: 0;
        }
        .wattermark {
        {{--content: "";--}}
        {{--position: absolute;--}}
        {{--z-index: 9999;--}}
        {{--top: 0;--}}
        {{--bottom: 0;--}}
        {{--left: 0;--}}
        {{--right: 0;--}}
        {{--background:--}}
        {{--    url('{{asset('theme/images/logo.png')}}')--}}
        {{--    center no-repeat ;--}}
        {{--opacity: 0.2;--}}
        }
        thead th { border-bottom: solid 0.25em black; }
        .question td { border-bottom: solid 1px gray; }
    </style>
</head>

<body>
@foreach($data as $form)
<!--Mailing Start-->
<div class="wattermark"></div>
<div class="content" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="height: 105vh !important; background-color:#ffffff; max-width:22cm; font-family: Helvetica,Arial,sans-serif !important; margin-bottom: 40px; position: relative;">
    <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px; padding-top: 20px;"
           heigth="auto">

        <tbody>
        <tr>
            <td valign="center" style="padding-bottom:20px;border-top:0;width:100% !important;">
                <img src="{{asset('theme/images/logo1.png')}}" height="70" width="90">
            </td>
            <td align="right" valign="center" style="padding-bottom:20px;border-top:0;width:100% !important;">
                <p style=" font-weight: normal; line-height: 1.2; font-size: 12px; white-space: nowrap; ">
                    مطعم بيت حلب<br>  <br>
                    <span dir="ltr">فرع اليرموك</span>
                </p>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="padding-top:30px; border-top:1px solid #f1f0f0">
                <table style="width: 100%;">
                    <tbody>
                    <tr>
                        <td style="vertical-align:middle; border-radius: 3px; padding:30px; background-color: #f9f9f9; border-right: 5px solid white; border: 1px solid black;">
                            <p style="color:#303030; font-size: 14px;  line-height: 1.6; margin:0; padding:0;">
                                السيد/ة
                                : {{$form->customer_name}}
                                <br>
                                {{$form->customer_phone}}
                            </p>
                        </td>

                        <td style="text-align: right; padding-top:0px; padding-bottom:0; vertical-align:middle; padding:30px; background-color: #f9f9f9; border-radius: 3px; border-left: 5px solid white; border: 1px solid black;">
                            <p style="float: left; font-size: 14px; padding: 0; line-height: 1.6; margin:0; ">
                                رقم الطاولة : #{{$form->table_number}}
                                <br>
                                التاريخ :
                                {{\Carbon\Carbon::parse($form->created_at)->format('Y-m-d')}}
                                <br>
                                الوقت :
                                {{\Carbon\Carbon::parse($form->created_at)->format('H:i')}}
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <table style="width: 100%; margin-top:40px; border: 1px solid black; padding: 20px;">
                    <thead>
                    <tr>
                        <th style=" font-weight: bold;text-align:right; font-size: 13px;  padding-bottom: 15px;">
                            الاستبيان
                        </th>
                        <th style=" font-weight: bold;text-align:right; font-size: 13px;  padding-bottom: 15px;">
                            جيد
                        </th>
                        <th style=" font-weight: bold;text-align:right; font-size: 13px;  padding-bottom: 15px;">
                            متوسط
                        </th>
                        <th style=" font-weight: bold;text-align:right; font-size: 13px; padding-bottom: 15px;">
                            دون المتوسط
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($form->formQuestion as $key=>$value)
                        <tr class="question">
                            <td style="width: 40%; padding-top:0px; padding-bottom:5px;">
                                <h4 style="font-size: 13px; text-decoration: none; font-weight:bold; line-height: 1; margin-bottom:0;">
                                    {{$value->question->title_ar}}</h4>
                            </td>
                            @for($i=1;$i<=3;$i++)
                                <td style="width: 10%; padding-top:0px; padding-bottom:5px;">
                                    <h4 style="font-size: 16px; margin-bottom:0; color:#303030; font-weight:500; margin-top: 10px;">
                                        @if($value->rating == $i)
                                            <i class="mdi mdi-checkbox-marked-circle mdi-24px"></i>
                                        @else
                                            <i class="mdi mdi-checkbox-blank-circle-outline  mdi-24px"></i>
                                        @endif
                                    </h4>
                                </td>
                            @endfor

                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            <h4 style="font-size: 13px; text-decoration: none; font-weight:bold; line-height: 1; margin-bottom:0;">كم مرة تقوم بزيارة مطعمنا ؟</h4>
                        </td>
                        <td>
                            <h4 style="border: 1px solid;text-align: center; font-size: 16px; margin-bottom:0; color:#303030; font-weight:500; margin-top: 10px; ">
                                {{$form->visit}}
                            </h4>
                        </td>
                        <td colspan="3"></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding: 0px 30px;"
           heigth="auto">

        <tr>
            <td colspan="3" style="border: 1px solid black; padding: 20px;" >
                <p>الاقتراحات :
                {{$form->suggestion??'لايوجد'}}</p>
            </td>
        </tr>
    </table>




</div>
<!--Mailing End-->
@endforeach
</body>
<script>
    window.print();
</script>
</html>
