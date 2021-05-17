
<div class="panel panel-default">
    <div class="panel-body">
        {{ Form::open(array("url"=>url("roles/edit/{$role->id}"),"class"=>"form-horizontal","id"=>'FileUploader')) }}
        <h3 class="text-center text-muted">Update Roles</h3>
        <div class='form-group'>

            <div class='col-sm-10'>
                Role<br>  {{ Form::text('role',$role->role,array('class'=>'form-control','placeholder'=>'Role','required'=>'required')) }}
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
                $("#addroles").load("<?php echo url("roles/add") ?>")
            }, 3000);
            $("#listroles").load("<?php echo url("roles/list") ?>")
        }
    });
</script>


