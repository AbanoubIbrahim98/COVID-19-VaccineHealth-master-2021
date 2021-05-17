<div class="row" style="padding-left: 10px">
    <div class="col-md-11" id="listroles" style="padding-left: 10px">
        <div class="row">
            <div class='form-group'>
                <div class='col-sm-3'>
                    Place of inspection <br>  {{ Form::text('manu','',array('class'=>'form-control','placeholder'=>'Place of inspection','required'=>'required')) }}
                </div>
                <div class='col-sm-3'>
                    Date of inspection<br>  {{ Form::text('exp','',array('class'=>'dat form-control','placeholder'=>'Date of inspection','required'=>'required')) }}
                </div>
                <div class='col-sm-3'>
                    Name of cold store <br>  {{ Form::text('manu','',array('class'=>'form-control','placeholder'=>'Name of cold store','required'=>'required')) }}
                </div>
                <div class='col-sm-3'>
                    Date entered <br>  {{ Form::text('exp','',array('class'=>'dat form-control','placeholder'=>'Date entered','required'=>'required')) }}
                </div>
            </div>
        </div>
        <div class="row">
            <h4>DOCUMENTS ACCOMPANYING THE SHIPMENT</h4>
            <small>Verify that all necessary documents are present and complete the form accordingly</small>
            <div class='form-group'>
                <div class='col-sm-2'>
                    Date Received <br>  {{ Form::text('manu','',array('class'=>'dat form-control','placeholder'=>'Date Received','required'=>'required')) }}
                </div>
                <div class='col-sm-3'>
                    <label> Packing list <br>  <input type="checkbox"> </label>
                </div>
                <div class='col-sm-2'>
                    <label> Release certificate<br>  <input type="checkbox"> </label>
                </div>
                <div class='col-sm-2'>
                    <label> Vaccine Arrival Report <br>  <input type="checkbox"> </label>
                </div>
                <div class='col-sm-3'>
                    <label> Other <br>  <input type="text"> </label>
                </div>
            </div>
        </div>
        <div class="row">
            <h4>FLIGHT ARRIVAL DETAILS</h4>
            <div class='form-group'>
                <div class='col-sm-2'>
                    AWB Number <br>  {{ Form::text('manu','',array('class'=>'form-control','placeholder'=>'Place of inspection','required'=>'required')) }}
                </div>
                <div class='col-sm-2'>
                    Airport of destination<br>  {{ Form::text('exp','',array('class'=>'form-control','placeholder'=>'Date of inspection','required'=>'required')) }}
                </div>
                <div class='col-sm-2'>
                    Flight No <br>  {{ Form::text('manu','',array('class'=>'form-control','placeholder'=>'Name of cold store','required'=>'required')) }}
                </div>
                <div class='col-sm-3'>
                    ETA as per notification <br>
                    {{ Form::text('exp','',array('class'=>'dat form-control','placeholder'=>'Date','required'=>'required')) }}
                    {{ Form::text('exp','',array('class'=>'timepicker form-control','placeholder'=>'Time','required'=>'required')) }}
                </div><div class='col-sm-3'>
                    Actual time of arrival <br>
                    {{ Form::text('exp','',array('class'=>'dat form-control','placeholder'=>'Date ','required'=>'required')) }}
                    {{ Form::text('exp','',array('class'=>'timepicker form-control','placeholder'=>'Time','required'=>'required')) }}
                </div>
            </div>
        </div>
        <div class="row">
            <h4>ADVANCE NOTICE</h4>
            <small>Enter dates and details of documents received in advance of the vaccine shipment.</small>
            <div class='form-group'>
                <div class='col-sm-2'>
                    Date Received <br>  {{ Form::text('manu','',array('class'=>'dat form-control','placeholder'=>'Date Received','required'=>'required')) }}
                </div>
                <div class='col-sm-3'>
                    <label> Copy airway bill (AWB) <br>  <input type="checkbox"> </label>
                </div>
                <div class='col-sm-2'>
                    <label> Copy of packing list<br>  <input type="checkbox"> </label>
                </div>
                <div class='col-sm-2'>
                    <label> Copy of invoice <br>  <input type="checkbox"> </label>
                </div>
                <div class='col-sm-3'>
                    <label> Copy of release certificate <br>  <input type="checkbox"> </label>
                </div>
            </div>
        </div>
        <div class='col-sm-12 form-group text-center'>
            {{ Form::submit('Add',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
            {{ Form::reset('Reset',array('class'=>'btn btn-warning','id'=>'submitqn')) }}
        </div>

    </div>
    <script>
        $(document).ready(function (){

            $(".dat").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:"yy-mm-dd"
            });

            $(".timepicker").timepicker({
                showInputs: false
            });
            $('#FileUploader').on('submit', function(e) {
                e.preventDefault();
                $("#output").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
                $(this).ajaxSubmit({
                    target: '#output',
                    success:  afterSuccess
                });

            });



            function afterSuccess(){
                $('#FileUploader').resetForm();
                setTimeout(function() {
                    $("#output").html("");
                }, 3000);
                $("#listuser").load("<?php echo url("manufarbar/list") ?>")
            }
        });
    </script>