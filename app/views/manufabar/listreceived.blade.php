
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="text-muted bootstrap-admin-box-title">International shipment</div>
        </div>
        <div class="bootstrap-admin-panel-content">
            @if(ManufacturePackage::where('status','received')->count() == 0)
            <h3>There are no Packages</h3>
            @else
            <table class="table table-striped table-bordered" id="example3">
                <thead>
                <tr>
                    <th> # </th>
                    <th>SSCC</th>
                    <th>Item</th>
                    <th>Manufacture</th>
                    <th>GTIN</th>
                    <th>Lot Number</th>
                    <th>Expiry</th>
                    <th>Doses</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                @foreach(ManufacturePackage::where('status','received')->get() as $pack)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $pack->sscc }}</td>
                    <td>{{ $pack->vaccine->name }}</td>
                    <td>{{ $pack->vaccine->manufacturer }}</td>
                    <td>{{ $pack->vaccine->GTIN }}</td>
                    <td>{{ $pack->lot_number }}</td>
                    <td>{{ date('j M Y',strtotime($pack->expiry_date)) }}</td>
                    <td>{{ $pack->number_of_doses }}</td>
                </tr>
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
        $('#example3').dataTable({
            "fnDrawCallback": function( oSettings ) {
                //editing a room
                $(".edituser").click(function(){
                    var id1 = $(this).parent().attr('id');
                    $("#adduser").html("<br><i class='fa fa-spinner fa-spin'></i>loading...");
                    $("#adduser").load("<?php echo url("manubarcode/edit") ?>/"+id1);
                })


                $(".deletevaccine").click(function(){
                    var id1 = $(this).parent().attr('id');
                    $(".deletevaccine").show("slow").parent().parent().find("span").remove();
                    var btn = $(this).parent().parent();
                    $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                    $("#no").click(function(){
                        $(this).parent().parent().find(".deletevaccine").show("slow");
                        $(this).parent().parent().find("span").remove();
                    });
                    $("#yes").click(function(){
                        $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                        $.post("<?php echo url('manubarcode/delete') ?>/"+id1,function(data){
                            btn.hide("slow").next("hr").hide("slow");
                        });
                    });
                });//endof deleting category
            }
        });

        $('input[type="text"]').addClass("form-control");
        $('select').addClass("form-control");

    } );
</script>
