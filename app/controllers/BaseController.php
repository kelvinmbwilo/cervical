<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    public function processRegion($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= " From ". Region::find($value)->region. " Region ";
            $patientquery->whereIn('id', PatientReport::where('region',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', PatientInfo::where('region',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }
    public function processDistrict($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= District::find($value)->district. " District ";
            $patientquery->whereIn('id', PatientReport::where('district',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', PatientInfo::where('district',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }
    public function processDaterange($patientquery,$visitquery,$title=""){
        if(Input::get('from') == "" || Input::get('to') == ""){

        }else{
            $title .= " Between ". date("M j, Y",strtotime(Input::get('from'))) ." And ". date("M j, Y",strtotime(Input::get('to')));
            $patientquery->whereBetween('created_at',array(Input::get('from'), Input::get('to')));
            $visitquery->whereBetween('created_at',array(Input::get('from'), Input::get('to')));
        }
        return array($patientquery,$visitquery,$title);
    }
    public function processMarital($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= $value;
            $patientquery->whereIn('id', PatientReport::where('marital_status',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', GynecologicalHistory::where('marital_status',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }

    public function processHivStatus($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= " With ".$value." HIV Status";
            $patientquery->whereIn('id', PatientReport::where('HIV_status',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', HivStatus::where('status',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }

    public function processHivTest($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $patientquery->whereIn('id', HivStatus::where('pitc_offered',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', HivStatus::where('pitc_offered',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }
    public function processHivTestResult($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= " Found With ".$value." HIV Status";
            $patientquery->whereIn('id', HivStatus::where('pitc_result',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', HivStatus::where('pitc_result',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }
    public function processHivDeclineTest($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= " Who Test Was Not Offered Becuase ".$value;
            $patientquery->whereIn('id', HivStatus::where('unknown_reason',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', HivStatus::where('unknown_reason',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }
    public function processHivArtStatus($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= ($value == "yes")?" Using ART ":" Not Using ART ";
            $patientquery->whereIn('id', HivStatus::where('art_status',$value)->get()->lists('patient_id')+HivStatus::where('current_art_status',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', HivStatus::where('art_status',$value)->get()->lists('visit_id')+HivStatus::where('current_art_status',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }
    public function processHivCd4Count($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $arr = explode("-",$value);
            $title .= " With Cd4 Between ".$arr[0]." And ".$arr[1];
            $patientquery->whereIn('id', HivStatus::where('unknown_reason',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', HivStatus::where('unknown_reason',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }

    public function processContraceptiveStatus($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= ($value == "yes")?" Using Contraceptive ":" Not Using Contraceptive ";
            $patientquery->whereIn('id', PatientReport::where('contraceptive_status',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', ContraceptiveHistory::where('current_status',$value)->get()->lists('visit_id')+ContraceptiveHistory::where('previous_status',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }
    public function processContraceptiveResult($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= " Using ".$value ." Contraceptive ";
            $patientquery->whereIn('id', PatientReport::where('contraceptive_status',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', ContraceptiveHistory::where('current_status',$value)->get()->lists('visit_id')+ContraceptiveHistory::where('previous_status',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }

    public function processViaCounseling($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= ($value == "yes")?" Received VIA Counseling ":" Not Received VIA Counseling  ";
            $patientquery->whereIn('id', ViaStatus::where('via_counselling_status',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', ViaStatus::where('via_counselling_status',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }
    public function processViaTest($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= ($value == "yes")?" Received VIA Test ":" Not Received VIA Test  ";
            $patientquery->whereIn('id', ViaStatus::where('via_test_status',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', ViaStatus::where('via_test_status',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }

    public function processViaTestResult($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= ' With '.$value ;
            $patientquery->whereIn('id', ViaStatus::where('via_result',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', ViaStatus::where('via_result',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }
    public function processViaNoTest($patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $title .= "  Not Received VIA Test Because ".$value;
            $patientquery->whereIn('id', ViaStatus::where('reject_reason',$value)->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', ViaStatus::where('reject_reason',$value)->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }

    public function processGyno($column,$patientquery,$visitquery,$value,$title=""){
        if($value != "all"){
            $arr = explode("-",$value);
            $title .= $column." Between ".$arr[0]. " and ".$arr[1];
            $patientquery->whereIn('id', PatientReport::whereBetween($column,array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0'));
            $visitquery->whereIn('id', GynecologicalHistory::whereBetween($column,array($arr[0],$arr[1]))->get()->lists('visit_id')+array('0'));
        }
        return array($patientquery,$visitquery,$title);
    }




    public function maxAge(){
        $query = Patient::all();
        $datearr = array();
        foreach($query as $patient) {
            $dat = strtotime($patient->birth_date);
            $dat1 = date("Y", $dat);
            $datearr[] = $dat1;
        }
        $len = count($datearr)-1;
        rsort($datearr,SORT_NUMERIC);
        $age  = date("Y")-$datearr[$len];
        return $age;
    }

}

