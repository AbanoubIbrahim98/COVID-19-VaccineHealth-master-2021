@extends("layout.master")

@section('title')
<h1>
    Facilities Management
    <small>Add, Edit and Delete Facilities</small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">facilities</li>
</ol>
@stop

@section('contents')
    <div class="tab-pane fade in active" id="home">
        <div class="col-sm-12" id="listuser">
            @include('facility.list')
        </div>
    </div>

@stop