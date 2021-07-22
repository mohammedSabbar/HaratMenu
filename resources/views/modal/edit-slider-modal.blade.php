<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تعديل ({{$value->name}})</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form class="forms-sample text-right" method="post" action="{{route('slider.update',$value->id)}}" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        @csrf
        <div class="modal-body">
            <div class="form-group row">
                <label for="class" class="col-sm-3 col-form-label">الحالة</label>
                <div class="col-sm-9">
                    <select class="form-control" name="status" id="class">
                        <option value="1" @if($value->status == true) selected @endif>فعال</option>
                        <option value="0" @if($value->status == false) selected @endif>غير مفعل</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">العنوان</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$value->name}}" name="name" class="form-control" id="name" placeholder="الاسم باللغة العربية">
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
