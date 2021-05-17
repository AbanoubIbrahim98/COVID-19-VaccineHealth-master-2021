@extends("layout.master")

@section('title')
<h1>
    Received Packages
    <small>{{ Auth::user()->region->region }} Region Received Packages </small>
</h1>
@stop
@section('contents')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="text-muted bootstrap-admin-box-title">Received Packages</div>
    </div>
        <div class="bootstrap-admin-panel-content">
            @if(NationalPackage::where('region_id', Auth::user()->region_id)->where('received_status','received')->count() == 0)
            <h3>There are no Packages</h3>
            @else
            <table class="table table-striped table-bordered" id="example3">
                <thead>
                <tr>
                    <th> # </th>
                    <th>Shipment Number</th>
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
                @foreach(NationalPackage::where('region_id', Auth::user()->region_id)->where('received_status','received')->get() as $pack)
                @foreach($pack->packages as $us)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $pack->package_number }}</td>
                    <td>{{ $us->vaccine->GTIN }}</td>
                    <td>{{ $us->vaccine->manufacturer }}</td>
                    <td>{{ $us->vaccine->name }}</td>
                    <td>{{ $us->lot_number }}</td>
                    <td>{{ date('j M Y',strtotime($us->manufacturer->expiry_date)) }}</td>
                    <td>{{ date('j M Y',strtotime($pack->updated_at)) }}</td>
                    <td>{{ $us->number_of_boxes*$us->vaccine->vials_per_box*$us->vaccine->doses_per_vial }}</td>
                </tr>
                @endforeach
                @endforeach

                </tbody>
            </table>

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