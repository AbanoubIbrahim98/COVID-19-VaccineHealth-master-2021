
    <div class="panel panel-default">
      <div class="panel-body">
         {{ Form::open(array("url"=>url('manubarcode/add'),"class"=>"form-horizontal","id"=>'FileUploader')) }}
         <div class='form-group'>
              <div class='col-sm-6'>
                  SSCC <br>  {{ Form::text('barcode','',array('class'=>'form-control','placeholder'=>'Serial Shipping Container Code','title'=>'Serial Shipping Container Code','required'=>'required')) }}
              </div>
              <div class='col-sm-6'>
                  <span id="vacc"> Item<br>{{ Form::select('vaccine',Vaccine::all()->lists('name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}</span>
              </div>
          </div>
          <div class='form-group'>
              <div class='col-sm-6'>
                  Manufacture Date <br>  {{ Form::text('manu','',array('class'=>'dat form-control','placeholder'=>'Manufacture Date','required'=>'required')) }}
              </div>
              <div class='col-sm-6'>
                  Expiry Date <br>  {{ Form::text('exp','',array('class'=>'dat form-control','placeholder'=>'Expiry Date','required'=>'required')) }}
              </div>
             <script>
                 $(".dat").datepicker({
                     dateFormat:"yy-mm-dd"
                 });
             </script>
          </div>
          <div class='form-group'>
              <div class='col-sm-6'>
                  Lot Number <br>  {{ Form::text('lot','',array('class'=>'form-control','placeholder'=>'Lot Number','required'=>'required')) }}
              </div>
              <div class='col-sm-6'>
                  Quantity(Number of Doses) <br>  {{ Form::text('quantity','',array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Number of Doses','required'=>'required')) }}
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
                $("#listuser").load("<?php echo url("manubarcode/list") ?>")
            }
        });
    </script>
