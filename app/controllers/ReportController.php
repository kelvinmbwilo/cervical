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

       /**
        * online server connection(mysql)
        */
//       $conn=mysqli_connect("162.243.26.128","root","softmed","cancer") ;
//// Check connection
//       if (mysqli_connect_errno()) {
//           echo "Failed to connect to MySQL: " . mysqli_connect_error();
//       }else{
//           echo "connection successfull";
//       }

//       echo count(ServerPatient::all())."<br>";exit;
       //querying all visit that have not been sent to server
       if(count(Visit::where('server_status',"not")->get()) == 0){
           echo "<h4 class=text-danger>All Visits has been transferred</h4>";
       }else{
           $vis = Visit::where('server_status',"not")->first();

           echo "Moving Visit for ". $vis->patient->first_name." ".$vis->patient->last_name."........";

           if($vis->patient){
               try{
                   $pat = $vis->patient;
                   //check if patient is on server or not, if not synchronize
                   if($pat->server_status == "not"){
                       $patient = ServerPatient::create(array(
                           "first_name"    => $pat->first_name,
                           "middle_name"   => $pat->middle_name,
                           "last_name"     => $pat->last_name,
                           "birth_date"    => $pat->birth_date,
                           "hospital_id"   => $pat->hospital_id,
                           "phone"         => $pat->phone,
                           "facility_id"   => $pat->facility_id,
                           "uid"           => $pat->uid,
                       ));
                       $patient->created_at  = $pat->created_at;
                       $patient->updated_at  = $pat->updated_at;
                       $patient->save();
                       $pat->server_status = 'transferred';
                       $pat->save();
                       $report = ServerPatientReport::create(array(
                           "patient_id"                => $patient->id,
                           "bitrh_date"                => $pat->birth_date,
                           "region"                    => $vis->info->region,
                           "district"                  => $vis->info->district,
                           "parity"                    => $vis->gynecology->parity,
                           "number_of_pregnancy"       => $vis->gynecology->number_of_pregnancy,
                           "menarche"                  => $vis->gynecology->menarche,
                           "age_at_sexual_debut"       => $vis->gynecology->age_at_sexual_debut,
                           "marital_status"            => $vis->gynecology->marital_status,
                           "first_marriage"            => $vis->gynecology->age_at_first_marriage,
                           "partners"                  => $vis->gynecology->sexual_partner,
                           "partners_partner"          => $vis->gynecology->partner_sexual_partner,
                           "contraceptive_status"      => $vis->contraceptive->current_status,
                           "contraceptive_type"        => $vis->contraceptive->current_contraceptive_id,
                           "HIV_status"                => $vis->hiv->status,
                           "facility_id"               => $pat->facility_id,
                       ));
                       $report->cd4_count = $vis->hiv->pitc_cd4_count;
                       $report->cd4_count = $vis->hiv->prev_cd4_count;
                       $report->save();
                   }else{
                       $patient = ServerPatient::where('uid',$pat->uid);
                       $report = ServerPatientReport::where('patient_id',$patient->id)->first();
                       $report->region = $vis->info->region;
                       $report->district = $vis->info->district;
                       $report->number_of_pregnancy = $vis->gynecology->number_of_pregnancy;
                       $report->marital_status = $vis->gynecology->marital_status;
                       $report->first_marriage = $vis->gynecology->age_at_first_marriage;
                       $report->partners = $vis->gynecology->sexual_partner;
                       $report->partners_partner = $vis->gynecology->partner_sexual_partner;
                       $report->contraceptive_status = $vis->contraceptive->current_status;
                       $report->contraceptive_type = $vis->contraceptive->current_contraceptive_id;
                       $report->HIV_status = $vis->hiv->status;
                       $report->cd4_count = $vis->hiv->pitc_cd4_count;
                       $report->cd4_count = $vis->hiv->prev_cd4_count;
                       $report->save();
                   }

                   $visit = ServerVisit::create(array(
                       "patient_id" => $patient->id,
                       "visit_date" => $vis->visit_date,
                       "server_status" => 'derlivered',
                       "user" => $vis->user
                   ));
                   $visit->created_at  = $vis->created_at;
                   $visit->updated_at  = $vis->updated_at;
                   $visit->save();

                   //adding address information
                   $patinfo = ServerPatientInfo::create(array(
                       "patient_id"        => $patient->id,
                       "visit_id"          => $visit->id,
                       "hospital_id"       => $vis->info->hospital_id,
                       "region"            => $vis->info->region,
                       "district"          => $vis->info->district,
                       "ward"              => $vis->info->ward,
                       "ten_cell_leader"   => $vis->info->ten_cell_leader
                   ));
                   $patinfo->created_at = $vis->info->created_at;
                   $patinfo->updated_at = $vis->info->updated_at;
                   $patinfo->save();

                   //adding gynecological history inforamtion for a visit
                   $gyno = ServerGynecologicalHistory::create(array(
                       "patient_id"                => $patient->id,
                       "visit_id"                  => $visit->id,
                       "parity"                    => $vis->gynecology->parity,
                       "number_of_pregnancy"       => $vis->gynecology->number_of_pregnancy,
                       "menarche"                  => $vis->gynecology->menarche,
                       "age_at_sexual_debut"       => $vis->gynecology->age_at_sexual_debut,
                       "marital_status"            => $vis->gynecology->marital_status,
                       "age_at_first_marriage"     => $vis->gynecology->age_at_first_marriage,
                       "sexual_partner"            => $vis->gynecology->sexual_partner,
                       "partner_sexual_partner"    => $vis->gynecology->partner_sexual_partner

                   ));
                   $gyno->created_at = $vis->gynecology->created_at;
                   $gyno->updated_at = $vis->gynecology->updated_at;
                   $gyno->save();

                   //adding contraceptive history
                   $contra = ServerContraceptiveHistory::create(array(
                       "patient_id"                => $patient->id,
                       "visit_id"                  => $visit->id,
                       "previous_status"           => $vis->contraceptive->previous_status,
                       "current_status"            => $vis->contraceptive->current_status,
                       "previous_contraceptive_id" => $vis->contraceptive->previous_contraceptive_id,
                       "current_contraceptive_id"  => $vis->contraceptive->current_contraceptive_id,
                   ));
                   $contra->created_at = $vis->contraceptive->created_at;
                   $contra->updated_at = $vis->contraceptive->updated_at;
                   $contra->save();

                   //adding HIV status
                   $hiv = ServerHivStatus::create(array(
                       "patient_id"                    => $patient->id,
                       "visit_id"                      => $visit->id,
                       "status"                        => $vis->hiv->status,
                       "test_status"                   =>$vis->hiv->test_status,
                       "unknown_reason"                =>$vis->hiv->unknown_reason,
                       "years_since_first_diagnosis"   =>$vis->hiv->years_since_first_diagnosis,
                       "year_of_last_test"             =>$vis->hiv->year_of_last_test,
                       "art_status"                    =>$vis->hiv->art_status,
                       "current_art_status"            =>$vis->hiv->current_art_status,
                       "pitc_offered"                  =>$vis->hiv->pitc_offered,
                       "pitc_agreed"                   =>$vis->hiv->pitc_agreed,
                       "pitc_result"                   =>$vis->hiv->pitc_result,
                       "pitc_cd4_count"                =>$vis->hiv->pitc_cd4_count,
                       "prev_cd4_count"                =>$vis->hiv->prev_cd4_count,
                   ));
                   $hiv->created_at = $vis->hiv->created_at;
                   $hiv->updated_at = $vis->hiv->updated_at;
                   $hiv->save();
                   //adding VIA Status
                   $via = ServerViaStatus::create(array(
                       "patient_id"                => $patient->id,
                       "visit_id"                  => $visit->id,
                       "via_counselling_status"    => $vis->via->via_counselling_status,
                       "via_test_status"           => $vis->via->via_test_status,
                       "reject_reason"             => $vis->via->reject_reason,
                       "via_result"                => $vis->via->via_result
                   ));
                   $via->created_at = $vis->via->created_at;
                   $via->updated_at = $vis->via->updated_at;
                   $via->save();

                   //adding colposcopy
                   $col = ServerColposcopyStatus::create(array(
                       "patient_id"    => $patient->id,
                       "visit_id"      => $visit->id,
                       "status"        => $vis->colposcopy->status,
                       "result_id"     => $vis->colposcopy->result_id
                   ));
                   $col->created_at = $vis->colposcopy->created_at;
                   $col->updated_at = $vis->colposcopy->updated_at;
                   $col->save();

                   //adding Pap smear result
                   $pap = ServerPapsmearStatus::create(array(
                       "patient_id"    => $patient->id,
                       "visit_id"      => $visit->id,
                       "status"        => $vis->papsmea->status,
                       "result_id"     => $vis->papsmea->result_id
                   ));
                   $pap->created_at = $vis->papsmea->created_at;
                   $pap->updated_at = $vis->papsmea->updated_at;
                   $pap->save();

                   //adding intervetion status
                   $interv = ServerIntervention::create(array(
                       "patient_id"        => $patient->id,
                       "visit_id"          => $visit->id,
                       "type_id"           => $vis->intervention->type_id,
                       "indicator_id"      => $vis->intervention->indicator_id,
                       "histology_id"      => $vis->intervention->histology_id,
                       "cancer_id"         => $vis->intervention->cancer_id,
                       "grade"             => $vis->intervention->grade,
                       "stages"            => $vis->intervention->stages,
                       "differentiation"   => $vis->intervention->differentiation
                   ));
                   $interv->created_at = $vis->intervention->created_at;
                   $interv->updated_at = $vis->intervention->updated_at;
                   $interv->save();

                   if($vis->notification){
                       ServerNotification::create(array(
                           "patient_id"=>$patient->id,
                           "message"=>$vis->notification->message,
                           "status"=>$vis->notification->status,
                           "phone_number"=>$vis->notification->phone_number,
                           "next_visit"=>$vis->notification->next_visit,
                       ));
                   }

                   $vis->server_status = "transferred";
                   $vis->save();
                   echo " <span class='text-success'> done.<i class='fa fa-check'></i></span> " .count(Visit::where('server_status','not')->get())." Remaining visit(s) to be transferred<br>";
               }catch (Exception $e){
                   echo $vis->patient->first_name." ".$vis->patient->last_name." not tranfsfered because ". $e->getMessage();
               }

               //send the visit online a bundle

           }
       }

   }

}