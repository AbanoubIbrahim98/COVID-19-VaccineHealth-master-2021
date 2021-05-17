
<div class="panel panel-default">
    <div class="panel-body">
        {{ Form::open(array("url"=>url("manufacture/edit/{$manu->id}"),"class"=>"form-horizontal","id"=>'FileUploader')) }}
        <h3 class="text-center text-muted">Update Vaccine Information</h3>
        <div class='form-group'>
            <div class='col-sm-6'>
                Name <br> {{ Form::text('name',$manu->name,array('class'=>'form-control','placeholder'=>'Name of Company','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Country<br>{{ Form::select('country',Country::all()->lists('name','id'),$manu->country,array('class'=>'form-control','required'=>'requiered')) }}
            </div>
        </div>

        <div class='form-group'>
            <div class='col-sm-12'>
                Vaccines Produced<br>{{ Form::select('vaccines[]',Vaccine::all()->lists('vaccine_name','id'),$manu->vaccine->lists('vaccine_id'),array('class'=>'multiselect form-control','required'=>'requiered','multiple'=>"multiple")) }}
            </div>
        </div>
        <div class='form-group'>
            <div class='col-sm-12'>
                Diluent Produced<br>{{ Form::select('diluent[]',Diluent::all()->lists('diluent_name','id'),$manu->diluent->lists('diluent_id'),array('class'=>'multiselect form-control','required'=>'requiered','multiple'=>"multiple")) }}
            </div>
        </div>
        <div id="output"></div>
       <div class='col-sm-12 form-group text-center'>
            {{ Form::submit('Submit',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
           {{ Form::button('Cancel',array('class'=>'btn btn-danger','id'=>'cancel')) }}
        </div>
      {{ Form::close() }}
    </div>
      </div>
<script>
    $(document).ready(function (){
        $(".multiselect").multiselect();
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
                $("#adduser").load("<?php echo url("vaccine/add") ?>")
            }, 3000);
            $("#listuser").load("<?php echo url("vaccine/list") ?>")
        }
    });
</script>


