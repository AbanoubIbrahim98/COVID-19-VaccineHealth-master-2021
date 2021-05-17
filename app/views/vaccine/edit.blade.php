
<div class="panel panel-primary">
    <div class="panel-body">
        {{ Form::open(array("url"=>url("vaccine/edit/{$vaccine->id}"),"class"=>"form-horizontal","id"=>'FileUploader')) }}

        <div class='form-group'>
            <div class='col-sm-6'>
                GTIN Number <br>  {{ Form::text('gtn',$vaccine->GTIN,array('class'=>'form-control','placeholder'=>'GTN Number','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Type<br>{{ Form::select('type',array('vaccine'=>'vaccine','diluent'=>'diluent'),$vaccine->type,array('class'=>'form-control','required'=>'requiered')) }}
            </div>
        </div>
        <div class='form-group'>
            <div class='col-sm-6'>
                Short Description<br> {{ Form::text('name',$vaccine->name,array('class'=>'form-control','placeholder'=>'Short Description','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Manufacturer<br> {{ Form::text('manufacturer',$vaccine->manufacturer,array('class'=>'form-control','placeholder'=>'Manufacturer','required'=>'required')) }}
            </div>
        </div>
        <div class='form-group'>
            <div class='col-sm-6'>
                Country<br>{{ Form::select('country',Country::all()->lists('name','id'),$vaccine->country_id,array('class'=>'form-control','required'=>'requiered')) }}
            </div>
            <div class='col-sm-6'>
                Packaging <br> {{ Form::text('pack',$vaccine->packaging,array('class'=>'form-control','placeholder'=>'Packaging','required'=>'required')) }}
            </div>
        </div>
        <div class='form-group'>
            <div class='col-sm-6'>
                Vials Per Box <br> {{ Form::text('package',$vaccine->vials_per_box,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Packaging','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Doses Per Vial<br> {{ Form::text('dose',$vaccine->doses_per_vial,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Doses per Unit','required'=>'required')) }}
            </div>
        </div>
        <div class='form-group'>
            <div class='col-sm-6'>
                Wastage Rate <br> {{ Form::text('wastage',$vaccine->wastage,array('class'=>'form-control','placeholder'=>'Wastage Rate','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Schedule<br> {{ Form::text('schedule',$vaccine->schedule,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Schedule','required'=>'required')) }}
            </div>
        </div>

        <div class='form-group'>
            <div class='col-sm-12 '>
                Warning Period<br>
                <span class="help-block">Number of month before expiry to display warning</span>
                {{ Form::text('warning',$vaccine->warning_period,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Warning Period (Month)','required'=>'required')) }}
            </div>
        </div>

        <div id="output"></div>
        <div class='col-sm-12 form-group text-center'>
            {{ Form::submit('Update',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
            {{ Form::reset('Reset',array('class'=>'btn btn-warning','id'=>'submitqn')) }}
        </div>
      {{ Form::close() }}
    </div>
      </div>
<script>
    $(document).ready(function (){
        $('#FileUploader').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            setTimeout(function() {
                $("#myModal").modal("hide");
            }, 1000);
            $("#listuser").load("<?php echo url("vaccine/list") ?>")
        }
    });
</script>


