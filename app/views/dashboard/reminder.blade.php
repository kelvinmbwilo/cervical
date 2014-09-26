@extends("layout.master")


@section('title')
Reminders
@stop


@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">SMS Reminders</li>

@stop

@section('contents')
<div class="row">
    <!-- Nav tabs -->
    <ul class="nav nav-pills" role="tablist">
        <li class="active"><a style="color: rgba(0,0,0,0.6)" href="#all" role="tab" data-toggle="tab">
                All Messages <span class="badge badge-dutch">{{ count(Notification::all()) }}</span>
            </a></li>
        <li><a href="#pending" role="tab" data-toggle="tab" style="color: rgba(0,0,0,0.6)">
                Pending Messages <span class="badge badge-dutch">{{ count(Notification::where('status','pending')->get()) }}</span>
            </a></li>
        <li><a href="#sent" role="tab" data-toggle="tab" style="color: rgba(0,0,0,0.6)">
                Sent Messages <span class="badge badge-dutch">{{ count(Notification::where('status','sent')->get()) }}</span>
            </a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="all">
                <div class="table-responsive">
                    <table  class="table table-datatable table-custom" id="advancedDataTable1">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> Hospital Number </th>
                            <th> Name </th>
                            <th> Phone Number </th>
                            <th> Message Status </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1;
                        ?>
                        @foreach(Notification::all() as $us)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $us->patient->hospital_id }}</td>
                            <td style="text-transform: capitalize">{{ $us->patient->first_name }} {{ $us->patient->middle_name }} {{ $us->patient->last_name }}</td>
                            <td>{{ $us->phone_number }}</td>
                            <td>{{ $us->status }}</td>
                            <td id="{{ $us->id }}">
                                <a href="#b" title="delete Reminder" class="deletefacility"><i class="fa fa-trash-o text-danger"></i> delete </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

        </div>
        <div class="tab-pane" id="pending">

            <div class="table-responsive">
                <table  class="table table-datatable table-custom" id="advancedDataTable1">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> Hospital Number </th>
                        <th> Name </th>
                        <th> Phone Number </th>
                        <th> Message Status </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1;
                    ?>
                    @foreach(Notification::where('status','pending')->get() as $us)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $us->patient->hospital_id }}</td>
                        <td style="text-transform: capitalize">{{ $us->patient->first_name }} {{ $us->patient->middle_name }} {{ $us->patient->last_name }}</td>
                        <td>{{ $us->phone_number }}</td>
                        <td>{{ $us->status }}</td>
                        <td id="{{ $us->id }}">
                            <a href="#b" title="delete Reminder" class="deletefacility"><i class="fa fa-trash-o text-danger"></i> delete </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="sent">

            <div class="table-responsive">
                <table  class="table table-datatable table-custom" id="advancedDataTable2">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> Hospital Number </th>
                        <th> Name </th>
                        <th> Phone Number </th>
                        <th> Message Status </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1;
                    ?>
                    @foreach(Notification::where('status','sent')->get() as $us)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $us->patient->hospital_id }}</td>
                        <td style="text-transform: capitalize">{{ $us->patient->first_name }}{{ $us->patient->middle_name }}{{ $us->patient->last_name }}</td>
                        <td>{{ $us->phone_number }}</td>
                        <td>{{ $us->status }}</td>
                        <td id="{{ $us->id }}">
                            <a href="#b" title="delete Reminder" class="deletefacility"><i class="fa fa-trash-o text-danger"></i> delete </a>
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

                var oTable04 = $('#advancedDataTable,#advancedDataTable1,#advancedDataTable2').dataTable({
                    "sDom":
                        "<'row'<'col-md-4'l><'col-md-4 text-center sm-left'T C><'col-md-4'f>r>"+
                            "t"+
                            "<'row'<'col-md-4 sm-center'i><'col-md-4'><'col-md-4 text-right sm-center'p>>",
                    "oLanguage": {
                        "sSearch": ""
                    },
                    "oTableTools": {
                        "aButtons": [
                            "print"
                        ]
                    },
                    "fnDrawCallback": function( oSettings ) {

                        $(".deletefacility").click(function(){
                            var id1 = $(this).parent().attr('id');
                            $(".deletefacility").show("slow").parent().parent().find("span").remove();
                            var btn = $(this).parent().parent();
                            $(this).hide("slow").parent().append("<span><br>Are You Sure <br /> <a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
                            $("#no").click(function(){
                                $(this).parent().parent().find(".deletefacility").show("slow");
                                $(this).parent().parent().find("span").remove();
                            });
                            $("#yes").click(function(){
                                $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>deleting...");
                                $.post("<?php echo url('reminder/delete') ?>/"+id1,function(data){
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
    </div>
</div>
@stop