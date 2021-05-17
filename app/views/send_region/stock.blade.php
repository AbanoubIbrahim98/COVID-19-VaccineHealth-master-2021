@extends("layout.master")

@section('title')
<h1>
    Inventory
    <small>{{ Auth::user()->region->region }} Region Inventory Information </small>
</h1>
@stop
@section('contents')
<div class="col-sm-12">
    <div class="col-sm-4">
        <h4>Facility: <span class="lead">{{ Auth::user()->region->region }} Region Store</span></h4>

    </div>
    <div class="col-sm-4">
        <h4>Target Population <span class="lead">{{ Auth::user()->region->tagert_population }}</span></h4>
    </div>
    <div class="col-sm-4">
        <h4>Entered By <span class="lead"> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span></h4>
    </div>
</div>
<div class="col-sm-12">
    {{ Form::open(array("url"=>url(""),"class"=>"form-horizontal","id"=>'qrform')) }}
    <div class="col-sm-7">
        <div class="col-sm-4"><h4>Enter Lot Number</h4></div>
        <div class="col-sm-7">
            <input type="text" name="lot" class="form-control" placeholder="Lot Number" required>
        </div>
    </div>
    {{ Form::close() }}
    <div class="col-sm-5">
        <div class="col-sm-5"><h4>Reporting Period</h4></div>
        <div class="col-sm-7">
            <input type="text" name="period" class="dat form-control" value="{{ date('Y-m-d') }}">
        </div>
    </div>
</div>
<div class="col-sm-12" id="output">

</div>

<div class="col-sm-12" id="listuser" style="margin-top: 20px">

</div>

<script>
    $(document).ready(function (){

        $(".dat").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:"yy-mm-dd"
        });

        $("input[name=lot]").focus();
        $('#qrform').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h4><i class='fa fa-spin fa-spinner '></i><span>Retriving package information please wait...</span><h4>");
            $(this).ajaxSubmit({
                url : '<?php echo url('region_package/stock/checklot') ?>/'+$('input[name=lot]').val(),
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            $('#qrform').resetForm();
        }
    });
</script>
@stop