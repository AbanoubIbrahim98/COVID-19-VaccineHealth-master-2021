
<div class="panel panel-default">
    <div class="panel-body">
        {{ Form::open(array("url"=>url("diluent/edit/{$diluent->id}"),"class"=>"form-horizontal","id"=>'FileUploader2')) }}
        <h3 class="text-center text-muted">Update Diluent Information</h3>
        <div class='form-group'>

            <div class='col-sm-10'>
                Name <br>  {{ Form::text('name',$diluent->diluent_name,array('class'=>'form-control','placeholder'=>'Diluent name','required'=>'required')) }}
            </div>
        </div>

        <div class='form-group'>
            <div class='col-sm-10'>
                Vaccine<br>{{ Form::select('vaccine',Vaccine::all()->lists('vaccine_name','id'),$diluent->vaccine_id,array('class'=>'form-control','required'=>'requiered')) }}
            </div>
        </div>
        <div class='form-group'>

            <div class='col-sm-10'>
                Units Per Box <br>  {{ Form::text('units',$diluent->units_per_box,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Units Per Box','required'=>'required')) }}
            </div>
        </div>

        <div id="output4"></div>
       <div class='col-sm-12 form-group text-center'>
            {{ Form::submit('Submit',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
           {{ Form::button('Cancel',array('class'=>'btn btn-danger','id'=>'cancel')) }}
        </div>
      {{ Form::close() }}
    </div>
      </div>
<script>
    $(document).ready(function (){
        $('#FileUploader2').on('submit', function(e) {
            e.preventDefault();
            $("#output4").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output4',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            $('#FileUploader').resetForm();
            setTimeout(function() {
                $("#output4").html("");
                $("#addduser").load("<?php echo url("diluent/add") ?>")
            }, 3000);
            $("#listduser").load("<?php echo url("diluent/list") ?>")
        }
    });
</script>


