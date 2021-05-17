@extends("layout.master")

@section('title')
<h1>
    Area Demographics
    <small>Manage area demographics</small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Area demographics</li>
</ol>
@stop

@section('contents')
<?php
$region = array();
$district = array();
if(Auth::user()->role_id == "National" || Auth::user()->role_id == "National IVD" || Auth::user()->role_id == "admin"){
    $region = Region::all()->lists('region','id');
    $district = Region::first()->district->lists('district','id');
}elseif(Auth::user()->role_id == "Region" ){
    $region = array(Auth::user()->region->id => Auth::user()->region->region);
    $district = Auth::user()->region->district->lists('district','id');
}elseif(Auth::user()->role_id == "District" ){
    $region = array(Auth::user()->district->region->id => Auth::user()->district->region->region);
    $district = array(Auth::user()->district->id => Auth::user()->district->district);
}
?>
    <div class="tab-pane fade in active" id="home">
        <div class="col-sm-12" style="padding-bottom: 15px">
<span class="help-block">Area demographics are filled at districts level</span>
            <div class='form-group'>
                <div class='col-sm-4' id="regarea">
                    Region<br>{{ Form::select('region',$region,'',array('class'=>'form-control','required'=>'requiered')) }}
                </div>
                <div class='col-sm-4' id="disarea">
                    District<br><span id="district-area">{{ Form::select('district',$district,'',array('class'=>'form-control','required'=>'requiered')) }}</span>
                </div>
                <div class='col-sm-4' id="">
                    <br><button type="button" class="btn btn-info btn-min" id="checkdis">Add</button>
                </div>
            </div>
        </div>
        <div class="addarea col-sm-12">

        </div>

        <div class="col-sm-12" id="listuser">
            @include('demographics.list')
        </div>
    </div>
<script>
    $(document).ready(function(){
        $("select[name=region]").change(function(){
            $(".addarea").hide("slow");
            $("#district-area").html("<i class='fa fa-spinner fa-spin'></i> Wait... ")
            $.post("<?php echo url('user/region_check') ?>/"+$(this).val(),function(dat){
                $("#district-area").html(dat);
                $("select[name=district]").change(function(){
                    $(".addarea").hide("slow");
                })
                $("button[id=checkdis]").click(function(){
                    $(".addarea").show().html("<i class='fa fa-spinner fa-spin'></i> Wait... ")
                    $(".addarea").load("demographics/add/"+$("select[name=district]").val(),function(){

                    })
                })
                })
            })

        $("button[id=checkdis]").click(function(){
            $(".addarea").show().html("<i class='fa fa-spinner fa-spin'></i> Wait... ")
            $(".addarea").load("demographics/add/"+$("select[name=district]").val(),function(){

            })
        })
    })
</script>
@stop