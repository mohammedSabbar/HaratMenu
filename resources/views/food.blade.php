@extends('layout.app')

@section('css')
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <button type="button" class="btn btn-warning btn-sm hrins_color"  data-toggle="modal" data-target="#add">اضافة <i class="mdi mdi-plus ml-1"></i></button>
            </div>

           @include('modal.add-food-modal')

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table" style="text-align: center;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>القسم</th>
                                <th>الوصف</th>
                                <th>الاسم (انكليزي)</th>
{{--                                <th>الوصف (انكليزي)</th>--}}
                                <th>السعر</th>
                                <th>السعر بعد الخصم</th>
                                <th>الحالة</th>
                                <th>الخيارات</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">

                            @forelse($data['food'] as $key => $value)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$value->name_ar}}</td>
                                    <td>{{$value->category->name_ar}}</td>
                                    <td>{{Illuminate\Support\Str::limit($value->description_ar,30)}}</td>
                                    <td>{{$value->name_en}}</td>
{{--                                    <td>{{$value->description_en}}</td>--}}
                                    <td>{{number_format($value->price)}}</td>
                                    <td>@if($value->price_discounted != 0){{number_format($value->price_discounted)}} @endif</td>
                                    <td>
                                        @if($value->status)
                                            <div class="badge badge-success badge-fw">متوفر</div>
                                        @else
                                            <div class="badge badge-danger badge-fw">غير متوفر</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="#Input" id="edit" class="btn btn-inverse-info" data-toggle="modal" data-target="#model" data-attr="{{route('food.edit', $value->id)}}">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="/{{$value->image}}" target="_blank" class="btn btn-inverse-info">
                                                <i class="mdi mdi-tooltip-image"></i>
                                            </a>
                                            <a href="#Input" id="delete" class="btn btn-inverse-info" data-toggle="modal" data-target="#delete_modal_{{$value->id}}" >
                                                <i class="mdi mdi-delete-forever"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            @include('modal.delete-food-modal',$value)
{{--                            @include('admin.modal.change-password',$value)--}}

                            @empty
                                <h5>القائمة خالية</h5>
                            @endforelse

                            </tbody>
                        </table>

                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" id="modalBody">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('js')
    <!-- Custom js for this page-->
    <script src="{{asset('theme/js/data-table.js')}}"></script>
    <script src="{{asset('theme/js/modal-demo.js')}}"></script>
    <script>
        // display a buy_modal (small modal)
        $(document).on('click', '#edit', function(event) {
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
    </script>
    <!-- End custom js for this page-->
@stop
