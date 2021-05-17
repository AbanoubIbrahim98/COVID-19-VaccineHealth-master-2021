@extends("layout.master")

@section('title')
<h1>
    Stock Balance
    <small>National Stock Balance </small>
</h1>
@stop
@section('contents')
@if(NationalStock::all()->count() == 0)
<h3>There are no vaccines or diluent in the stock</h3>
@else
<table class="table table-bordered example3" id="example2">
    <thead>
    <tr>
        <th> # </th>
        <th>GTIN</th>
        <th>Manufacturer</th>
        <th>Item</th>
        <th>Lot Number</th>
        <th>Number Of Doses</th>
        <th>Expiry Date</th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(NationalStock::all() as $us)
    @if($us)
        @if($us->number_of_doses > 0 )
    @if(strtotime($us->expiry_date) < strtotime(date('Y-m-d')))
            <tr class="danger" title="this item has expired">
       @elseif((strtotime($us->expiry_date) - strtotime(date('Y-m-d')))/2592000 < $us->vaccine->warning_period)
            <tr class="warning" title="This item is near expiry date">
         @else
            <tr>
                @endif
                <td>{{ $i++ }}</td>
                <td>{{ $us->vaccine->GTIN }}</td>
                <td>{{ $us->vaccine->manufacturer }}</td>
                <td>{{ $us->vaccine->name }}</td>
                <td>{{ $us->lot_number }}</td>
                <td>{{ $us->number_of_doses }}</td>
                <td>{{ date('j M Y',strtotime($us->expiry_date)) }}</td>
            </tr>
        @endif
    @endif
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
@stop