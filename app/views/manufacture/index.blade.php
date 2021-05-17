@extends("layout.master")

@section('title')
<h1>
    Manufacture Management
    <small>Add, Edit and Delete Manufacture</small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Manufacturer</li>
</ol>
@stop

@section('contents')
    <div class="col-md-7" id="listuser">
        @include('manufacture.list')
    </div>
    <div class="col-md-5" id="adduser">
        @include('manufacture.add')
    </div>
@stop