
<div class="col-sm-12" id="qroutput" style="margin-bottom: 20px"></div>
<div class="col-sm-12" style="margin-bottom: 5px">
    <div class="col-sm-7"><br><h4>Package sent from region level on {{ date('j M Y',strtotime($package->created_at)) }}</h4></div>
    <div class="col-sm-5">
        <form method="post" action="{{ url('') }}" id="checkqr">
            <div class="form-group" >
                <div class="col-sm-8">
                    Enter Lot Number <br>
                    <input type="text" name="lot" placeholder="Enter Lot Number" required class="form-control">
                </div>
                <div class="col-sm-4">
                    <br>
                    <input type="submit" value="Scan" class="btn btn-sm btn-primary" />
                </div>
            </div>
        </form>
    </div>
</div>
    <div class="col-sm-12">
<table class="table table-responsive table-bordered" id="alllist">
    <tr>
        <th>GTIN</th>
        <th>Description</th>
        <th>Manufacturer</th>
        <th>Lot</th>
        <th>Expiry</th>
        <th>Vials</th>
        <th>Boxes</th>
        <th>Doses</th>
    </tr>
    @foreach($package->packages()->where('status','')->get() as $pack)
    <tr>
        <td>{{ $pack->vaccine->GTIN }}</td>
        <td>{{ $pack->vaccine->name }}</td>
        <td>{{ $pack->vaccine->manufacturer }}</td>
        <td>{{ $pack->lot_number }}</td>
        <td>{{ date('j M Y',strtotime($pack->manufacturer->expiry_date)) }}</td>
        <td>{{ ($pack->number_of_boxes*$pack->vaccine->vials_per_box) }}</td>
        <td>{{ $pack->number_of_boxes }}</td>
        <td>{{ ($pack->number_of_boxes*$pack->vaccine->doses_per_vial)*$pack->vaccine->vials_per_box }}</td>

    </tr>
    @endforeach
</table>
    </div>

<script>
    $(document).ready(function(){
        $("input[name=lot]").focus();
        $('#checkqr').on('submit', function(e) {
            e.preventDefault();
            $("#qroutput").html("<h4><i class='fa fa-spin fa-spinner '></i><span>Retriving package information please wait...</span><h4>");
            $(this).ajaxSubmit({
                url : '<?php echo url('district_package/receive/qrcode') ?>/'+$('input[name=lot]').val(),
                data:{pack:'<?php echo $package->package_number ?>'},
                target: '#qroutput',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            $('#checkqr').resetForm();
            $("input[name=lot]").focus();
        }
    })
</script>
