@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
</div>
@endif

@if(session()->has('value-error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('value-error') }}
</div>
@endif
