@extends('layout.app')

@section('css')
    <style>
       .product-image {
            height: calc(200px);
        }

       .product-image  img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: none;
        }
    </style>
@stop
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($data['category'] as $value)

            <div class="col-md-3" style="margin-top: 10px">
                <div class="card" style="text-align: center">
                    <div class="card-header">{{$value->name_ar}}</div>
                    <a href="{{route('category.show',$value->id)}}">
                    <div class="card-body product-image">
                        <img class="img" src="{{asset($value->image)}}"  style="border-radius: 10px">
                    </div>
                    </a>
                </div>
            </div>

        @endforeach
    </div>
</div>
@endsection
