
<div class="row">
<div class="panel panel-default">
<div class="panel-heading">
    <div class="text-muted bootstrap-admin-box-title">
        Area Demographic Information
        <button class="btn btn-primary btn-xs pull-right add" id="add"><i class="fa fa-plus"></i> add</button>
    </div>
</div>
<div class="bootstrap-admin-panel-content">
   @if(Region::all()->count() == 0)
    <h3>There are no Demographic Information</h3>
    @else
    <table class="table table-striped table-bordered" id="example2">
    <thead>
    <tr>
        <th> # </th>
        <th> Region </th>
        <th> Districts </th>
        <th> Target Population </th>
        <th> Expected pregnancies  </th>
        <th> Expected births </th>
        <th> Surviving Infants </th>

    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(District::all() as $us)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $us->region->region }}</td>
        <td>{{ $us->district }}</td>
        <td>{{ $us->target_population}}</td>
        <td>{{ $us->pregnancy }}</td>
        <td>{{ $us->annual_birth }}</td>
        <td>{{ $us->surviving_infants }}</td>
    </tr>
    @endforeach

    </tbody>
    </table>

    @endif
</div>
</div>
</div>


<!--script to process the list of users-->
<script>
    /* Table initialisation */
    $(document).ready(function() {
        $('#example2').dataTable({
            "fnDrawCallback": function( oSettings ) {

            }
        });
        $('input[type="text"]').addClass("form-control").attr("placeholder","District, Region");
        $('select').addClass("form-control");

    } );
</script>
