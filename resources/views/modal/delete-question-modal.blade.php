<div class="modal fade" id="delete_modal_{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample text-right" method="post" action="{{route('question.destroy',$value->id)}}" enctype="multipart/form-data">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body" style="text-align: center">

                    <h3>!!!!! هل انت متأكد من حذف !!!!!</h3>
                    <h4>** الاستبيانات السابقة لاتتأثر بالحذف **</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">الغاء</button>
                    <input type="submit" class="btn btn-danger" value="حذف" />
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Ends -->
