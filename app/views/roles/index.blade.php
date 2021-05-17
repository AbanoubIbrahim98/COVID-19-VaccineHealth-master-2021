@extends("layout.master")

@section('title')
<h1>
    User Roles Management
    <small>Add, Edit and Delete Roles</small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Roles</li>
</ol>
@stop

@section('contents')
<div class="row">
    <div class="col-md-7" id="listroles">
        @include('roles.list')
    </div>
    <div class="col-md-5" id="addroles">
        @include('roles.add')
    </div>
</div>

@stop