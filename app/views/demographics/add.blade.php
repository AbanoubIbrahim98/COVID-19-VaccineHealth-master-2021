
         {{ Form::open(array("url"=>url("demographics/add/{$district->id}"),"class"=>"form-horizontal","id"=>'FileUploader')) }}
            <div class='form-group'>
                <div class='col-sm-3'>
                    Target Population<br> {{ Form::text('population',$district->target_population,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Target Population','value'=>'0')) }}
               </div>
              <div class='col-sm-2'>
                  Expected pregnancies<br>{{ Form::text('preg',$district->pregnancy,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Annual Birth','value'=>'0')) }}
              </div>
                <div class='col-sm-3'>
                    Expected births<br>{{ Form::text('birth',$district->annual_birth,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Annual Birth','value'=>'0')) }}
              </div>
              <div class='col-sm-3'>
                 Surviving Infants <br> {{ Form::text('infants',$district->surviving_infants,array("pattern"=>"\d*",'class'=>'form-control','placeholder'=>'Surviving Infants','value'=>'0')) }}
              </div>
              <div class='col-sm-1'>
                <br>{{ Form::submit('Add',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
              </div>
                <div class="col-sm-2" id="output"></div>
            </div>

      {{ Form::close() }}
    <script>
        $(document).ready(function (){
            $('#FileUploader').on('submit', function(e) {
                e.preventDefault();
                $("#output").html("<br><i class='fa fa-spin fa-spinner '></i><span>please wait...</span>");
                $(this).ajaxSubmit({
                    target: '#output',
                    success:  afterSuccess
                });

            });

            function afterSuccess(){
                setTimeout(function() {
                    $(".addarea").hide("slow");
                }, 1000);
            }
        });
    </script>
