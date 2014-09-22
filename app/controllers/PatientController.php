<?php

class PatientController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return View::make('patient.list');
	}

    /**
	 * Display a listing of the resource.
	 *
 * @param int $id
	 * @return Response
	 */
	public function facilityPatient($id)
	{
        $patients = Patient::where("facility_id",$id)->get();
		return View::make('patient.list_by_facility',compact('patients','id'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make("patient.index");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
//		dd(Input::all());
        //adding patient basic info
        $patient = Patient::create(array(
            "first_name"    => Input::get("firstname"),
            "middle_name"   => Input::get("middlename"),
            "last_name"     => Input::get("lastname"),
            "birth_date"    => Input::get("dob"),
            "hospital_id"   => Input::get("hosp_no"),
            "phone"         => Input::get("phone"),
            "facility_id"   => Input::get("facility"),
            "server_status"   => "not",
            "uid"           => uniqid(),
        ));

        //adding patient visit info
        $visit = Visit::create(array(
            "patient_id" => $patient->id,
            "visit_date" => date('Y-m-d'),
            "server_status" => 'not',
            "user" => Auth::user()->firstname ." ".Auth::user()->middlename ." ".Auth::user()->lastname
        ));

        //adding address information
        PatientInfo::create(array(
            "patient_id"        => $patient->id,
            "visit_id"          => $visit->id,
            "hospital_id"       => Input::get("hosp_no"),
            "region"            => Input::get("region"),
            "district"          => Input::get("district"),
            "ward"              => Input::get("ward"),
            "ten_cell_leader"   => Input::get("t_cell_leadr")
        ));

        //adding gynecological history inforamtion for a visit
        GynecologicalHistory::create(array(
            "patient_id"                => $patient->id,
            "visit_id"                  => $visit->id,
            "parity"                    => Input::get("parity"),
            "number_of_pregnancy"       => Input::get("number_of_preg"),
            "menarche"                  => Input::get("menarche"),
            "age_at_sexual_debut"       => Input::get("start_sex_age"),
            "marital_status"            => Input::get("marital"),
            "age_at_first_marriage"     => Input::get("first_marriage"),
            "sexual_partner"            => Input::get("sexual_partner"),
            "partner_sexual_partner"    => Input::get("partner_sexual_partner")

        ));

        //adding contraceptive history
        ContraceptiveHistory::create(array(
            "patient_id"                => $patient->id,
            "visit_id"                  => $visit->id,
            "previous_status"           => Input::get("ever_used_contra"),
            "current_status"            => Input::get("current_on_contra"),
            "previous_contraceptive_id" => (Input::has("ever_contra"))?Input::get("ever_contra"):"",
            "current_contraceptive_id"  => (Input::has("current_contra"))?Input::get("current_contra"):"",
        ));

        //adding HIV status
        HivStatus::create(array(
            "patient_id"                    => $patient->id,
            "visit_id"                      => $visit->id,
            "status"                        =>(Input::has("hiv_status"))?Input::get("hiv_status"):"",
            "test_status"                   =>(Input::has("hiv_test_status"))?Input::get("hiv_test_status"):"",
            "unknown_reason"                =>(Input::has("unknown_reason"))?Input::get("unknown_reason"):"",
            "years_since_first_diagnosis"   =>(Input::has("year_since_diagnosis"))?Input::get("year_since_diagnosis"):"",
            "year_of_last_test"             =>(Input::has("last_test"))?Input::get("last_test"):"",
            "art_status"                    =>(Input::has("art_status"))?Input::get("art_status"):"",
            "current_art_status"            =>(Input::has("current_art_status"))?Input::get("current_art_status"):"",
            "pitc_offered"                  =>(Input::get("test_again") == "yes")?"yes":"no",
            "pitc_agreed"                   =>(Input::has("test_again"))?Input::get("test_again"):"",
            "pitc_result"                   =>(Input::has("current_test_result"))?Input::get("current_test_result"):"",
            "pitc_cd4_count"                =>(Input::has("current_cd4"))?Input::get("current_cd4"):"",
            "prev_cd4_count"                =>(Input::has("prev_cd4"))?Input::get("prev_cd4"):"",
        ));

        //adding VIA Status
        ViaStatus::create(array(
            "patient_id"                => $patient->id,
            "visit_id"                  => $visit->id,
            "via_counselling_status"    => Input::get("via_counceling"),
            "via_test_status"           => Input::get("via_test"),
            "reject_reason"             =>(Input::has("via_reason"))?Input::get("via_reason"):"",
            "via_result"                =>(Input::has("via_results"))?Input::get("via_results"):""
        ));

        //adding colposcopy
        ColposcopyStatus::create(array(
            "patient_id"    => $patient->id,
            "visit_id"      => $visit->id,
            "status"        => Input::get("colposcopy_status"),
            "result_id"     => (Input::has("colpo_result"))?Input::get("colpo_result"):""
        ));

        //adding cervical screening
        CervicalScreening::create(array(
            "patient_id"    => $patient->id,
            "status"        => Input::get("screening_status"),
            "last_test"     => (Input::has("last_screen"))?Input::get("last_screen"):""
        ));

        //adding Pap smear result
        PapsmearStatus::create(array(
            "patient_id"    => $patient->id,
            "visit_id"      => $visit->id,
            "status"        => Input::get("pap_status"),
            "result_id"     => (Input::has("pap_result"))?Input::get("pap_result"):""
        ));

        //adding intervetion status
        Intervention::create(array(
            "patient_id"        => $patient->id,
            "visit_id"          => $visit->id,
            "type_id"           => (Input::has("intervention"))?Input::get("intervention"):"",
            "indicator_id"      => (Input::has("indicator"))?Input::get("indicator"):"",
            "histology_id"      => (Input::has("histology"))?Input::get("histology"):"",
            "cancer_id"         => (Input::has("cancer"))?Input::get("cancer"):"",
            "grade"             => (Input::has("hist_grade"))?Input::get("hist_grade"):"",
            "stages"            => (Input::has("stages"))?Input::get("stages"):"",
            "differentiation"   => (Input::has("differentiation"))?Input::get("differentiation"):""
        ));

        $report = PatientReport::create(array(
            "patient_id"                => $patient->id,
            "bitrh_date"                => Input::get("dob"),
            "region"                    => Input::get("region"),
            "district"                  => Input::get("district"),
            "parity"                    => Input::get("parity"),
            "number_of_pregnancy"       => Input::get("number_of_preg"),
            "menarche"                  => Input::get("menarche"),
            "age_at_sexual_debut"       => Input::get("start_sex_age"),
            "marital_status"            => Input::get("marital"),
            "first_marriage"            => Input::get("first_marriage"),
            "partners"                  => Input::get("sexual_partner"),
            "partners_partner"          => Input::get("partner_sexual_partner"),
            "contraceptive_status"      => Input::get("current_on_contra"),
            "contraceptive_type"        => (Input::has("current_contra"))?Input::get("current_contra"):"",
            "HIV_status"                => (Input::has("hiv_status"))?Input::get("hiv_status"):"",
            "facility_id"               => Input::get("facility"),
        ));
        if(Input::has("current_cd4")){
            $report->cd4_count = Input::get("current_cd4");
        }elseif(Input::has("prev_cd4")){
            $report->cd4_count = Input::has("prev_cd4");
        }
        $report->save();

        if(Input::get("next_visit") != ""){
            Notification::create(array(
                "patient_id"=>$patient->id,
                "message"=>"Kumbuka Kwenda katika kituo ulichopimwa mara ya mwisho saratani ya shingo ya kizazi. Tafadhali fika bila kukosa tarehe  ".Input::get('next_visit'),
                "status"=>"pending",
                "phone_number"=>$patient->phone,
                "next_visit"=>Input::get('next_visit'),
            ));
        }

        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Patient followup for ".$patient->first_name." ".$patient->last_name
        ));
        $msg = "Patient Added Successfull";
        return View::make("patient.index",compact("msg"));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$patient = Patient::find($id);
        return View::make('visit.index',compact('patient'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
		$patient = Patient::find($id);
        foreach($patient->visit() as $visit){
            $visit->delete();
        }foreach($patient->info() as $visit){
            $visit->delete();
        }foreach($patient->via() as $visit){
            $visit->delete();
        }foreach($patient->papsmear() as $visit){
            $visit->delete();
        }foreach($patient->hiv() as $visit){
            $visit->delete();
        }foreach($patient->intervention() as $visit){
            $visit->delete();
        }foreach($patient->contraceptive() as $visit){
            $visit->delete();
        }foreach($patient->gynocology() as $visit){
            $visit->delete();
        }
        $patient->delete();
	}

    public function check_region($id){
        if($id == "all"){
            return Form::select('district',array('all'=>'all')+District::lists('district','id'),'',array('class'=>'form-control','required'=>'requiered'));

        }else{
            return Form::select('district',Region::find($id)->district()->lists('district','id'),'',array('class'=>'form-control','required'=>'requiered'));
        }
    }

    public function check_region1($id){
        if($id == "all"){
            return Form::select('district',array('all'=>'all')+District::lists('district','id'),'',array('class'=>'form-control','required'=>'requiered'));

        }else{
            return Form::select('district',array('all'=>'all')+Region::find($id)->district()->lists('district','id'),'',array('class'=>'form-control','required'=>'requiered'));
        }
    }

    public function followup($id){
        $patient = Patient::find($id);
        return View::make("follow_up.index",compact("patient"));
    }

    public function store_followup($id){
        $patient = Patient::find($id);
        $patient->first_name = Input::get("firstname");
        $patient->middle_name = Input::get("middlename");
        $patient->last_name = Input::get("lastname");
        $patient->birth_date = Input::get("dob");
        $patient->hospital_id = Input::get("hosp_no");
        $patient->phone = Input::get("phone");
        $patient->facility_id = Input::get("facility");
        $patient->save();
        //adding patient visit info
        $visit = Visit::create(array(
            "patient_id" => $patient->id,
            "visit_date" => date('Y-m-d'),
            "server_status" => 'not',
            "user" => Auth::user()->firstname ." ".Auth::user()->middlename ." ".Auth::user()->lastname
        ));

        //adding address information
        PatientInfo::create(array(
            "patient_id"        => $patient->id,
            "visit_id"          => $visit->id,
            "hospital_id"        => "somenumber",
            "region"            => Input::get("region"),
            "district"          => Input::get("district"),
            "ward"              => Input::get("ward"),
            "ten_cell_leader"   => Input::get("t_cell_leadr")
        ));

        //adding gynecological history inforamtion for a visit
        GynecologicalHistory::create(array(
            "patient_id"                => $patient->id,
            "visit_id"                  => $visit->id,
            "parity"                    => Input::get("parity"),
            "number_of_pregnancy"       => Input::get("number_of_preg"),
            "menarche"                  => Input::get("menarche"),
            "age_at_sexual_debut"       => Input::get("start_sex_age"),
            "marital_status"            => Input::get("marital"),
            "age_at_first_marriage"     => Input::get("first_marriage"),
            "sexual_partner"            => Input::get("sexual_partner"),
            "partner_sexual_partner"    => Input::get("partner_sexual_partner")

        ));

        //adding contraceptive history
        ContraceptiveHistory::create(array(
            "patient_id"                => $patient->id,
            "visit_id"                  => $visit->id,
            "current_status"            => Input::get("current_on_contra"),
            "current_contraceptive_id"  => (Input::has("current_contra"))?Input::get("current_contra"):"",
        ));

        //adding HIV status
        HivStatus::create(array(
            "patient_id"                    => $patient->id,
            "visit_id"                      => $visit->id,
            "status"                        =>(Input::has("hiv_status"))?Input::get("hiv_status"):"",
            "test_status"                   =>(Input::has("hiv_test_status"))?Input::get("hiv_test_status"):"",
            "unknown_reason"                =>(Input::has("unknown_reason"))?Input::get("unknown_reason"):"",
            "years_since_first_diagnosis"   =>(Input::has("year_since_diagnosis"))?Input::get("year_since_diagnosis"):"",
            "year_of_last_test"             =>(Input::has("last_test"))?Input::get("last_test"):"",
            "art_status"                    =>(Input::has("art_status"))?Input::get("art_status"):"",
            "current_art_status"            =>(Input::has("current_art_status"))?Input::get("current_art_status"):"",
            "pitc_offered"                  =>(Input::get("test_again") == "yes")?"yes":"no",
            "pitc_agreed"                   =>(Input::has("test_again"))?Input::get("test_again"):"",
            "pitc_result"                   =>(Input::has("current_test_result"))?Input::get("current_test_result"):"",
            "pitc_cd4_count"                =>(Input::has("current_cd4"))?Input::get("current_cd4"):"",
            "prev_cd4_count"                =>(Input::has("prev_cd4"))?Input::get("prev_cd4"):"",
        ));

        //adding VIA Status
        ViaStatus::create(array(
            "patient_id"                => $patient->id,
            "visit_id"                  => $visit->id,
            "via_counselling_status"    => Input::get("via_counceling"),
            "via_test_status"           => Input::get("via_test"),
            "reject_reason"             =>(Input::has("via_reason"))?Input::get("via_reason"):"",
            "via_result"                =>(Input::has("via_results"))?Input::get("via_results"):""
        ));

        //adding colposcopy
        ColposcopyStatus::create(array(
            "patient_id"    => $patient->id,
            "visit_id"      => $visit->id,
            "status"        => Input::get("colposcopy_status"),
            "result_id"     => (Input::has("colpo_result"))?Input::get("colpo_result"):""
        ));

        //adding Pap smear result
        PapsmearStatus::create(array(
            "patient_id"    => $patient->id,
            "visit_id"      => $visit->id,
            "status"        => Input::get("pap_status"),
            "result_id"     => (Input::has("pap_result"))?Input::get("pap_result"):""
        ));

        //adding intervetion status
        Intervention::create(array(
            "patient_id"        => $patient->id,
            "visit_id"          => $visit->id,
            "type_id"           => (Input::has("intervention"))?Input::get("intervention"):"",
            "indicator_id"      => (Input::has("indicator"))?Input::get("indicator"):"",
            "histology_id"      => (Input::has("histology"))?Input::get("histology"):"",
            "cancer_id"         => (Input::has("cancer"))?Input::get("cancer"):"",
            "grade"             => (Input::has("hist_grade"))?Input::get("hist_grade"):"",
            "stages"            => (Input::has("stages"))?Input::get("stages"):"",
            "differentiation"   => (Input::has("differentiation"))?Input::get("differentiation"):""
        ));

        $report = PatientReport::where('patient_id',$patient->id)->first();
        $report->region = Input::get("region");
        $report->district = Input::get("district");
        $report->number_of_pregnancy = Input::get("number_of_preg");
        $report->marital_status = Input::get("marital");
        $report->first_marriage = Input::get("first_marriage");
        $report->partners = Input::get("sexual_partner");
        $report->partners_partner = Input::get("partner_sexual_partner");
        $report->contraceptive_status = Input::get("current_on_contra");
        $report->facility_id = Input::get("facility");
        if(Input::has("current_contra")){
            $report->contraceptive_type = Input::get("current_contra");

        }if(Input::has("hiv_status")){
            $report->HIV_status = Input::get("hiv_status");
        }if(Input::has("current_cd4")){
            $report->cd4_count = Input::get("current_cd4");
        }elseif(Input::has("prev_cd4")){
            $report->cd4_count = Input::has("prev_cd4");
        }
        $report->save();

        if(Input::get("next_visit") != ""){
            Notification::create(array(
                "patient_id"=>$patient->id,
                "message"=>"Kumbuka Kwenda katika kituo ulichopimwa mara ya mwisho saratani ya shingo ya kizazi. Tafadhali fika bila kukosa tarehe  ".Input::get('next_visit'),
                "status"=>"pending",
                "phone_number"=>$patient->phone,
                "next_visit"=>Input::get('next_visit'),
            ));
        }

        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Patient followup for ".$patient->first_name." ".$patient->last_name
        ));
        $msg = "Patient followup stored successfull";
        return View::make('visit.index',compact('patient',"msg"));
    }

    public function sendsms(){

        foreach(Notification::where('status','peding')->get() as $send){

        }
    }
}