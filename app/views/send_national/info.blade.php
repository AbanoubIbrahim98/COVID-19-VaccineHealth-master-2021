<div class="col-sm-12">
    <div class="col-sm-2">
        <b>Target Population</b>
    </div>
    <div class="col-sm-2">
        <b>Expected births</b>
    </div>
    <div class="col-sm-2">
        <b>Expected pregnancies</b>
    </div>
    <div class="col-sm-2">
        <b>Surviving infants</b>
    </div>
    <div class="col-sm-4">
        <b>Enter Lot Number</b>
    </div>
</div>
<div class="col-sm-12">
    <div class="col-sm-2">
        {{ $region->tagert_population }}
    </div>
    <div class="col-sm-2">
        {{ $region->annual_birth }}
    </div>
    <div class="col-sm-2">
        {{ $region->pregnancy }}
    </div>
    <div class="col-sm-2">
        {{ $region->surviving_infants }}
    </div>
    <div class="col-sm-4">
        {{ Form::open(array("url"=>url("package/prepare/{$region->id}"),"class"=>"form-horizontal","id"=>'qrform')) }}
        <div class="form-group" id="lotarea">
            <div class="col-sm-8">
                <input style="color: #5bc0de; height: 25px" class="form-control" type="text" name="sscc" placeholder="Enter Lot Number" required="required" style="height: 34px">
                <input type="hidden" name="id" value="first" />
            </div>
            <div class="col-sm-4">
                <input type="submit" value="Scan" class="btn btn-xs btn-primary" />
            </div>

        </div>
        {{ Form::close() }}
    </div>
</div>



<script>
    $(document).ready(function(){
        $("input[name=sscc]").focus();
    $('#qrform').on('submit', function(e) {
        e.preventDefault();
        $("#warn").remove();
        $("#itemarea").show().html("<h3><i class='fa fa-spin fa-spinner '></i><span>Getting Item please wait...</span><h3>");
        $(this).ajaxSubmit({
            target: '#itemarea',
            success:  afterSuccess2
        });
    });
    function afterSuccess2(){
        $('#qrform').resetForm();
        //if(("#itemarea").find("h3").hasClass('text-danger')){
        //    $("input[name=sscc]").focus();
        //}
       }
    });
</script>