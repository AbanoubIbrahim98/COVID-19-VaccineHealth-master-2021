@extends("layout.master")

@section('title')
<h1>
    System Users
    <small>Add, Edit and Delete Users</small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
    <li>
        <a href="{{ url('home') }}">Dashboard</a>
    </li>
    <li class="active">users</li>
</ol>
@stop

@section('contents')
    <div class="col-sm-12" id="listuser">
        @include('user.list')
    </div>
@stop