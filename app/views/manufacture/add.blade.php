
    <div class="panel panel-default">
      <div class="panel-body">
         {{ Form::open(array("url"=>url('manufacture/add'),"class"=>"form-horizontal","id"=>'FileUploader')) }}
         <h2 class="text-center text-muted">Add new Manufacture</h2>

             
              <div class='form-group'>
                    <div class='col-sm-6'>
                        Name <br> {{ Form::text('name','',array('class'=>'form-control','placeholder'=>'Name of Company','required'=>'required')) }}
                    </div>
                  <div class='col-sm-6'>
                      Country<br>{{ Form::select('country',Country::all()->lists('name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
                  </div>
            </div>
          <div class='form-group'>
              <div class='col-sm-12'>
                  Vaccines Produced by This Manufacturer<br>{{ Form::select('vaccines[]',Vaccine::all()->lists('vaccine_name','id'),'',array('class'=>'multiselect form-control','required'=>'requiered','multiple'=>"multiple")) }}
              </div>
          </div>
          <div class='form-group'>
              <div class='col-sm-12'>
                  Diluent Produced by This Manufacturer<br>{{ Form::select('diluent[]',Diluent::all()->lists('diluent_name','id'),'',array('class'=>'multiselect form-control','required'=>'requiered','multiple'=>"multiple")) }}
              </div>
          </div>
          <div id="output"></div>
       <div class='col-sm-12 form-group text-center'>
            {{ Form::submit('Add',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
            {{ Form::reset('Reset',array('class'=>'btn btn-warning','id'=>'submitqn')) }}
        </div>
      {{ Form::close() }}
    </div>
      </div>
    <script>
        $(document).ready(function (){

//            $.localise('ui-multiselect', {/*language: 'en',*/ path: 'js/locale/'});
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
//                    $("#output").html("");
                }, 3000);
                $("#listuser").load("<?php echo url("manufacture/list") ?>")
            }
        });
    </script>
