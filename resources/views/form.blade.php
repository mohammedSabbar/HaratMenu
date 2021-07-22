@extends('layout.app')

@section('css')
@stop

@section('content')
    <div class="card">
        <div class="card-body" style="text-align: right">
            <div class="accordion-bordered" id="accordion" role="tablist">
                <div class="card">
                    <div class="card-header" role="tab" id="heading-1">
                        <h6 class="mb-0">
                            <a data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                اختر الفترة الزمنية
                            </a>
                        </h6>
                    </div>
                    <div id="collapse-1" class="collapse show" role="tabpanel" aria-labelledby="heading-1" data-parent="#accordion">
                        <div class="card-body">
                            <form action="{{route('searchByDate')}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>من تاريخ</label>
                                        <input type="date" class="form-control" placeholder="من تاريخ" name="start">
                                    </div>

                                    <div class="col-md-4">
                                        <label>الى تاريخ</label>
                                        <input type="date" class="form-control" placeholder="الى تاريخ" name="end">
                                    </div>
                                    <div class="col-md-4" style="margin-top: 40px">

                                        <button type="submit" class="btn btn-warning btn-sm hrins_color" >بحث <i class="mdi mdi-search-web"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="text-center">
                <a href="{{route('printAll')}}@if(isset($_GET['start']))?start={{$_GET['start']}}&end={{$_GET['end']}} @endif" class="btn btn-warning btn-sm hrins_color" target="_blank">طباعة الكل <i class="mdi mdi-printer ml-1"></i></a>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table" style="text-align: center;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الزبون</th>
                                <th>رقم الهاتف</th>
                                <th>المقترحات</th>
                                <th>رقم الطاولة</th>
                                <th>التاريخ</th>
                                <th>نتائج الاستبيان</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">

                            @forelse($data['form'] as $key => $value)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$value->customer_name}}</td>
                                    <td>{{$value->customer_phone}}</td>
                                    <td>{{$value->suggestion}}</td>
                                    <td>{{$value->table_number}}</td>
                                    <td>{{\Carbon\Carbon::parse($value->created_at)->format('Y-m-d')}} | {{\Carbon\Carbon::parse($value->created_at)->format('H:i')}}</td>
                                    <td>
                                        <div class="btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="#Input" id="show" class="btn btn-inverse-info" data-toggle="modal" data-target="#model" data-attr="{{route('form.show', $value->id)}}">
                                                <i class="mdi mdi-star-half"></i>
                                            </a>
                                            <a href="{{route('print',$value->id)}}" target="_blank" class="btn btn-inverse-info">
                                                <i class="mdi mdi-printer"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

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
        $(document).on('click', '#show', function(event) {
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
