
<div class="row">
<div class="panel panel-default">
<div class="panel-heading">
    <div class="text-muted bootstrap-admin-box-title">
        Vaccine&Diluent List
        <button class="btn btn-primary btn-xs pull-right add" id="add"><i class="fa fa-plus"></i> add</button>
    </div>
</div>
<div class="bootstrap-admin-panel-content">
   @if(Vaccine::all()->count() == 0)
    <h3>There are no defined vaccines or diluents</h3>
    @else
    <table class="table table-striped table-bordered" id="example2">
    <thead>
    <tr>
        <th> # </th>
        <th> GTIN Number </th>
        <th> Manufacture </th>
        <th> Short Description </th>
        <th> Packaging</th>
        <th> Vials per box</th>
        <th> Doses per Vial</th>
        <th> Origin</th>
        <th> Warning </th>
        <th> Wastage Rate </th>
        <th> Schedule </th>
        <th> Action </th>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach(Vaccine::all() as $us)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $us->GTIN }}</td>
        <td>{{ $us->manufacturer }}</td>
        <td style="text-transform: capitalize">{{ $us->name }}</td>
        <td>{{ $us->packaging }}</td>
        <td>{{ $us->vials_per_box }}</td>
        <td>{{ $us->doses_per_vial }}</td>
        <td>{{ $us->country->name }}</td>
        <td>{{ $us->warning_period }} month</td>
        <td>{{ $us->wastage }} </td>
        <td>{{ $us->schedule }} </td>
        <td id="{{ $us->id }}">
            <a href="#edit" title="edit Vaccine" class="edituser"><i class="fa fa-pencil text-info"></i> edit</a>&nbsp;&nbsp;&nbsp;
            <a href="#b" title="delete Vaccine" class="deletevaccine"><i class="fa fa-trash-o text-danger"> delete</i> </a>
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
        $('#example2').dataTable({
            "fnDrawCallback": function( oSettings ) {
                //editing a room
                $(".edituser").click(function(){
                    var id1 = $(this).parent().attr('id');
                    var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
                    modal+= '<div class="modal-dialog">';
                    modal+= '<div class="modal-content">';
                    modal+= '<div class="modal-header">';
                    modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                    modal+= '<h2 class="modal-title" id="myModalLabel">Update Vaccine/Diluent Information</h2>';
                    modal+= '</div>';
                    modal+= '<div class="modal-body">';
                    modal+= ' </div>';
                    modal+= '</div>';
                    modal+= '</div>';

                    $("body").append(modal);
                    $("#myModal").modal("show");
                    $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                    $(".modal-body").load("<?php echo url("vaccine/edit") ?>/"+id1);
                    $("#myModal").on('hidden.bs.modal',function(){
                        $("#myModal").remove();
                    })
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
                        $.post("<?php echo url('vaccine/delete') ?>/"+id1,function(data){
                            btn.hide("slow").next("hr").hide("slow");
                        });
                    });
                });//endof deleting category
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


        //managing the add button
        $(".add").click(function(){
            var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
            modal+= '<div class="modal-dialog">';
            modal+= '<div class="modal-content">';
            modal+= '<div class="modal-header">';
            modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
            modal+= '<h2 class="modal-title" id="myModalLabel">Add Vaccine/Diluent</h2>';
            modal+= '</div>';
            modal+= '<div class="modal-body">';
            modal+= ' </div>';
            modal+= '</div>';
            modal+= '</div>';

            $("body").append(modal);
            $("#myModal").modal("show");
            $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
            $(".modal-body").load("<?php echo url("vaccine/add/") ?>");
            $("#myModal").on('hidden.bs.modal',function(){
                $("#myModal").remove();
            })

        })
    } );
</script>
