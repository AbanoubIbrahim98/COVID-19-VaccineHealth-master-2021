
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title">System Access Log Information For {{$user->firstname }} {{$user->middlename }} {{$user->lastname }}</div>
        </div>
        <div class="bootstrap-admin-panel-content">
          <table class='table table-striped table-responsive' id='stafftale' >
              <thead>
                  <tr>
                      <th> # </th>
                      <th> Action </th>
                      <th> Date </th>
                      <th> Time </th>
                  </tr>
              </thead>
              <tbody>
                  <?php $i = 1;  ?>
                  
                  @foreach($user->logs as $us)
                  
                  <tr>
                      <td>{{ $i++ }}</td>
                       <td>{{ $us->action }}</td>
                       <td>{{ date("M, j Y",strtotime($us->created_at))}}</td>
                       <td>{{ date("H:i:s",strtotime($us->created_at)) }}</td>
                      
                  </tr>
                  @endforeach
              </tbody>
          </table>
    </div>
      </div>

<!--script to process the list of users-->
<script>
$(document).ready(function (){
    $("#stafftale").dataTable();
    $('input[type="text"]').addClass("form-control");
    $('select').addClass("form-control");
    
    
});
</script>
