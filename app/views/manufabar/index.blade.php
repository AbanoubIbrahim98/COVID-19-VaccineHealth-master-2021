@extends("layout.master")

@section('title')
<h1>
    International Shipment
    <small>Manage international shipment</small>
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
<ul id="myTab" class="nav nav-tabs" style="margin-left: 15px">
    <li class="active"><a href="#home" data-toggle="tab">On Transit</a></li>
    <li><a href="#profile" data-toggle="tab">Received</a></li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="home">
        <div class="col-sm-12" id="listuser">
            @include('manufabar.list')
        </div>
    </div>
    <div class="tab-pane fade" id="profile">
        <div class="col-sm-12" id="listuser">
            @include('manufabar.listreceived')
        </div>
    </div>
</div>


@stop