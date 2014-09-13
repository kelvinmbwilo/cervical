@extends("layout.master")

@section('title')
Patients
@stop

@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Patients</li>

@stop

@section('contents')
<?php
$patient = Patient::all();

?>

<div class="tile-body color blue rounded-corners">
    <a href="{{ url('patient/register') }}" class="btn btn-primary btn-xs add" id="add">New Registration <i class="fa fa-plus"></i> </a>
    <div class="table-responsive">
        <table  class="table table-datatable table-custom" id="advancedDataTable">
            <thead>
            <tr>
                <th> # </th>
                <th> Hosptal_id </th>
                <th> Name </th>
                <th> Age </th>
                <th> Region </th>
                <th> District </th>
                <th>Last Visit</th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            @foreach(Patient::all() as $us)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $us->hospital_id }}</td>
                <td style="text-transform: capitalize">{{ $us->first_name }} {{ $us->middle_name }} {{ $us->last_name }}</td>
                <td>{{ date('Y')-date('Y',strtotime($us->birth_date)) }} Yrs</td>
                <td>{{ $us->info()->orderBy('created_at','DESC')->first()->regions->region }}</td>
                <td>{{ $us->info()->orderBy('created_at','DESC')->first()->districts->district }}</td>
                <td>{{ date('j M Y',strtotime($us->visit()->orderBy('created_at','DESC')->first()->visit_date)) }}</td>
                <td id="{{ $us->id }}">
                    <a href='{{ url("patient/follow_up/{$us->id}") }}' title="View Staff log" class="userlog"><i class="fa fa-mail-forward text-success"></i> Follow Up</a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ url("patients/{$us->id}") }}" title="patient Information" class="edituser"><i class="fa fa-info-circle text-info"></i> info</a>&nbsp;&nbsp;&nbsp;
                    <a href="#b" title="delete Patient" class="deleteuser"><i class="fa fa-trash-o text-danger"></i> delete</a>
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
                        $.post("<?php echo url('patient/delete') ?>/"+id1,function(data){
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

@stop