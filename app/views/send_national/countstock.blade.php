<div class="col-sm-12" id="add" style="margin-top: 20px">

    <div class="col-sm-2">
        <b>GTIN</b><br>
        {{ $package->GTIN }}
    </div>
    <div class="col-sm-1">
        <b>Item</b><br>
        {{ $package->vaccine->name }}
    </div>
    <div class="col-sm-2">
        <b>Lot Number</b><br>
        {{ $package->lot_number }}
    </div>
    <div class="col-sm-2">
        Expiry <br>
        {{ date('j M Y',strtotime($package->expiry_date)) }}
    </div>
    {{ Form::open(array("url"=>url("package/stock/count"),"class"=>"form-horizontal","id"=>'countform')) }}
    <div class="col-sm-1">
        <input type="hidden" name="lot" value="{{ $package->lot_number }}" />
        <input type="hidden" name="GTIN" value="{{ $package->GTIN }}" />
        <input type="hidden" name="period" value="{{ $period }}" />
        Boxes:
        <input title="" required="" name="box" pattern="\d*" type="text" class="form-control input-sm" placeholder="Number of  boxes">
    </div>
    <div class="col-sm-1">
        Vials:
        <input title="" required="" name="vials" pattern="\d*" type="text" class="form-control input-sm" placeholder="Number of vials">
    </div>
    <div class="col-sm-2 positive">
        Items are more than expected
        {{ Form::select('positive',array(""=>"Select Reason")+array('Transfer In'=>'Transfer In','Found Items'=>'Found Items'),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class="col-sm-2 negative">
        Items Are less than expected
        {{ Form::select('negative',array(""=>"Select Reason")+array('Theft'=>'Theft','Damage'=>'Damage',' Expiry'=>' Expiry','Transfer Out'=>'Transfer Out'),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class="col-sm-1">
        <br>
        <button type="button" class="btn btn-success btn-sm" id="checknumber">Submit</button>
        <input type="submit" value="Submit" class="btn btn-success btn-sm" id="submitform">
    </div>
    {{ Form::close() }}
</div>



<script>
    $(document).ready(function (){
    var positive = $(".positive").html();
    var negative = $(".negative").html();
        $(".positive,.negative").html("").hide();
        $("#submitform").hide();

        $("#checknumber").click(function(){
            $(this).html("<i class='fa fa-spin fa-spinner '></i> Checking...");
            var boxes = $("input[name=box]").val();
            var vials = $("input[name=vials]").val();
            $.post("<?php echo url("package/confirmcount/{$package->lot_number}") ?>",{box:boxes,vial:vials},function(data){
                if(data == "positive"){
                    $(".positive").html(positive).fadeIn();
                }
                if(data == "negative"){
                    $(".negative").html(negative).fadeIn();
                }
                if(data == "equals"){

                }
                $("#checknumber").fadeOut().html("Submit");
                $("#submitform").fadeIn();
            })
        })

//        $("input[name=lot]").focus();
        $('#countform').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h4><i class='fa fa-spin fa-spinner '></i><span>Submitting please wait...</span><h4>");
            $(this).ajaxSubmit({
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            $('#countform').resetForm();
            $("#output").fadeOut( "slow", function() {
                $("#output").html("").fadeIn();
            });
            $("#listuser").load("<?php echo url("package/inventory/list") ?>")
        }
    });
</script>