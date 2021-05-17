@extends("layout.master")

@section('title')
<h1>
    Send Package
    <small>Prepare and send package to regions </small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
    <li>
        <a href="{{ url('home') }}">Dashboard</a>
    </li>
    <li class="active">Prepare Package</li>
</ol>
@stop

@section('contents')
{{ $regions }}
<script>
    $(document).ready(function (){

        $("select[name=region]").click(function(){
            if($(this).val() != ''){
                $("#output").html("<h4><i class='fa fa-spin fa-spinner '></i><span>Getting area information please wait...</span><h4>");
                $("#output").load('<?php echo url('package/prepare/areainfo') ?>/'+$(this).val(),function(){
                    $("#itemarea").fadeOut( "slow", function() {
                        $("#itemarea").html("").fadeIn();
                    });
                    $("#listuser").fadeOut( "slow", function() {
                        $("#listuser").html("").fadeIn();
                    });
                });
            }else{
                $("#output").fadeOut( "slow", function() {
                    $("#output").html("").fadeIn();
                });
            }

        })

    });
</script>

@stop