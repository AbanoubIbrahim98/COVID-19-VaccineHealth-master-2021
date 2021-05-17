@extends("layout.master")

@section('title')
<h1>
    Received Packages
    <small>National level </small>
</h1>
@stop
@section('contents')
@if(ArrivalNational::all()->count() == 0)
<h3>There are no  Received Packages</h3>
@else
<table class="table table-striped table-bordered" id="example2">
    <thead>
    <tr>
        <th> # </th>
        <th>SSCC</th>
<!--        <th>Number Of Packages</th>-->
        <th>Coolant type</th>
        <th>Temperature Monitor</th>
        <th>Labels</th>
        <th>Condition</th>
        <th>Received By</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(ArrivalNational::all() as $us)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $us->ssc }}</td>
<!--        <td>{{ $us->number_of_packages }}</td>-->
        <td>{{ $us->coolant_type }}</td>
        <td>{{ $us->temperature_monitor }}</td>
        <td>{{ $us->labels_available }}</td>
        <td>{{ $us->condition }}</td>
        <td>{{ $us->user->firstname }}</td>

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
                //editing a room
               }
        });
        $('#example').dataTable({
            "sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ records per page"
            }
        });
        $('input[type="text"]').addClass("form-control");
        $('select').addClass("form-control");

    } );
</script>
@stop