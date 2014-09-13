<?php

class HivController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make("report.hiv");
    }

    public function processQuery($patientquery,$visitquery){

        $quer = parent::processRegion($patientquery,$visitquery,Input::get('region'),"");
        $query = parent::processDistrict($quer[0],$quer[1],Input::get('district'),$quer[2]);
        $query1 = parent::processMarital($query[0],$query[1],Input::get('marital'),$query[2]);
        $query2 = parent::processDaterange($query1[0],$query1[1],$query1[2]);

        return $query2;
    }
    public function makeTable(){
        $title = "";$pat = false;
        $row = array();
        $column = array();
        if(Input::get("show") == "HIV Status"){
            $columntype = array('Unknown'=>'Unknown','Negative'=>'Negative','Positive'=>'Positive');

        }elseif(Input::get("show") == "CD4 Count"){
            $columcd4 = array('0'=>'0-200','200'=>'200-400','400'=>'400-600','600'=>'600-1000','1000'=>'1000-1500');
        }elseif(Input::get("show") == "Test  Results"){
            $columresult = array('yes'=>'Tests','Positive'=>'Positive','Negative'=>'Negative');
        }elseif(Input::get("show") == "Decline Reason"){
            $columreason = array('Counselling not offered'=>'Counselling not offered','Patient declined test'=>'Patient declined test','Test kits shortage'=>'Test kits shortage','Other'=>'Other');
        }
        if(Input::get("vertical") == "Patients"){
            $pat = true;
        }elseif(Input::get("vertical") == "Visits"){
            $vis = true;
        }


        if(Input::get("horizontal") == "Year"){
            $row = array("01"=>"jan","02"=>"feb","03"=>"mar","04"=>"apr","05"=>"may","06"=>"jun","07"=>"jul","08"=>"aug","09"=>"sep","10"=>"oct","11"=>"nov","12"=>"dec");

            foreach($row as $key => $value){
                $from = Input::get('year')."-".$key."-01";
                $to = Input::get('year')."-".$key."-31";
                if(isset($columntype)){
                    foreach($columntype as $key1=>$value1){
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::where('HIV_status',$key1)->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column[$value1][] = $que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::where('status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column[$value1][] = $que->count();
                        }
                    }
                    $title = Input::get('vertical')." ". $query[2]." ".Input::get('year');;
                }elseif(isset($columcd4)){
                    foreach($columcd4 as $key1=>$value1){
                        $arr = explode("-",$value1);
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::whereBetween('cd4_count',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column[$value1][] = $que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::whereBetween('pitc_cd4',array($arr[0],$arr[1]))->get()->lists('visit_id')+ContraceptiveHistory::where('current_status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column[$value1][] = $que->count();
                        }
                    }
                    $title = Input::get('vertical')." ". $query[2]." ".Input::get('year');
                }
                 elseif(isset($columresult)){
                     $count = 0;
                    foreach($columresult as $key1=>$value1){
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                            ($count == 0)?
                                $que = $query[1]->whereIn('id', HivStatus::where('pitc_agreed',"yes")->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                                $que = $query[1]->whereIn('id', HivStatus::where('pitc_result',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                        $count++;
                    }
                    $title = Input::get('vertical')." ". $query[2]." ".Input::get('year');
                }elseif(isset($columreason)){
                    foreach($columreason as $key1=>$value1){
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[1]->whereIn('id', HivStatus::where('unknown_reason',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                    }
                    $title = Input::get('vertical')." ". $query[2]." ".Input::get('year');
                }

            }
        }
        elseif(Input::get("horizontal") == "Years"){
            $row = range(Input::get('start'),Input::get('end'));

            foreach($row as $value){
                $from = $value."-01-01";
                $to = $value."-12-31";
                if(isset($columntype)){
                    foreach($columntype as $key1=>$value1){
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::where('HIV_Status',$key1)->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column[$value1][] = $que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::where('status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column[$value1][] = $que->count();
                        }
                    }
                    $title = Input::get('vertical')." ". $query[2]." ".Input::get('start')." - ".Input::get('end');
                }elseif(isset($columcd4)){
                    foreach($columcd4 as $key1=>$value1){
                        $arr = explode("-",$value1);
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::whereBetween('cd4_count',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column[$value1][] = $que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::where('status',$key1)->get()->lists('visit_id')+ContraceptiveHistory::where('current_status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column[$value1][] = $que->count();
                        }
                    }
                    $title = Input::get('vertical')." ". $query[2]." ".Input::get('start')." ".Input::get('end');
                }elseif(isset($columresult)){
                    $count = 0;
                    foreach($columresult as $key1=>$value1){
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        ($count == 0)?
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_agreed',"yes")->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_result',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                        $count++;
                    }
                    $title = Input::get('vertical')." ". $query[2]." ".Input::get('start')." ".Input::get('end');
                }elseif(isset($columreason)){
                    foreach($columreason as $key1=>$value1){
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[1]->whereIn('id', HivStatus::where('unknown_reason',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                    }
                    $title = Input::get('vertical')." ". $query[2]." ".Input::get('start')." ".Input::get('end');
                }

            }
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            if((parent::maxAge()%Input::get('age')) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%Input::get('age')))+Input::get('age');
            }
            //making a loop for values
            //year iterator
            $k = 0;
            //getting age
            $range = Input::get('age');
            $yeardate = date("Y")+1;
            $yaerdate1 = $yeardate."-01-01";

            //creating title
            $data = array();
            for($i=$range;$i<=$limit;$i+=$range){
                $row[] = $k ." - ". $i;
                //start year
                $time = $k*365*24*3600;
                $today = date("Y-m-d");
                $timerange = strtotime($today) - $time;
                $start  = (date("Y",$timerange)+1)."-01-01";
                //end year
                $time1 = $i*365*24*3600;
                $timerange1 = strtotime($today) - $time1;
                $end = date("Y",$timerange1)."-01-01";
                if(isset($columntype)){
                    foreach($columntype as $key1=>$value1){

                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[0]->whereIn('id', PatientReport::where('HIV_status',$key1)->get()->lists('patient_id')+array('0'))->whereBetween('birth_date',array($end,$start));
                        $column[$value1][] = $que->count();
                    }
                    $title = Input::get('vertical')." Age Range ". $query[2];
                }elseif(isset($columcd4)){
                    foreach($columcd4 as $key1=>$value1){
                        $arr = explode("-",$value1);
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[0]->whereIn('id', PatientReport::whereBetween('cd4_count',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0'))->whereBetween('birth_date',array($end,$start));
                        $column[$value1][] = $que->count();
                    }
                    $title = Input::get('vertical')." Age Range ". $query[2];
                }elseif(isset($columresult)){
                    $count = 0;
                    foreach($columresult as $key1=>$value1){
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        ($count == 0)?
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_agreed',"yes")->get()->lists('visit_id')+array('0'))->whereIn('patient_id',Patient::whereBetween('birth_date',array($end,$start))->get()->lists('id')+array('0')):
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_result',$key1)->get()->lists('visit_id')+array('0'))->whereIn('patient_id',Patient::whereBetween('birth_date',array($end,$start))->get()->lists('id')+array('0'));
                        $column[$value1][] = $que->count();
                        $count++;
                    }
                    $title = Input::get('vertical')." ". $query[2];
                }
                elseif(isset($columreason)){
                    foreach($columreason as $key1=>$value1){
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[1]->whereIn('id', HivStatus::where('unknown_reason',$key1)->get()->lists('visit_id')+array('0'))->whereIn('patient_id',Patient::whereBetween('birth_date',array($end,$start))->get()->lists('id')+array('0'));
                        $column[$value1][] = $que->count();
                    }
                    $title = Input::get('vertical')." ". $query[2];
                }
                $k=$i;
            }
        }


        ?>
        <h4 class="text-center"><?php echo $title ?></h4>
        <table class="table table-responsive table-bordered">
            <tr>
                <th><?php echo Input::get("show") ?></th>
                <?php
                foreach($row as $header){
                    echo "<th>$header</th>";
                }
                ?>
            </tr>
            <?php foreach($column as $keys => $cols){ ?>
                <tr>
                    <td><?php echo $keys ?></td>
                    <?php
                    foreach($cols as $colsval){
                        echo "<td>$colsval</td>";
                    }
                    ?>
                </tr>
            <?php } ?>
        </table>

    <?php

    }

    public function makeBar(){
        $title = "";$pat = false;
        $row = "categories: [";
        $column = "";
        if(Input::get("show") == "HIV Status"){
            $columntype = array('Unknown'=>'Unknown','Negative'=>'Negative','Positive'=>'Positive');

        }elseif(Input::get("show") == "CD4 Count"){
            $columcd4 = array('0'=>'0-200','200'=>'200-400','400'=>'400-600','600'=>'600-1000','1000'=>'1000-1500');
        }elseif(Input::get("show") == "Test  Results"){
            $columresult = array('yes'=>'Tests','Positive'=>'Positive','Negative'=>'Negative');
        }elseif(Input::get("show") == "Decline Reason"){
            $columreason = array('Counselling not offered'=>'Counselling not offered','Patient declined test'=>'Patient declined test','Test kits shortage'=>'Test kits shortage','Other'=>'Other');
        }
        if(Input::get("vertical") == "Patients"){
            $pat = true;
        }elseif(Input::get("vertical") == "Visits"){
            $vis = true;
        }


        if(Input::get("horizontal") == "Year"){
            $row1 = array("01"=>"jan","02"=>"feb","03"=>"mar","04"=>"apr","05"=>"may","06"=>"jun","07"=>"jul","08"=>"aug","09"=>"sep","10"=>"oct","11"=>"nov","12"=>"dec");
            $j = 1;
            foreach($row1 as $value){
                $row .= ($j < count($row1))?"'".$value."',":"'".$value."'";
                $j++;
            }
            $col = 1;
            if(isset($columntype)){
                foreach($columntype as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::where('HIV_status',$key1)->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::where('status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
                $title = Input::get('vertical')." ". $query[2]." ".Input::get('Year');
            }elseif(isset($columcd4)){
                foreach($columcd4 as $key1=>$value1){
                    $arr = explode("-",$value1);
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::whereBetween('cd4_count',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::whereBetween('pitc_cd4',array($arr[0],$arr[1]))->get()->lists('visit_id')+ContraceptiveHistory::where('current_status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }
                        $i++;
                    }
                    $column .= ($col < count($columcd4))?"]},":"]}";
                    $col++;
                }
            }elseif(isset($columresult)){
                $count = 0;
                foreach($columresult as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        ($count == 0)?
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_agreed',"yes")->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_result',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column.= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                  }
                    $count++;
                    $column .= ($col < count($columresult))?"]},":"]}";
                    $col++;
                }


                $title = Input::get('vertical')." ". $query[2]." ".Input::get('Year');
            }

            elseif(isset($columreason)){
                foreach($columreason as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[1]->whereIn('id', HivStatus::where('unknown_reason',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column.= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columreason))?"]},":"]}";
                    $col++;
                }


                $title = Input::get('vertical')." ". $query[2]." ".Input::get('Year');
            }

        }
        elseif(Input::get("horizontal") == "Years"){
            $row1 = range(Input::get('start'),Input::get('end'));
            $j = 1;
            foreach($row1 as $value){
                $row .= ($j < count($row1))?"'".$value."',":"'".$value."'";
                $j++;
            }
            $col = 1;
            if(isset($columntype)){
                foreach($columntype as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::where('HIV_status',$key1)->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::where('status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(isset($columcd4)){
                foreach($columcd4 as $key1=>$value1){
                    $arr = explode("-",$value1);
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::whereBetween('cd4_count',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::whereBetween('pitc_cd4',array($arr[0],$arr[1]))->get()->lists('visit_id')+ContraceptiveHistory::where('current_status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }
                        $i++;
                    }
                    $column .= ($col < count($columcd4))?"]},":"]}";
                    $col++;
                }
            }elseif(isset($columresult)){
                $count = 0;
                foreach($columresult as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        ($count == 0)?
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_agreed',"yes")->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_result',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column.= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $count++;
                    $column .= ($col < count($columresult))?"]},":"]}";
                    $col++;
                }

            }elseif(isset($columreason)){
                $count = 0;
                foreach($columreason as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[1]->whereIn('id', HivStatus::where('unknown_reason',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column.= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $count++;
                    $column .= ($col < count($columreason))?"]},":"]}";
                    $col++;
                }

            }
            $title = Input::get('vertical')." ". $query[2]." ".Input::get('Year');
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            if((parent::maxAge()%Input::get('age')) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%Input::get('age')))+Input::get('age');
            }
            //making a loop for values
            //year iterator
            $k = 0;
            //getting age
            $range = Input::get('age');
            $yeardate = date("Y")+1;
            $yaerdate1 = $yeardate."-01-01";

            //creating title
            $j = 1;
            for($i=$range;$i<=$limit;$i+=$range){
                $row .= ($i < $limit)?"'".$k ." - ". $i."',":"'".$k ." - ". $i."'";
                $k=$i;
            }
            $col = 1;
            if(isset($columntype)){
                foreach($columntype as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[0]->whereIn('id', PatientReport::where('HIV_status',$key1)->get()->lists('patient_id')+array('0'))->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(isset($columcd4)){
                foreach($columcd4 as $key1=>$value1){
                    $arr = explode("-",$value1);
                    $column.= "{ name: '".$value1."', data: [ ";

                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[0]->whereIn('id', PatientReport::whereBetween('cd4_count',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0'))->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columcd4))?"]},":"]}";
                    $col++;
                }
            }elseif(isset($columresult)){
                $count = 0;
                foreach($columresult as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        ($count == 0)?
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_agreed',"yes")->get()->lists('visit_id')+array('0'))->whereIn('patient_id',Patient::whereBetween('birth_date',array($end,$start))->get()->lists('id')+array('0')):
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_result',$key1)->get()->lists('visit_id')+array('0'))->whereIn('patient_id',Patient::whereBetween('birth_date',array($end,$start))->get()->lists('id')+array('0'));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $count++;
                    $column .= ($col < count($columresult))?"]},":"]}";
                    $col++;
                }

            }
            elseif(isset($columreason)){
                foreach($columreason as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[1]->whereIn('id', HivStatus::where('unknown_reason',$key1)->get()->lists('visit_id')+array('0'))->whereIn('patient_id',Patient::whereBetween('birth_date',array($end,$start))->get()->lists('id')+array('0'));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columreason))?"]},":"]}";
                    $col++;
                }

            }

            $title = Input::get('vertical')." Age Range ". $query[2]." ";

        }

        $row .= "]";
        ?>
        <script type="text/javascript">
            $(function () {
                $('#chartarea').highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: '<?php echo $title ?>'
                    },
                    xAxis: {
                        <?php echo $row  ?>
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: '<?php echo Input::get('vertical') ?>'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:12px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0"> {series.name} :   </td> ' +
                            '<td style="padding:0"><b>{point.y}  </b></td></tr>',
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
                    series: [<?php echo $column ?>]
                });
            });


        </script>
    <?php

    }

    public function makeLine(){
        $title = "";$pat = false;
        $row = "categories: [";
        $column = "";
        if(Input::get("show") == "HIV Status"){
            $columntype = array('Unknown'=>'Unknown','Negative'=>'Negative','Positive'=>'Positive');

        }elseif(Input::get("show") == "CD4 Count"){
            $columcd4 = array('0'=>'0-200','200'=>'200-400','400'=>'400-600','600'=>'600-1000','1000'=>'1000-1500');
        }
        if(Input::get("vertical") == "Patients"){
            $pat = true;
        }elseif(Input::get("show") == "Test  Results"){
            $columresult = array('yes'=>'Tests','Positive'=>'Positive','Negative'=>'Negative');
        }elseif(Input::get("show") == "Decline Reason"){
            $columreason = array('Counselling not offered'=>'Counselling not offered','Patient declined test'=>'Patient declined test','Test kits shortage'=>'Test kits shortage','Other'=>'Other');
        }
        elseif(Input::get("vertical") == "Visits"){
            $vis = true;
        }


        if(Input::get("horizontal") == "Year"){
            $row1 = array("01"=>"jan","02"=>"feb","03"=>"mar","04"=>"apr","05"=>"may","06"=>"jun","07"=>"jul","08"=>"aug","09"=>"sep","10"=>"oct","11"=>"nov","12"=>"dec");
            $j = 1;
            foreach($row1 as $value){
                $row .= ($j < count($row1))?"'".$value."',":"'".$value."'";
                $j++;
            }
            $col = 1;
            if(isset($columntype)){
                foreach($columntype as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::where('HIV_status',$key1)->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::where('status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(isset($columcd4)){
                foreach($columcd4 as $key1=>$value1){
                    $arr = explode("-",$value1);
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::whereBetween('cd4_count',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::whereBetween('pitc_cd4',array($arr[0],$arr[1]))->get()->lists('visit_id')+ContraceptiveHistory::where('current_status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }
                        $i++;
                    }
                    $column .= ($col < count($columcd4))?"]},":"]}";
                    $col++;
                }
            }elseif(isset($columresult)){
                $count = 0;
                foreach($columresult as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        ($count == 0)?
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_agreed',"yes")->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_result',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column.= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $count++;
                    $column .= ($col < count($columresult))?"]},":"]}";
                    $col++;
                }

            }
            elseif(isset($columreason)){
                foreach($columreason as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[1]->whereIn('id', HivStatus::where('unknown_reason',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column.= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columreason))?"]},":"]}";
                    $col++;
                }

            }

            $title = Input::get('vertical')." ". $query[2]." ".Input::get('Year');
        }
        elseif(Input::get("horizontal") == "Years"){
            $row1 = range(Input::get('start'),Input::get('end'));
            $j = 1;
            foreach($row1 as $value){
                $row .= ($j < count($row1))?"'".$value."',":"'".$value."'";
                $j++;
            }
            $col = 1;
            if(isset($columntype)){
                foreach($columntype as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::where('HIV_status',$key1)->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::where('status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(isset($columcd4)){
                foreach($columcd4 as $key1=>$value1){
                    $arr = explode("-",$value1);
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        if($pat){
                            $que = $query[0]->whereIn('id', PatientReport::whereBetween('cd4_count',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }elseif($vis){
                            $que = $query[1]->whereIn('id', HivStatus::whereBetween('pitc_cd4',array($arr[0],$arr[1]))->get()->lists('visit_id')+ContraceptiveHistory::where('current_status',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                            $column .= ($i < count($row1))?$que->count().",":$que->count();
                        }
                        $i++;
                    }
                    $column .= ($col < count($columcd4))?"]},":"]}";
                    $col++;
                }
            }elseif(isset($columresult)){
                $count = 0;
                foreach($columresult as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        ($count == 0)?
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_agreed',"yes")->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to)):
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_result',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column.= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $count++;
                    $column .= ($col < count($columresult))?"]},":"]}";
                    $col++;
                }

            }elseif(isset($columreason)){
                foreach($columreason as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[1]->whereIn('id', HivStatus::where('unknown_reason',$key1)->get()->lists('visit_id')+array('0'))->whereBetween('created_at',array($from,$to));
                        $column.= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columreason))?"]},":"]}";
                    $col++;
                }

            }
            $title = Input::get('vertical')." ". $query[2]." ".Input::get('Year');
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            if((parent::maxAge()%Input::get('age')) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%Input::get('age')))+Input::get('age');
            }
            //making a loop for values
            //year iterator
            $k = 0;
            //getting age
            $range = Input::get('age');
            $yeardate = date("Y")+1;
            $yaerdate1 = $yeardate."-01-01";

            //creating title
            $j = 1;
            for($i=$range;$i<=$limit;$i+=$range){
                $row .= ($i < $limit)?"'".$k ." - ". $i."',":"'".$k ." - ". $i."'";
                $k=$i;
            }
            $col = 1;
            if(isset($columntype)){
                foreach($columntype as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    $i = 1;
                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[0]->whereIn('id', PatientReport::where('HIV_status',$key1)->get()->lists('patient_id')+array('0'))->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }elseif(isset($columcd4)){
                foreach($columcd4 as $key1=>$value1){
                    $arr = explode("-",$value1);
                    $column.= "{ name: '".$value1."', data: [ ";

                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[0]->whereIn('id', PatientReport::whereBetween('cd4_count',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0'))->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columcd4))?"]},":"]}";
                    $col++;
                }
            }elseif(isset($columresult)){
                $count = 0;
                foreach($columresult as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        ($count == 0)?
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_agreed',"yes")->get()->lists('visit_id')+array('0'))->whereIn('patient_id',Patient::whereBetween('birth_date',array($end,$start))->get()->lists('id')+array('0')):
                            $que = $query[1]->whereIn('id', HivStatus::where('pitc_result',$key1)->get()->lists('visit_id')+array('0'))->whereIn('patient_id',Patient::whereBetween('birth_date',array($end,$start))->get()->lists('id')+array('0'));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $count++;
                    $column .= ($col < count($columresult))?"]},":"]}";
                    $col++;
                }

            }elseif(isset($columreason)){
                foreach($columreason as $key1=>$value1){
                    $column.= "{ name: '".$value1."', data: [ ";
                    for($i=$range;$i<=$limit;$i+=$range){
                        //start year
                        $time = $k*365*24*3600;
                        $today = date("Y-m-d");
                        $timerange = strtotime($today) - $time;
                        $start  = (date("Y",$timerange)+1)."-01-01";
                        //end year
                        $time1 = $i*365*24*3600;
                        $timerange1 = strtotime($today) - $time1;
                        $end = date("Y",$timerange1)."-01-01";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $query[1]->whereIn('id', HivStatus::where('unknown_reason',$key1)->get()->lists('visit_id')+array('0'))->whereIn('patient_id',Patient::whereBetween('birth_date',array($end,$start))->get()->lists('id')+array('0'));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columreason))?"]},":"]}";
                    $col++;
                }

            }

            $title = Input::get('vertical')." Age Range ". $query[2]." ";

        }

        $row .= "]";
        ?>
        <script type="text/javascript">
            $(function () {
                $('#chartarea').highcharts({
                    title: {
                        text: '<?php echo $title ?>'
                    },
                    xAxis: {
                        <?php echo $row  ?>
                    },
                    yAxis: {
                        title: {
                            text: '<?php echo Input::get('vertical') ?>'
                        },
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        valueSuffix: '<?php  Input::get('vertical') ?>'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: [<?php echo $column ?>]
                });
            });
        </script>
    <?php

    }
}