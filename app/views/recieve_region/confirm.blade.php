
<table class="table table-responsive table-bordered">
    <tr>
        <th>GTIN</th>
        <th>Description</th>
        <th>Manufacture</th>
        <th>Lot</th>
        <th>Expiry</th>
        <th>Vials</th>
        <th>Boxes</th>
        <th>Doses</th>
    </tr>
    <tr>
        <td>{{ $arrival->vaccine->GTIN }}</td>
        <td>{{ $arrival->vaccine->name }}</td>
        <td>
            {{ $arrival->vaccine->manufacturer }}
        </td>
        <td>{{ $arrival->lot_number }}</td>
        <td>{{ $arrival->manufacturer->expiry_date }}</td>
        <td>{{ round(($arrival->number_of_boxes*$arrival->vaccine->vials_per_box)) }}</td>
        <td>{{ round($arrival->number_of_boxes) }}</td>
        <td>{{ ($arrival->number_of_boxes*$arrival->vaccine->doses_per_vial)*$arrival->vaccine->vials_per_box }}</td>

    </tr>
</table>

{{ Form::open(array("url"=>url("region_package/receive/confirmqr/{$arrival->id}"),"class"=>"form-horizontal","id"=>'confirmpackage')) }}
<div class="col-sm-12">
    <div class='form-group'>
        <div class='col-sm-2'>
            <small> Quantity Okay </small>
            {{ Form::select('quantity',array(''=>'Select','Yes'=>'Yes','No'=>'No'),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class='col-sm-2'>
            <small> Physical Damage</small><br>
            {{ Form::select('damage',array(''=>'Select','Yes'=>'Yes','No'=>'No'),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
        <div class='col-sm-2'>
            <small> VVM Status</small><br>
            {{ Form::select('vvm',array(''=>'Select','I'=>'I (Okay)','II'=>'II (Okay)','III'=>'III (Bad)','IV'=>'IV (Bad)'),'',array('class'=>'form-control','required'=>'requiered')) }}
        </div>
<!--        <div class='col-sm-2'>-->
<!--            <small> Temperature monitors Status</small><br>-->
<!--            {{ Form::select('temp',array('Fine'=>'Fine','Not Fine'=>'Not Fine'),'',array('class'=>'form-control','required'=>'requiered')) }}-->
<!--        </div>-->
        <div class='col-sm-3'>
            <br>
            {{ Form::submit('Confirm',array('class'=>'btn btn-primary form-control','id'=>'submitqr','title'=>'Make sure you fill all necessary details before submitting, this item it will be made available in your stock')) }}
        </div>
        <div class='col-sm-3'>
            <br>
            {{ Form::button('Cancel',array('class'=>'btn btn-danger form-control','id'=>'cancel')) }}
        </div>
    </div>

    <div class='form-group'>
        <div class='col-sm-6' id="quantityarea">
            <small title='write the actual amount received without problems' class="textltips">
                Received Amount(vials)
                <button type="button" class='btn btn-xs btn-success toltips' title='write the actual number of vials received without problems'><i class="fa fa-question-circle"></i> </button>
            </small>
            {{ Form::text('quantity1','',array('class'=>'form-control','placeholder'=>'Actual Amount Received','required'=>'required')) }}
        </div>

    </div>

<div class="col-sm-12">
    <div class='form-group'>
        <div class='col-sm-8'>
            Comments and Observations<br>
            <textarea rows="3" placeholder="" name="comments" class="form-control"></textarea>
        </div>
        <div id="output1" style="padding-top: 10px;text-align: center" class="col-sm-4">

        </div>
    </div>
</div>
</div>
    {{ Form::close() }}

<script>
    $(document).ready(function (){
        $('.tootip').tooltipster();
        //taking contents
        var quantityarea = $("#quantityarea").html();

        //hiding items by default
        $("#quantityarea").html("");

        //dealing with incorrect amounts
        $("select[name=quantity]").change(function(){
            if($("select[name=damage]").val() == 'Yes' || $("select[name=vvm]").val() == 'III' || $("select[name=vvm]").val() == 'IV' || $("select[name=quantity]").val() == 'No'){
                $("#quantityarea").html(quantityarea);
                $('.toltips').tooltipster();
            }else{
                $("#quantityarea").html("");
            }

        })

        //dealing with incorrect temperature
        $("select[name=temp]").change(function(){

        })

        //dealing with incorrect vvm
        $("select[name=vvm]").change(function(){
            if($("select[name=damage]").val() == 'Yes' || $("select[name=vvm]").val() == 'III' || $("select[name=vvm]").val() == 'IV' || $("select[name=quantity]").val() == 'No'){
                $("#quantityarea").html(quantityarea);
                $('.toltips').tooltipster();
            }else{
                $("#quantityarea").html("");
            }
        })

        //dealing with damaged items
        $("select[name=damage]").change(function(){
            if($("select[name=damage]").val() == 'Yes' || $("select[name=vvm]").val() == 'III' || $("select[name=vvm]").val() == 'IV' || $("select[name=quantity]").val() == 'No'){
                $("#quantityarea").html(quantityarea);
                $('.toltips').tooltipster();
            }else{
                $("#quantityarea").html("");
            }
        })

        if($('#alllist tr:visible').length == 2){
            $('#alllist').hide("slow");
        }

        $("#alllist").find("td:contains('<?php echo $arrival->lot_number ?>')").parent().hide("5000");
        $('#confirmpackage').on('submit', function(e) {
            e.preventDefault();
            $("#output1").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Confirming please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output1',
                success:  afterSuccess1
            });

        });

        $("#cancel").click(function(){
            $('#alllist').show("slow");
            $("#alllist").find("td:contains('<?php echo $arrival->lot_number ?>')").parent().show("5000");
            $(this).parent().parent().parent().parent().parent().fadeOut( "slow", function() {
                $("#submitqr").parent().parent().parent().parent().parent().html("").fadeIn();
            });
            $("input[name=lot]").focus();
        })

        function afterSuccess1(){
            setTimeout(function() {
                $("#submitqr").parent().parent().parent().parent().parent().fadeOut( "slow", function() {
                    $("#submitqr").parent().parent().parent().parent().parent().html("").fadeIn();
                });
                $("input[name=lot]").focus();
                if($('#alllist tr:visible').length == 0){
                    $("#infoarea").html("").fadeOut("500")
                    $("#output").fadeOut("500").html("").fadeIn()
                    $("#ssccarea").fadeIn("slow");
                    $("input[name=sscc]").focus();
                }

            }, 2000);
        }
    });
</script>