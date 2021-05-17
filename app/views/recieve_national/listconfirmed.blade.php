<h3 class="lead">Checked items waiting for confirmation
<button class="btn btn-xs btn-success">confirm</button>
<button class="btn btn-xs btn-danger">cancel</button>
</h3>
<table class="table table-responsive table-bordered" id="alllist">
    <tr>
        <th>GTIN</th>
        <th>Description</th>
        <th>Lot</th>
        <th>Expiry</th>
        <th>Vials sent</th>
        <th>Vials received</th>
        <th>Boxes</th>
        <th>Doses sent</th>
        <th>Doses received</th>
    </tr>
    @foreach($packages as $pack)
    <tr>
        <td>{{ $pack->vaccine->GTIN }}</td>
        <td>{{ $pack->vaccine->name }}</td>
        <td>{{ $pack->lot_number }}</td>
        <td>{{ $pack->expiry_date }}</td>
        <td>{{ $pack->number_of_doses/$pack->vaccine->doses_per_vial }}</td>
        <td>{{ ($pack->number_of_doses/$pack->vaccine->doses_per_vial)/$pack->vaccine->vials_per_box }}</td>
        <td>{{ $pack->number_of_doses }}</td>
    </tr>
    @endforeach
</table>
