@if (session()->has('success'))
<div class="col-8" id="alert-success">
    <div class="alert alert-success alert-dismissible" role="alert">
        <div class="alert-body">
            {{-- <p>test pop up</p> --}}
            {{session()->get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert">
            </button>
        </div>
    </div>
</div>

<script>
    window.setTimeout("hideAlert();", 1000);
    function hideAlert() {
        $("#alert-success").fadeTo(2500, 500).hide(500, function(){
            $("#alert-success").hide(500);
        });
    }
</script>
@endif
@if (session()->has('error'))
<div class="col-8" id="alert-error">
    <div class="alert alert-danger alert-dismissible" role="alert">
        <div class="alert-body">
            {{session()->get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert">
            </button>
        </div>
    </div>
</div>
<script>
    window.setTimeout("hideAlert();", 1000);
    function hideAlert() {
        $("#alert-error").fadeTo(2500, 500).hide(500, function(){
            $("#alert-error").hide(500);
        });
    }
</script>
@endif