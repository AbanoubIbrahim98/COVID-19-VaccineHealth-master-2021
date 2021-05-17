@extends("layout.master")

@section('title')
<h1>
    Dispatched Items
    <small>{{ Auth::user()->region->region }} Region Dispatch Information </small>
</h1>
@stop
@section('contents')
@if(RegionalPackage::where('sender','!=','0')->where('date_sent','!=','')->where('source_id',Auth::user()->region_id)->count() == 0)
<h3>There are no packages sent</h3>
@else
<table class="table table-striped table-bordered example3" id="example2">
    <thead>
    <tr>
        <th>Package Number</th>
        <th>Destination</th>
        <th>Date dispatched</th>
        <th>Status</th>
        <th>
            Contents
            <div class="col-sm-12">
                <div class="col-sm-3">GTIN</div>
                <div class="col-sm-1">Item</div>
                <div class="col-sm-3">Manufacturer</div>
                <div class="col-sm-2">Lot Number</div>
                <div class="col-sm-2">Expiry Date</div>
                <div class="col-sm-1">Doses</div>
            </div>
        </th>
    </tr>


    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(RegionalPackage::where('date_sent','!=','')->where('source_id',Auth::user()->region_id)->orderBy('created_at','DESC')->get() as $us)
    @if($us)
    <tr>
        <td>{{ $us->package_number }}</td>
        <td>{{ $us->district->district }}</td>
        <td>{{ date("d M Y", strtotime($us->date_sent)) }}</td>
        <td>
            @if($us->received_status == 'received')
              Received on <br> {{ date("d M Y", strtotime($us->updated_at)) }}
            @else
              On Transit
            @endif
        </td>
        <td>
            <?php $i=1; ?>
            @foreach($us->packages as $pack)
            <div class="col-sm-12" style="border-bottom: 1px solid cornflowerblue">
                <div class="col-sm-3">{{ $pack->vaccine->GTIN }}</div>
                <div class="col-sm-1">{{ $pack->vaccine->name }}</div>
                <div class="col-sm-3">{{ $pack->vaccine->manufacturer }}</div>
                <div class="col-sm-2">{{ $pack->lot_number }}</div>
                <div class="col-sm-2">{{ date("d M Y", strtotime($pack->manufacturer->expiry_date)) }}</div>
                <div class="col-sm-1">{{ $pack->number_of_boxes*$pack->vaccine->doses_per_vial*$pack->vaccine->vials_per_box }}</div>

            </div>

            @endforeach
        </td>
    </tr>
    @endif
    @endforeach

    </tbody>
</table>
@stop
@endif
