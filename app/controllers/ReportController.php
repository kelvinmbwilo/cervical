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

   public function server_sysnc(){

   }

}