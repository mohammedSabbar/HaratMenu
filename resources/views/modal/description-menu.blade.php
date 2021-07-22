<div class="card" style="text-align: right">
    <img class="card-img-top" src="/{{$food->image}}" alt="">
    <div class="card-body">
        <h5 class="card-title">{{$food->name_ar}}</h5>
        <p class="card-text">{{$food->description_ar}}</p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">{{number_format($food->price)}}</li>
    </ul>
</div>


<!-- Modal Ends -->
