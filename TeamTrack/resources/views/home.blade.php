@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Loading ... </h3>
                </div>



            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    window.location.href = "/teams/"+ {{Auth::user()->getCurrentTeamId()}};
</script>

@endsection
