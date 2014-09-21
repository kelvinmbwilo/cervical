<?php

class ReportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make("report.index");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        Report::create(array(
            "name" => Input::get("name"),
            "value" => json_encode(Input::all()),
        ));
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show()
	{
		return View::make('report.myreport');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $value = json_decode(Report::find($id)->value);
        echo Form::open(array("url"=>url("reports/download"),"class"=>"form-horizontal","id"=>'formms'));
        foreach($value as $key=>$val){
            ?>
            <input type="hidden" name="<?php echo $key ?>" value="<?php echo $val ?>"
                   xmlns="http://www.w3.org/1999/html">
        <?php
    }?>
        <div class="col-xs-12" style="margin-top: 5px">
            <div style="margin: 10px;margin-left: 0px" class="col-md-1 btn btn-default btn-sm" id="records"><img src="<?php echo asset('table.png') ?>" style="height: 20px;width: 20px" /> Records</div>
            <div style="margin: 10px" class="col-md-1 btn btn-default btn-sm" id="table"><img src="<?php echo asset('table.png') ?>" style="height: 20px;width: 20px" /> Table</div>
            <div style="margin: 10px" class="col-md-1 btn btn-default btn-sm" id="bar"><img src="<?php echo asset('bar.png') ?>" style="height: 20px;width: 20px" /> Bar</div>
            <div style="margin: 10px" class="col-md-1 btn btn-default btn-sm" id="line"><img src="<?php echo asset('line.png') ?>" style="height: 20px;width: 20px" /> Line</div>
            <div style="margin: 10px" class="col-md-1 btn btn-default btn-sm" id="column"><img src="<?php echo asset('column.png') ?>" style="height: 20px;width: 20px" /> Column</div>
            <div style="margin: 10px" class="col-md-1 btn btn-default btn-sm" id="combined"><img src="<?php echo asset('combined.jpg') ?>" style="height: 20px;width: 20px" /> Combined</div>
            <button name="records" style="margin: 10px" type="submit" class="col-md-1 btn btn-default btn-sm"><img src="<?php echo asset('cvs.jpg') ?>" style="height: 20px;width: 20px" /> Records</button>
            <button name='reports' style="margin: 10px" type="submit" class="col-md-1 btn btn-default btn-sm"><img src="<?php echo asset('cvs.jpg') ?>" style="height: 20px;width: 20px" /> Reports</button>

        </div>
        </form>
        <div id="chartarea" class="col-xs-12" style="margin-top: 10px"></div>
        <script>
            //managing chats buttons
            $("#table").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $(this).addClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $("#formms").ajaxSubmit({
                    url:"<?php echo url('report/general/table') ?>",
                    target: '#chartarea',
                    data: {chat:'table'},
                    success:  afterSuccess
                });
            });
            $("#table").trigger("click");

            $("#pie").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $(this).addClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $("#formms").ajaxSubmit({
                    url:"<?php echo url('report/general/pie') ?>",
                    target: '#chartarea',
                    data: {chat:'table'},
                    success:  afterSuccess
                });
            });

            $("#bar").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $(this).addClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $("#formms").ajaxSubmit({
                    url:"<?php echo url('report/general/bar') ?>",
                    target: '#chartarea',
                    data: {chat:'table'},
                    success:  afterSuccess
                });
            });

            $("#combined").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $(this).addClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $("#formms").ajaxSubmit({
                    url:"<?php echo url('report/general/combined') ?>",
                    target: '#chartarea',
                    data: {chat:'table'},
                    success:  afterSuccess
                });
            });

            $("#records").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $(this).addClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $("#formms").ajaxSubmit({
                    url:"<?php echo url('report/general/records') ?>",
                    target: '#chartarea',
                    data: {chat:'table'},
                    success:  afterSuccess
                });
            });

            $("#excel").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $(this).addClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $("#formms").ajaxSubmit({
                    url:"<?php echo url('reports/download') ?>",
                    target: '#chartarea',
                    data: {chat:'table'},
                    success:  afterSuccess
                });
            });

            $("#column").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $(this).addClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $("#formms").ajaxSubmit({
                    url:"<?php echo url('report/general/column') ?>",
                    target: '#chartarea',
                    data: {chat:'table'},
                    success:  afterSuccess
                });
            });

            $("#line").unbind("click").click(function(){
                $(".btn").removeClass("btn-info")
                $(this).addClass("btn-info")
                $("#chartarea").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Loading...</span><h3>");
                $("#formms").ajaxSubmit({
                    url:"<?php echo url('report/general/line') ?>",
                    target: '#chartarea',
                    data: {chat:'table'},
                    success:  afterSuccess
                });
            });
            function afterSuccess(){

            }
        </script>
    <?php
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function contraceptive(){
        return View::make("report.contraceptive.index");
    }

    public function process(){
        Patient::where('id','!=','0');
        if(Input::get("region") == "all"){

        }else{

        }
        dd(Input::all());
    }

    public function displayBarChart(){
        ?>
        <script type="text/javascript">
            $(function () {
                $('#chartarea').highcharts({
            chart: {
                    type: 'column'
            },
            title: {
                    text: 'Monthly Average Rainfall'
            },
            subtitle: {
                    text: 'Source: WorldClimate.com'
            },
            xAxis: {
                    categories: [
                        'Jan',
                        'Source: WorldClimate.com',
                        'Mar',
                        'Apr',
                        'May',
                        'Jun',
                        'Jul',
                        'Aug',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec'
                    ]
            },
            yAxis: {
                    min: 0,
                title: {
                        text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                    column: {
                        pointPadding: 0.2,
                    borderWidth: 0
                }
                },
            series: [{
                    name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

            }, {
                    name: 'New York',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

            }, {
                    name: 'London',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

            }, {
                    name: 'Berlin',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

            }]
        });
    });


		</script>
        <?php
    }

}