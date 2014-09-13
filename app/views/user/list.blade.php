

<div class="tile-body color blue rounded-corners">
    <button class="btn btn-primary btn-xs add" id="add">New User <i class="fa fa-plus"></i> </button>
    <div class="table-responsive">
        <table  class="table table-datatable table-custom" id="advancedDataTable">
            <thead>
            <tr>
                <th> # </th>
                <th class="sort-alpha">Name</th>
                <th class="sort-alpha">Email</th>
                <th class="sort-amount">Phone</th>
                <th class="sort-amount">Role</th>
                <th >Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            @foreach(User::where('status','active')->get() as $us)
            <tr>
                <td>{{ $i++ }}</td>
                <td style="text-transform: capitalize">{{ $us->firstname }} {{ $us->middlename }} {{ $us->lastname }}</td>
                <td>{{ $us->email }}</td>
                <td>{{ $us->phone }}</td>
                <td>{{ $us->role }}</td>
                <td id="{{ $us->id }}">
                    <a href="#log" title="View Staff log" class="userlog"><i class="fa fa-list text-success"></i> log</a>&nbsp;&nbsp;&nbsp;
                    <a href="#edit" title="edit User" class="edituser"><i class="fa fa-pencil text-info"></i> edit</a>&nbsp;&nbsp;&nbsp;
                    <a href="#b" title="delete User" class="deleteuser"><i class="fa fa-trash-o text-danger"></i> </a>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>


<!--script to process the list of users-->
<script>
    /* Table initialisation */
    $(document).ready(function() {

        var oTable04 = $('#advancedDataTable').dataTable({
            "sDom":
                "<'row'<'col-md-4'l><'col-md-4 text-center sm-left'T C><'col-md-4'f>r>"+
                    "t"+
                    "<'row'<'col-md-4 sm-center'i><'col-md-4'><'col-md-4 text-right sm-center'p>>",
            "oLanguage": {
                "sSearch": ""
            },
            "oTableTools": {
                "sSwfPath": "assets/js/vendor/datatables/tabletools/swf/copy_csv_xls_pdf.swf",
                "aButtons": [
                    "print",
                    {
                        "sExtends":    "collection",
                        "sButtonText": 'Save <span class="caret" />',
                        "aButtons":    [ "csv", "xls", "pdf" ]
                    }
                ]
            },
            "fnDrawCallback": function( oSettings ) {
            //editing a room
            $(".edituser").click(function(){
                var id1 = $(this).parent().attr('id');
                var modal = '<div class="modal fade" id="modalDialog" tabindex="-1" role="dialog" aria-labelledby="modalDialogLabel" aria-hidden="true">';
                modal+= '<div class="modal-dialog">';
                modal+= '<div class="modal-content">';
                modal+= '<div class="modal-header">';
                modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button>';
                modal+= '<h3 class="modal-title" id="modalDialogLabel"><strong>Update User </strong>  Information</h3>';
                modal+= '</div>';
                modal+= '<div class="modal-body">';
                modal+= ' </div>';
                modal+= '</div>';
                modal+= '</div>';

                $("body").append(modal);
                $("#modalDialog").modal("show");
                $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                $(".modal-body").load("<?php echo url("user/edit") ?>/"+id1);
                $("#modalDialog").on('hidden.bs.modal',function(){
                    $("#modalDialog").remove();
                })
            })

                $(".add").click(function(){
                var id1 = $(this).parent().attr('id');
                var modal = '<div class="modal fade" id="modalDialog" tabindex="-1" role="dialog" aria-labelledby="modalDialogLabel" aria-hidden="true">';
                modal+= '<div class="modal-dialog">';
                modal+= '<div class="modal-content">';
                modal+= '<div class="modal-header">';
                modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button>';
                modal+= '<h3 class="modal-title" id="modalDialogLabel">Add New User </h3>';
                modal+= '</div>';
                modal+= '<div class="modal-body">';
                modal+= ' </div>';
                modal+= '</div>';
                modal+= '</div>';

                $("body").append(modal);
                $("#modalDialog").modal("show");
                $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                $(".modal-body").load("<?php echo url("user/add") ?>");
                $("#modalDialog").on('hidden.bs.modal',function(){
                    $("#modalDialog").remove();
                })
            })

            //display user log
            $(".userlog").click(function(){
                var id1 = $(this).parent().attr('id');
                var modal = '<div class="modal fade" id="modalDialog" tabindex="-1" role="dialog" aria-labelledby="modalDialogLabel" aria-hidden="true">';
                modal+= '<div class="modal-dialog">';
                modal+= '<div class="modal-content">';
                modal+= '<div class="modal-header">';
                modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close</button>';
                modal+= '<h3 class="modal-title" id="modalDialogLabel"><strong>Update User </strong>  Information</h3>';
                modal+= '</div>';
                modal+= '<div class="modal-body">';
                modal+= ' </div>';
                modal+= '</div>';
                modal+= '</div>';

                $("body").append(modal);
                $("#modalDialog").modal("show");
                $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
                $(".modal-body").load("<?php echo url("user/log") ?>/"+id1);
                $("#modalDialog").on('hidden.bs.modal',function(){
                    $("#modalDialog").remove();
                })
            })

            $(".deleteuser").click(function(){
                var id1 = $(this).parent().attr('id');
                $(".deleteuser").show("slow").parent().parent().find("span").remove();
                var btn = $(this).parent().parent();
                $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                $("#no").click(function(){
                    $(this).parent().parent().find(".deleteuser").show("slow");
                    $(this).parent().parent().find("span").remove();
                });
                $("#yes").click(function(){
                    $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                    $.post("<?php echo url('user/delete') ?>/"+id1,function(data){
                        btn.hide("slow").next("hr").hide("slow");
                    });
                });
            });//endof deleting category
        },
            "fnInitComplete": function(oSettings, json) {
                $('.dataTables_filter input').attr("placeholder", "Search");
            },
            "oColVis": {
                "buttonText": '<i class="fa fa-eye"></i>'
            }
        });

        $('.ColVis_MasterButton').on('click', function(){
            var newtop = $('.ColVis_collection').position().top - 45;

            $('.ColVis_collection').addClass('dropdown-menu');
            $('.ColVis_collection>li>label').addClass('btn btn-default')
            $('.ColVis_collection').css('top', newtop + 'px');
        });

        $('.DTTT_button_collection').on('click', function(){
            var newtop = $('.DTTT_dropdown').position().top - 45;
            $('.DTTT_dropdown').css('top', newtop + 'px');
        });

        //initialize chosen
        $('.dataTables_length select').chosen({disable_search_threshold: 10});

        // Add custom class
        $('div.dataTables_filter input').addClass('form-control');
        $('div.dataTables_length select').addClass('form-control');



    } );
</script>
