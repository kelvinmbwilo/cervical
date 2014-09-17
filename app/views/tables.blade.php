@extends('layout.master')

@section('title')
Example datatable
@stop

@section('contents')
<div class="tile-body color blue rounded-corners">

    <div class="table-responsive">
        <table  class="table table-datatable table-custom" id="advancedDataTable">
            <thead>
            <tr>
                <th class="sort-alpha">Rendering engine</th>
                <th class="sort-alpha">Kelvin</th>
                <th class="sort-amount">Platform(s)</th>
                <th class="sort-numeric">Engine version</th>
                <th>CSS grade</th>
            </tr>
            </thead>
            <tbody>
            <tr class="odd gradeX">
                <td>Trident</td>
                <td>Internet Explorer 4.0</td>
                <td>Win 95+</td>
                <td class="text-center"> 4</td>
                <td class="text-center">X</td>
            </tr>
            <tr class="even gradeC">
                <td>Trident</td>
                <td>Internet Explorer 5.0</td>
                <td>Win 95+</td>
                <td class="text-center">5</td>
                <td class="text-center">C</td>
            </tr>
            <tr class="odd gradeA">
                <td>Trident</td>
                <td>Internet Explorer 5.5</td>
                <td>Win 95+</td>
                <td class="text-center">5.5</td>
                <td class="text-center">A</td>
            </tr>
            <tr class="even gradeA">
                <td>Trident</td>
                <td>Internet Explorer 6</td>
                <td>Win 98+</td>
                <td class="text-center">6</td>
                <td class="text-center">A</td>
            </tr>
            <tr class="odd gradeA">
                <td>Trident</td>
                <td>Internet Explorer 7</td>
                <td>Win XP SP2+</td>
                <td class="text-center">7</td>
                <td class="text-center">A</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
<!-- /tile body -->

<script>
    $(document).ready(function(){
        /****************************************************/
        /**************** ADVANCED DATATABLE ****************/
        /****************************************************/

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

    })
</script>
@stop