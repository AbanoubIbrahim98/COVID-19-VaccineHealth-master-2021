@extends("layout.master")

@section('title')
<h1>
    Vaccine/Diluent Management
    <small>Add, Edit and Delete Vaccines&Diluent</small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Vaccines</li>
</ol>
@stop

@section('contents')
    <div class="tab-pane fade in active" id="home">
        <div class="col-sm-12" id="listuser">
            @include('vaccine.list')
        </div>
    </div>

@stop