@extends("layout.master")

@section('title')
<h1>
    Received Packages
    <small>National Received Packages </small>
</h1>
@stop
@section('contents')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="text-muted bootstrap-admin-box-title">Received Packages</div>
    </div>
        <div class="bootstrap-admin-panel-content">
            @if(ManufacturePackage::where('status','received')->count() == 0)
            <h3>There are no Packages</h3>
            @else
            <table class="table table-striped table-bordered" id="example2">
                <thead>
                <tr>
                    <th> # </th>
                    <th>SSCC</th>
                    <th>GTIN</th>
                    <th>Manufacturer</th>
                    <th>Item</th>
                    <th>Lot Number</th>
                    <th>Expiry</th>
                    <th>Date received</th>
                    <th>Doses</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                @foreach(ManufacturePackage::where('status','received')->get() as $pack)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $pack->sscc }}</td>
                    <td>{{ $pack->vaccine->GTIN }}</td>
                    <td>{{ $pack->vaccine->manufacturer }}</td>
                    <td>{{ $pack->vaccine->name }}</td>
                    <td>{{ $pack->lot_number }}</td>
                    <td>{{ date('j M Y',strtotime($pack->expiry_date)) }}</td>
                    <td>{{ date('j M Y',strtotime($pack->updated_at)) }}</td>
                    <td>{{ $pack->number_of_doses }}</td>
                </tr>
                @endforeach

                </tbody>
            </table>
            <script>
                /* Table initialisation */
                $(document).ready(function() {
                    $('#example2').dataTable({

                    });

                    $('input[type="text"]').addClass("form-control");
                    $('select').addClass("form-control");

                } );
            </script>
            @endif
        </div>
</div>



<!--script to process the list of users-->
<script>
    /* Table initialisation */
    $(document).ready(function() {
        $('.example3').dataTable({

        });

        $('input[type="text"]').addClass("form-control");
        $('select').addClass("form-control");

    } );
</script>
@stop