@extends("layout.master")

@section('title')
<h1>
    Package Arrival
    <small>{{ Auth::user()->region->region }} Region vaccine arrival </small>
</h1>
@stop
@section('breadcumb')
<ol class="breadcrumb">
    <li>
        <a href="{{ url('home') }}">Dashboard</a>
    </li>
    <li class="active">vaccine arrival</li>
</ol>
@stop

@section('contents')
<div class="col-sm-12" id="infoarea"></div>
<div class="col-sm-12" style="margin-bottom: 20px" id="ssccarea">
<form method="post" action="{{ url('') }}" id="addsscc">
    <div class="form-group" >
        <div class="col-sm-6">
            Scan Shipment Number<br>
            <input type="text" name="sscc" placeholder="Scan Shipment Number" required class="form-control">
        </div>
        <div class="col-sm-6">
            <br><button type="submit" class="btn btn-info btn-min">Scan</button>
        </div>
    </div>
</form>
</div>
    <div id="output" style="margin-top: 20px">

    </div>

<script>
    $(document).ready(function (){
        $("#infoarea").hide();

        $(".dat").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd"
        });

        $("input[name=sscc]").focus();
        $('#addsscc').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h4><i class='fa fa-spin fa-spinner '></i><span>Retriving package information please wait...</span><h4>");
            $(this).ajaxSubmit({
                url : '<?php echo url('region_package/receive/sscc') ?>/'+$('input[name=sscc]').val(),
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            var ssc = $('#addsscc input[name=sscc]').val();
            $('#addsscc').resetForm();
            var discr = "<p class='lead'>Receiving Package With Shipment Number: "+ssc+"  <button class='btn btn-xs btn-warning tooltips' id='canc' title='cancel the whole process and rescan the sscc number'>Cancel</button> </p> ";
            $("#ssccarea").fadeOut("100")
            $("#infoarea").html(discr).fadeIn("slow");
            $('.tooltips').tooltipster();
            $("#canc").click(function(){
                $("#canc").html("<i class='fa fa-spin fa-spinner '></i> Canceling...")
                $("#infoarea").html("").fadeOut("500")
                $("#output").fadeOut("500").html("").fadeIn()
                $("#ssccarea").fadeIn("slow");
                $("input[name=sscc]").focus();
            })
        }
    });
</script>
@stop