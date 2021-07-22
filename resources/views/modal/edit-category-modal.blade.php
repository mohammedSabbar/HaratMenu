<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تعديل ({{$value->name_ar}})</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form class="forms-sample text-right" method="post" action="{{route('category.update',$value->id)}}" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @csrf
        <div class="modal-body">

            <div class="form-group row">
                <label for="seq" class="col-sm-3 col-form-label">التسلسل</label>
                <div class="col-sm-9">
                    <input type="number" value="{{$value->seq}}" name="seq" class="form-control" id="seq">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">اسم القسم</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$value->name_ar}}" name="name_ar" class="form-control" id="name_ar" placeholder="الاسم باللغة العربية">
                </div>
            </div>

            <div class="form-group row">
                <label for="name_en" class="col-sm-3 col-form-label">اسم القسم (الانكليزية)</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$value->name_en}}" name="name_en" class="form-control" id="name_en" placeholder="اختياري">
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

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">الغاء</button>
            <input type="submit" class="btn btn-warning" value="حفظ" />
        </div>
    </form>
</div>

<!-- Modal Ends -->
