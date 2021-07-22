@if($val <= 1)
    <div class="badge badge-outline-info badge-fw">جيد</div>
@elseif($val == 2)
    <div class="badge badge-outline-warning badge-fw">متوسط</div>
@else
    <div class="badge badge-outline-danger badge-fw">دون المتوسط</div>
@endif

{{--@for($i=1;$i<=5;$i++)--}}
{{--    @if(floor($val)>= $i)--}}
{{--        <i class="mdi mdi-star" style="color: gold; font-size: 20px"></i>--}}
{{--    @else--}}
{{--        <i class="mdi mdi-star-outline" style=" font-size: 20px"></i>--}}
{{--        @endif--}}
{{--@endfor--}}

