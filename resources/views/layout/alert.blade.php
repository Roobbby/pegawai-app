@if (session('alert') === 'success')
    <div id="successAlert" class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        {{ session('message') }}
    </div>
@elseif (session('alert') === 'error')
    <div id="errorAlert" class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        {{ session('message') }}
    </div>
@endif

{{-- @if($errors->has('name'))
    <div id="namealert" class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
        {{ $errors->first('name') }}
    </div>
@endif --}}

<script>
    setTimeout(function() {
        document.getElementById('successAlert').style.display = 'none';
    }, 4000);

    setTimeout(function() {
        document.getElementById('errorAlert').style.display = 'none';
    }, 4000);

    setTimeout(function(){
        var nameAlert = document.getElementById('namealert');
        nameAlert.style.opacity = '0';
        nameAlert.style.visibility = 'hidden';
    }, 4000);
</script>
