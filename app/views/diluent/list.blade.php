
<div class="row">
<div class="panel panel-default">
<div class="panel-heading">
    <div class="text-muted bootstrap-admin-box-title">Diluent Lists</div>
</div>
<div class="bootstrap-admin-panel-content">
   @if(Diluent::all()->count() == 0)
    <h3>There are no defined diluents</h3>
    @else
    <table class="table table-striped table-bordered" id="example3">
    <thead>
    <tr>
        <th> # </th>
        <th> Diluent Name </th>
        <th> Vaccine </th>
        <th> Units per Box </th>
        <th> Action </th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(Diluent::all() as $us)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $us->diluent_name }}</td>
        <td style="text-transform: capitalize">{{ $us->vaccine->vaccine_name }}</td>
        <td>{{ $us->units_per_box }}</td>
        <td id="{{ $us->id }}">
            <a href="#edit" title="edit Vaccine" class="editduser"><i class="fa fa-pencil text-info"></i> edit</a>&nbsp;&nbsp;&nbsp;
            <a href="#b" title="delete Vaccine" class="deletedvaccine"><i class="fa fa-trash-o text-danger"></i> </a>
        </td>
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
        $('#example3').dataTable({
            "fnDrawCallback": function( oSettings ) {
                //editing a room
                $(".editduser").click(function(){
                    var id1 = $(this).parent().attr('id');
                    $("#addduser").html("<br><i class='fa fa-spinner fa-spin'></i>loading...");
                    $("#addduser").load("<?php echo url("diluent/edit") ?>/"+id1);
                })


                $(".deletedvaccine").click(function(){
                    var id1 = $(this).parent().attr('id');
                    $(".deletedvaccine").show("slow").parent().parent().find("span").remove();
                    var btn = $(this).parent().parent();
                    $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                    $("#no").click(function(){
                        $(this).parent().parent().find(".deletedvaccine").show("slow");
                        $(this).parent().parent().find("span").remove();
                    });
                    $("#yes").click(function(){
                        $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                        $.post("<?php echo url('diluent/delete') ?>/"+id1,function(data){
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
