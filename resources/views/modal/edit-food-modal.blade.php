<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تعديل ({{$value->name_ar}})</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="float: left">&times;</span>
        </button>
    </div>
    <form class="forms-sample text-right" method="post" action="{{route('food.update',$value->id)}}" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="class" class="col-sm-3 col-form-label">الحالة</label>
                <div class="col-sm-9">
                    <select class="form-control" name="status" id="class">
                        <option value="1" @if($value->status == true) selected @endif>متوفر</option>
                        <option value="0" @if($value->status == false) selected @endif>غير متوفر</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="class" class="col-sm-3 col-form-label">القسم</label>
                <div class="col-sm-9">
                    <select class="form-control" name="category" id="class">
                        @foreach($categories as $category)
                            @if($value->category_id == $category->id)
                                <option value="{{$category->id}}" selected>{{$category->name_ar}}</option>
                            @else
                                <option value="{{$category->id}}">{{$category->name_ar}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">اسم الاكلة</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$value->name_ar}}" name="name_ar" class="form-control" id="name_ar" placeholder="الاسم باللغة العربية">
                </div>
            </div>



            <div class="form-group row">
                <label for="description_ar" class="col-sm-3 col-form-label">الوصف</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$value->description_ar}}" name="description_ar" class="form-control" id="description_ar" placeholder="الوصف باللغة العربية">
                </div>
            </div>



            <div class="form-group row">
                <label for="price" class="col-sm-3 col-form-label">السعر</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$value->price}}" name="price" class="form-control" id="price">
                </div>
            </div>

            <div class="form-group row">
                <label for="price_discounted" class="col-sm-3 col-form-label">السعر بعد التخفيض</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$value->price_discounted}}" name="price_discounted" class="form-control" id="price_discounted" placeholder="اختياري">
                </div>
            </div>

            <div class="form-group row">
                <label for="price_discounted" class="col-sm-3 col-form-label">الصورة</label>
                <div class="col-sm-2">
                    <img src="/{{$value->image}}" width="70px" height="70px">
                </div>
                <div class="col-sm-7">
                    <input type="file" name="image" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label for="name_en" class="col-sm-3 col-form-label">اسم الاكلة (الانكليزية)</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$value->name_en}}" name="name_en" class="form-control" id="name_en" placeholder="اختياري">
                </div>
            </div>

            <div class="form-group row">
                <label for="description_en" class="col-sm-3 col-form-label">الوصف (الانكليزية)</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$value->description_en}}" name="description_en" class="form-control" id="description_en" placeholder="اختياري">
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">الغاء</button>
            <input type="submit" class="btn btn-warning" value="حفظ" />
        </div>
    </form>
</div>
<!-- Modal Ends -->
