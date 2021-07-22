<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset('theme/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('theme/vendors/js/vendor.bundle.addons.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{asset('theme/js/off-canvas.js')}}"></script>
<script src="{{asset('theme/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('theme/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('theme/js/settings.js')}}"></script>
<script src="{{asset('theme/js/todolist.js')}}"></script>
<script src="{{asset('theme/js/toastDemo.js')}}"></script>
<script src="{{asset('theme/js/formpickers.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<!-- End custom js for this page-->
<script>
    $(document).ready(function(){

        $(document).ajaxStart(function(){
            // Show image container
            $("#loader").show();
        });
        $(document).ajaxComplete(function(){
            // Hide image container
            $("#loader").hide();
        });

    });
</script>
