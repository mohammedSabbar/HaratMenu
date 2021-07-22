<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اضافة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample text-right" method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="seq" class="col-sm-3 col-form-label">التسلسل</label>
                        <div class="col-sm-9">
                            <input type="number"  name="seq" class="form-control" id="seq">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">اسم القسم</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{old('name_ar')}}" name="name_ar" class="form-control" id="name_ar" placeholder="الاسم باللغة العربية">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name_en" class="col-sm-3 col-form-label">اسم الاكلة (الانكليزية)</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{old('name_en')}}" name="name_en" class="form-control" id="name_en" placeholder="اختياري">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price_discounted" class="col-sm-3 col-form-label">الصورة</label>
                        <div class="col-sm-9">
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
    </div>
</div>
<!-- Modal Ends -->
