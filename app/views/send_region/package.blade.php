<?php
    $boxes = ($package->number_of_doses / $package->vaccine->doses_per_vial  )/$package->vaccine->vials_per_box;

    $stock = $district->stock()->where('vaccine_id',$package->vaccine_id)->get();
    $level=0;
    if($stock){
        foreach($stock as $stoc){
            $level += $stoc->number_of_doses;
        }
    }
    $min = round(($district->surviving_infants *$package->vaccine->wastage *$package->vaccine->schedule*0.5)/12);
    $max = round(($district->surviving_infants *$package->vaccine->wastage *$package->vaccine->schedule*1.5)/12);
//    $level = $level /($package->vaccine->vials_per_box*$package->vaccine->doses_per_vial)
    ?>
    <div class="col-sm-12" id="add" style="margin-top: 20px">

        <div class="col-sm-2">
            <b>GTIN</b><br>
            {{ $package->vaccine_id }}
        </div>
        <div class="col-sm-1">
            <b>Item</b><br>
            {{ $package->vaccine->name }}
        </div>
        <div class="col-sm-1">
            <b>Lot</b><br>
            {{ $package->lot_number }}
        </div>
        <div class="col-sm-2">
            <b>Max :</b>{{ $max }} doses<br>
            <b>Min :</b>{{ $min }} doses<br>
        </div>
        <div class="col-sm-2">
            <b>Current Stock</b><br>
            {{ $level }}
        </div>
        <!--    displaying warning for products near expiry-->
        @if($expiry_status == "expired")
        <div class="col-sm-2" style="background-color: #aa1111">
            Expired <i class="fa fa-times"></i> <br>
            {{ date('j M Y',strtotime($package->expiry_date)) }}
        </div>
        @elseif($expiry_status == "near expiry")
        <div class="col-sm-2" style="background-color: #aa5500">
            Near Expiry <i class="fa fa-warning"></i><br>
            {{ date('j M Y',strtotime($package->expiry_date)) }}
        </div>
        @else
        <div class="col-sm-2" style="background-color: lightgreen">
            Expiry Date <i class="fa fa-check"></i><br>
            {{ date('j M Y',strtotime($package->expiry_date)) }}
        </div>
        @endif
        @if($expiry_status != "expired")
        {{ Form::open(array("url"=>url("region_package/addpack"),"class"=>"form-horizontal","id"=>'FileUploader6')) }}
        <div class="col-sm-1">
            <input type="hidden" name="lot" value="{{ $package->lot_number }}" />
            <input type="hidden" name="idd" value="" />
            Doses:
            <br><input title=" doses up to {{ $package->number_of_doses }} " required="" name="box" pattern="\d*" type="text" class="form-control input-sm" placeholder="Max of {{ $package->number_of_doses }} doses">
        </div>
        <div class="col-sm-1">
            <br>
            <input type="submit" value="Add" class="btn btn-success btn-sm">

        </div>
        {{ Form::close() }}
        @else
        <div class="col-sm-2">
            <h4 class="text-danger"><i class="fa fa-warning"></i> This item has expired</h4>
        </div>
        <h4></h4>
        <script>
            $(document).ready(function(){
                $("input[name=sscc]").focus().attr("placeholder","Enter Lot Number Again");
            })
        </script>
        @endif
    </div>
<div id="output3"></div>

<script>
    $(document).ready(function(){
        if('<?php echo $idd ?>' == ''){
            $("#FileUploader6 input[name=idd]").val($("#qrform input[name=id]").val())
        }else{
            $("#qrform input[name=id]").val(<?php echo $idd ?>)
            $("#FileUploader6 input[name=idd]").val(<?php echo $idd ?>)
        }

        //showing expired and near expired warings
        if('<?php echo $other_available  ?>' != ""){
            $("#itemarea").hide();
            $("#warn").remove();
            var warning = "<h4 id='warn'><i class='fa fa-warning fa-2x text-warning'></i> ";
            warning    +="Item with Lot number <?php echo $other_available  ?> in stock expires sooner. Do you wish to proceed ";
            warning    +="<a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a>";
            warning    +="<a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a></h4>";
            $("#itemarea").after(warning)
            $("#no").click(function(){
                $("#warn").hide('slow');
                $("input[name=sscc]").focus().attr("placeholde","Scan QR Code Again");
            });
            $("#yes").click(function(){
                $("#warn").remove(); $("#itemarea").show('slow');

            });
        }else{
            if('<?php echo $expiry_status  ?>' == "near expiry"){
                $("#itemarea").hide();
                $("#warn").remove();
                var warning = "<h4 id='warn'><i class='fa fa-warning fa-2x text-warning'></i> ";
                warning    +="This Item is near Expiry Date Do you wish to proceed ";
                warning    +="<a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a>";
                warning    +="<a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a></h4>";
                $("#itemarea").after(warning)
                $("#no").click(function(){
                    $("#warn").hide('slow');
                    $("input[name=sscc]").focus().attr("placeholder","Enter Lot Number Again");
                });
                $("#yes").click(function(){
                    $("#warn").remove(); $("#itemarea").show('slow');

                });

            }
        }

        $("input[name=box]").focus();
    $('#FileUploader6').on('submit', function(e) {
        e.preventDefault();
        $("#output3").html("<h3><i class='fa fa-spin fa-spinner '></i><span>please wait...</span><h3>");
        $(this).ajaxSubmit({
            target: '#output3',
            success:  afterSuccess
        });
    });
    function afterSuccess(){
        $('#FileUploader').resetForm();
        setTimeout(function() {
            $("#itemarea").fadeOut( "slow", function() {
                $("#itemarea").html("").fadeIn();
            });
            $("#output3").fadeOut( "slow", function() {
                $("#itemarea").html("").fadeIn();
            });
        }, 1500);
        $("#listuser").load("<?php echo url("region_package/send/list") ?>/"+$("#qrform input[name=id]").val())
    }
    });
</script>