<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">عرض نتائج الاستبيان</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
        <div class="modal-body">

            <table class="table" style="text-align: center">
                <thead>
                <th>#</th>
                <th>الاستبيان</th>
                <th>جيد</th>
                <th>متوسط</th>
                <th>دون المتوسط</th>
                </thead>
                <tbody>

                @forelse($value as $review)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$review->question->title_ar}}</td>
                    @for($i=1;$i<=3;$i++)
                        <td>
                            <h4>
                                @if($review->rating == $i)
                                    <i class="mdi mdi-checkbox-marked-circle text-info mdi-24px"></i>
                                @else
                                    <i class="mdi mdi-checkbox-blank-circle-outline  mdi-24px"></i>
                                @endif
                            </h4>
                        </td>
                    @endfor
                </tr>
                @empty
                    <tr><td>لايوجد استبيان</td></tr>
                @endforelse
                <tr>
                    <td></td>
                    <td colspan="3">كم مرة تقوم بزيارة مطعمنا ؟</td>
                    <td><div class="badge badge-outline-primary badge-fw">{{$form->visit}}</div></td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">اغلاق</button>
        </div>
</div>

<!-- Modal Ends -->
