<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تعديل</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form class="forms-sample text-right" method="post" action="{{route('question.update',$value->id)}}">
        {{ method_field('PUT') }}
        @csrf
        <div class="modal-body">

            <div class="form-group row">
                <label for="class" class="col-sm-3 col-form-label">الحالة</label>
                <div class="col-sm-9">
                    <select class="form-control" name="status" id="class">
                        <option value="1" @if($value->status == true) selected @endif>فعال</option>
                        <option value="0" @if($value->status == false) selected @endif>غير فعال</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">السؤال</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$value->title_ar}}" name="title_ar" class="form-control" id="title_ar" placeholder="الاسم باللغة العربية">
                </div>
            </div>

            <div class="form-group row">
                <label for="name_en" class="col-sm-3 col-form-label">السؤال (الانكليزية)</label>
                <div class="col-sm-9">
                    <input type="text" value="{{$value->title_en}}" name="title_en" class="form-control" id="title_en" placeholder="اختياري">
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
