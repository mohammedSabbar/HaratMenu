@if ($message = Session::get('success'))
    <script>
        $( document ).ready(function() {
            showSuccessToast("{{$message}}");
        });
    </script>
@endif

@if ($message = Session::get('danger'))
    <script>
        $( document ).ready(function() {
            showDangerToast("{{$message}}");
        });
    </script>
@endif


@if ($errors->any())
    @foreach ($errors->all() as $error)

        <div class="alert alert-fill-danger text-right" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            {{$error}}
        </div>

    @endforeach
@endif
<br>
