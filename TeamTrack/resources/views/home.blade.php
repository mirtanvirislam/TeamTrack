@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
        </div>
    </div>
</div>

<script type="text/javascript">
    if({{Auth::user()->getCurrentTeamId()}} != 0)
    {
        window.location.href = "/teams/"+ {{Auth::user()->getCurrentTeamId()}};
    }
    
</script>

@endsection
