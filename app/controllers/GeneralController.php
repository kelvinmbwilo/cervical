<?php

class GeneralController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make("report.pap_smear");
    }

    public function processQuery($patientquery,$visitquery){
        $quer   =  parent::processRegion($patientquery,$visitquery,Input::get('region'),"");
        $query  =  parent::processDistrict($quer[0],$quer[1],Input::get('district'),$quer[2]);
        $query1 =  parent::processMarital($query[0], $query[1],Input::get('marital'),$query[2]);
//        $query2 =  parent::processHivStatus($query1[0], $query1[1],Input::get('marital'),$query1[2]);
//        $query3 =  parent::processHivTest($query2[0], $query2[1],Input::get('marital'),$query2[2]);
//        $query4 =  parent::processHivCd4Count($query3[0], $query3[1],Input::get('marital'),$query3[2]);
//        $query5 =  parent::processHivDeclineTest($query4[0], $query4[1],Input::get('marital'),$query4[2]);
//        $query6 =  parent::processHivTestResult($query5[0], $query5[1],Input::get('marital'),$query5[2]);
//        $query7 =  parent::processHivDeclineTest($query6[0], $query6[1],Input::get('marital'),$query6[2]);
//        $query8 =  parent::processMarital($query7[0], $query7[1],Input::get('marital'),$query7[2]);
//        $query9 =  parent::processMarital($query8[0], $query8[1],Input::get('marital'),$query8[2]);
//        $query10 = parent::processMarital($query9[0],$query9[1],Input::get('marital'),$query9[2]);
//        $query11 = parent::processMarital($query10[0],$query10[1],Input::get('marital'),$query10[2]);
//        $query12 = parent::processMarital($query11[0],$query11[1],Input::get('marital'),$query11[2]);
//        $query13 = parent::processMarital($query12[0],$query12[1],Input::get('marital'),$query12[2]);
//        $query14 = parent::processMarital($query13[0],$query13[1],Input::get('marital'),$query13[2]);
//        $query15 = parent::processMarital($query14[0],$query14[1],Input::get('marital'),$query14[2]);
//        $query16 = parent::processMarital($query15[0],$query15[1],Input::get('marital'),$query15[2]);
//        $query17 = parent::processMarital($query16[0],$query16[1],Input::get('marital'),$query16[2]);
//        $query18 = parent::processMarital($query17[0],$query17[1],Input::get('marital'),$query17[2]);
        $query2 = parent::processDaterange($query1[0],$query1[1],$query1[2]);


        return $query2;
    }

    public function generateArray($value){
        if($value == "General"){
            $columntype = array("Patients"=>"Patients");
        }
        if($value == "Marital Status"){
            $columntype = array("Married"=>"Married","Cohabit"=>"Cohabit","Single-never married"=>"Single-never married","Widowed"=>"Widowed","Separated/Divorced"=>"Separated/Divorced");
        }
        if($value == "HIV Status"){
            $columntype = array('Unknown'=>'Unknown','Negative'=>'Negative','Positive'=>'Positive');
        }
        if($value == "CD4 Count"){
            $columntype = array('0-200'=>'0-200','200-400'=>'200-400','400-600'=>'400-600','600-1000'=>'600-1000','1000-1500'=>'1000-1500');
        }
        if($value == "HIV Test  Results"){
            $columntype = array('test'=>'Tests','Positive'=>'Positive','Negative'=>'Negative');
        }
        if($value == "Decline Reason"){
            $columntype = array('Counselling not offered'=>'Counselling not offered','Patient declined test'=>'Patient declined test','Test kits shortage'=>'Test kits shortage','Other'=>'Other');
        }
        if($value == "Pap Smear Findings"){
            $columntype = PapsmearResult::all()->lists('name','id');
        }
        if($value == "Pap Smear Status"){
            $columntype = array('yes'=>'Pap Smear Done','no'=>'Pap Smear Not Done');
        }
        if($value == "Colposcopy Findings"){
            $columntype = ColposcopyResult::all()->lists('name','id');
        }
        if($value == "Colposcopy Status"){
            $columntype = array('yes'=>'Colposcopy Done','no'=>'Colposcopy Not Done');
        }
        if($value == "Contraceptive History"){
            $columntype = array('yes'=>'Using Contraceptive','no'=>'Not Using Contraceptive');
        }
        if($value == "Contraceptive Type"){
            $columntype = ContraceptiveResult::all()->lists('name','id');
        }
        if($value == "Menarche"){
            $columntype = array('8-10'=>'8-10','10-12'=>'10-12','12-14'=>'12-14','14-16'=>'14-16','16-18'=>'18-20','20-30'=>'20-30','30-40'=>'30-40');
        }
        if($value == "Total Number of Pregnancy"){
            $columntype = array('0-2'=>'0-2','4-6'=>'4-6','6-8'=>'6-8','8-10'=>'8-10','10-12'=>'10-12','12-14'=>'12-14','14-16'=>'14-16');
        }
        if($value == "Parity"){
            $columntype = array('0-2'=>'0-2','4-6'=>'4-6','6-8'=>'6-8','8-10'=>'8-10','10-12'=>'10-12','12-14'=>'12-14','14-16'=>'14-16');
        }
        if($value == "Number of sexual partners"){
            $columntype = array('0-2'=>'0-2','4-6'=>'4-6','6-8'=>'6-8','8-10'=>'8-10','10-12'=>'10-12','12-14'=>'12-14','14-16'=>'14-16');
        }
        if($value == "Age At first Marriage"){
            $columntype = array('8-15'=>'8-15','15-20'=>'15-20','20-22'=>'20-22','22-24'=>'22-24','24-26'=>'24-26','26-30'=>'26-30','30-40'=>'30-40','40-50'=>'40-50');
        }
        if($value == "Age At Sexual Debut"){
            $columntype = array('0-8'=>'0-8','8-15'=>'8-15','15-20'=>'15-20','20-22'=>'20-22','22-24'=>'22-24','24-26'=>'24-26','26-30'=>'26-30','30-40'=>'30-40','40-50'=>'40-50');
        }
        return $columntype;
    }
    public function checkCondition($query,$pat,$key1){
        switch(Input::get('show')){
            case "General":
                ($pat)?
                    $que = $query[0]->where('id','!=',$key1):
                    $que = $query[1]->where('id','!=',$key1);
                break;
            case "Marital Status":
                ($pat)?
                    $que = $query[0]->whereIn('id', PatientReport::where('marital_status',$key1)->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', GynecologicalHistory::where('marital_status',$key1)->get()->lists('visit_id')+array('0'));
                break;
            case "HIV Status":
                ($pat)?
                    $que = $query[0]->whereIn('id', PatientReport::where('HIV_status',$key1)->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', HivStatus::where('status',$key1)->get()->lists('visit_id')+array('0'));
                break;
            case "HIV Test  Results":
                if($pat){
                    ($key1 == 'test')?
                        $que = $query[1]->whereIn('id', HivStatus::where('pitc_agreed',"yes")->get()->lists('visit_id')+array('0')):
                        $que = $query[1]->whereIn('id', HivStatus::where('pitc_result',$key1)->get()->lists('visit_id')+array('0'));

                }else{
                    ($key1 == 'test')?
                        $que = $query[1]->whereIn('id', HivStatus::where('pitc_agreed',"yes")->get()->lists('visit_id')+array('0')):
                        $que = $query[1]->whereIn('id', HivStatus::where('pitc_result',$key1)->get()->lists('visit_id')+array('0'));

                }
                break;
            case "CD4 Count":
                $arr = explode("-",$key1);
                ($pat)?
                    $que = $query[0]->whereIn('id', PatientReport::whereBetween('cd4_count',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', HivStatus::whereBetween('pitc_cd4_count',array($arr[0],$arr[1]))->get()->lists('visit_id')+ContraceptiveHistory::where('current_status',$key1)->get()->lists('visit_id')+array('0'));
                break;
            case "Decline Reason":
                ($pat)?
                    $que = $query[0]->whereIn('id', HivStatus::where('unknown_reason',$key1)->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', HivStatus::where('unknown_reason',$key1)->get()->lists('visit_id'));
                break;
            case "Pap Smear Findings":
                ($pat)?
                    $que = $query[0]->whereIn('id', PapsmearStatus::where('result_id',$key1)->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', PapsmearStatus::where('result_id',$key1)->get()->lists('visit_id')+array('0'));
                break;
            case "Pap Smear Status":
                ($pat)?
                    $que = $query[0]->whereIn('id', PapsmearStatus::where('status',$key1)->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', PapsmearStatus::where('status',$key1)->get()->lists('visit_id')+array('0'));
                break;
            case "Colposcopy Findings":
                ($pat)?
                    $que = $query[0]->whereIn('id', ColposcopyStatus::where('result_id',$key1)->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', ColposcopyStatus::where('result_id',$key1)->get()->lists('visit_id')+array('0'));
                break;
            case "Colposcopy Status":
                ($pat)?
                    $que = $query[0]->whereIn('id', ColposcopyStatus::where('status',$key1)->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', ColposcopyStatus::where('status',$key1)->get()->lists('visit_id')+array('0'));
                break;
            case "Contraceptive History":
                ($pat)?
                    $que = $query[0]->whereIn('id', ContraceptiveHistory::where('previous_status',$key1)->get()->lists('patient_id')+ContraceptiveHistory::where('current_status',$key1)->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', ContraceptiveHistory::where('previous_status',$key1)->get()->lists('visit_id')+ContraceptiveHistory::where('current_status',$key1)->get()->lists('visit_id')+array('0'));
                break;
            case "Contraceptive Type":
                ($pat)?
                    $que = $query[0]->whereIn('id', ContraceptiveHistory::where('previous_contraceptive_id',$key1)->get()->lists('patient_id')+ContraceptiveHistory::where('current_contraceptive_id',$key1)->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', ContraceptiveHistory::where('previous_contraceptive_id',$key1)->get()->lists('visit_id')+ContraceptiveHistory::where('current_contraceptive_id',$key1)->get()->lists('visit_id')+array('0'));
                break;
            case "Menarche":
                $arr = explode("-",$key1);
                ($pat)?
                    $que = $query[0]->whereIn('id', PatientReport::whereBetween('menarche',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', GynecologicalHistory::whereBetween('menarche',array($arr[0],$arr[1]))->get()->lists('visit_id')+array('0'));
                break;
            case "Total Number of Pregnancy":
                $arr = explode("-",$key1);
                ($pat)?
                    $que = $query[0]->whereIn('id', PatientReport::whereBetween('number_of_pregnancy',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', GynecologicalHistory::whereBetween('number_of_pregnancy',array($arr[0],$arr[1]))->get()->lists('visit_id')+array('0'));
                break;
            case "Parity":
                $arr = explode("-",$key1);
                ($pat)?
                    $que = $query[0]->whereIn('id', PatientReport::whereBetween('parity',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', GynecologicalHistory::whereBetween('parity',array($arr[0],$arr[1]))->get()->lists('visit_id')+array('0'));
                break;
            case "Age At first Marriage":
                $arr = explode("-",$key1);
                ($pat)?
                    $que = $query[0]->whereIn('id', PatientReport::whereBetween('first_marriage',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', GynecologicalHistory::whereBetween('age_at_first_marriage',array($arr[0],$arr[1]))->get()->lists('visit_id')+array('0'));
                break;
            case "Number of sexual partners":
                $arr = explode("-",$key1);
                ($pat)?
                    $que = $query[0]->whereIn('id', PatientReport::whereBetween('partners',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', GynecologicalHistory::whereBetween('sexual_partner',array($arr[0],$arr[1]))->get()->lists('visit_id')+array('0'));
                break;
            case "Age At Sexual Debut":
                $arr = explode("-",$key1);
                ($pat)?
                    $que = $query[0]->whereIn('id', PatientReport::whereBetween('age_at_sexual_debut',array($arr[0],$arr[1]))->get()->lists('patient_id')+array('0')):
                    $que = $query[1]->whereIn('id', GynecologicalHistory::whereBetween('age_at_sexual_debut',array($arr[0],$arr[1]))->get()->lists('visit_id')+array('0'));
                break;

        }
        return $que;
    }

    public function makeTable(){
        $title = (Input::get('show')=="General")?Input::get('vertical'):Input::get('vertical')." ".Input::get('show')." ";
        $pat = false;
        $row = array();
        $column = array();
        $columntype = $this->generateArray(Input::get("show"));

        if(Input::get("vertical") == "Patients"){
            $pat = true;
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                    }

                }
            }
            $title .=" ". $query[2]." ".Input::get('year');
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                    }
                }
            }
            $title .=" ". $query[2]." ".Input::get('start')." - ".Input::get('end');

        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            $agetouse = (Input::get('age')==0)?3:Input::get('age');
            if((parent::maxAge()%$agetouse) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%$agetouse))+$agetouse;
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
                        $que = $this->checkCondition($query,true,$key1)->whereBetween('birth_date',array($end,$start));
                        $column[$value1][] = $que->count();
                    }
                }
                $k=$i;
            }
            $title .=" Age Range ". $query[2];

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
        $title = (Input::get('show')=="General")?Input::get('vertical'):Input::get('vertical')." ".Input::get('show')." ";
        $pat = false;
        $row = "categories: [";
        $column = "";
        $columntype = $this->generateArray(Input::get("show"));
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title .=" ". $query[2]." ".Input::get('Year');
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title .=" ". $query[2]." ".Input::get('Year');
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            $agetouse = (Input::get('age')==0)?3:Input::get('age');
            if((parent::maxAge()%$agetouse) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%$agetouse))+$agetouse;
            }
            //making a loop for values
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
                        $que = $this->checkCondition($query,true,$key1)->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }

            $title .=" Age Range ". $query[2]." ";

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

    public function makeColumn(){
        $title = (Input::get('show')=="General")?Input::get('vertical'):Input::get('vertical')." ".Input::get('show')." ";
        $pat = false;
        $row = "categories: [";
        $column = "";
        $columntype = $this->generateArray(Input::get("show"));
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title .=" ". $query[2]." ".Input::get('Year');
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title .=" ". $query[2]." ".Input::get('Year');
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            $agetouse = (Input::get('age')==0)?3:Input::get('age');
            if((parent::maxAge()%$agetouse) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%$agetouse))+$agetouse;
            }
            //making a loop for values
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
                        $que = $this->checkCondition($query,true,$key1)->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }

            $title .=" Age Range ". $query[2]." ";

        }

        $row .= "]";
        ?>
        <script type="text/javascript">
            $(function () {
                $('#chartarea').highcharts({
                    chart: {
                        type: 'bar'
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

    public function makeCombined(){
        $title = (Input::get('show')=="General")?Input::get('vertical'):Input::get('vertical')." ".Input::get('show')." ";
        $pat = false;
        $row = "categories: [";
        $column = "";
        $column1 = "";
        $columntype = $this->generateArray(Input::get("show"));
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
                    $column.= "{type: 'column', name: '".$value1."', data: [ ";
                    $column1.= "{type: 'spline', name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $column1 .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= "]},";
                    $column1 .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title .=" ". $query[2]." ".Input::get('Year');
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
                    $column.= "{type: 'column', name: '".$value1."', data: [ ";
                    $column1.= "{type: 'spline', name: '".$value1."', data: [ ";
                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = $value."-01-01";
                        $to = $value."-12-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $column1 .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= "]},";
                    $column1 .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title .=" ". $query[2]." ".Input::get('Year');
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            $agetouse = (Input::get('age')==0)?3:Input::get('age');
            if((parent::maxAge()%$agetouse) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%$agetouse))+$agetouse;
            }
            //making a loop for values
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
                    $column.= "{type: 'column', name: '".$value1."', data: [ ";
                    $column1.= "{type: 'spline', name: '".$value1."', data: [ ";
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
                        $que = $this->checkCondition($query,true,$key1)->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $column1 .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= "]},";
                    $column1 .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }


            $title .=" Age Range ". $query[2]." ";

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
                    series: [<?php echo $column.$column1 ?>]
                });
            });


        </script>
    <?php

    }

    public function makeLine(){
        $title = (Input::get('show')=="General")?Input::get('vertical'):Input::get('vertical')." ".Input::get('show')." ";
        $pat = false;
        $row = "categories: [";
        $column = "";
        $columntype = $this->generateArray(Input::get("show"));
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title .=" ". $query[2]." ".Input::get('Year');
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title .=" ". $query[2]." ".Input::get('Year');
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            $agetouse = (Input::get('age')==0)?3:Input::get('age');
            if((parent::maxAge()%$agetouse) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%$agetouse))+$agetouse;
            }
            //making a loop for values
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
                        $que = $this->checkCondition($query,true,$key1)->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }

            $title .=" Age Range ". $query[2]." ";

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

    public function makeRecord(){
        $title = (Input::get('show')=="General")?Input::get('vertical'):Input::get('vertical')." ".Input::get('show')." ";
        $pat = false;
        $usequery = "";
        if(Input::get("horizontal") == "Year"){

            $from = Input::get('year')."-01-01";
            $to = Input::get('year')."-12-31";
            $patientquery = DB::table('patient');
            $visitquery   = DB::table('visit');
            $query = $this->processQuery($patientquery,$visitquery);
            $title .=" ". $query[2]." ".Input::get('Year');
            $usequery=$query[0]->whereBetween('created_at',array($from,$to))->get();
        }
        elseif(Input::get("horizontal") == "Years"){

            $from = Input::get('start')."-01-01";
            $to = Input::get('end')."-12-31";
            $patientquery = DB::table('patient');
            $visitquery   = DB::table('visit');
            $query = $this->processQuery($patientquery,$visitquery);
            $title .=" ". $query[2]." ".Input::get('Year');
            $usequery=$query[0]->whereBetween('created_at',array($from,$to))->get();
        }
        elseif(Input::get("horizontal") == "Age Range"){

            $patientquery = DB::table('patient');
            $visitquery   = DB::table('visit');
            $query = $this->processQuery($patientquery,$visitquery);
            $usequery=$query[0]->get();
            $title .=" Age Range ". $query[2]." ";

        }
        ?>
        <div class="tile-body color blue rounded-corners">
     <h4><?php echo $title ?></h4>
    <div class="table-responsive">
        <table  class="table table-datatable table-custom" id="advancedDataTable">
            <thead>
            <tr>
                <th> # </th>
                <th> Hosptal_id </th>
                <th> Name       </th>
                <th> Age        </th>
                <th> Region     </th>
                <th> District   </th>
                <th> Facility   </th>
                <th> HIV Status   </th>
                <th> Marital Status   </th>
                <th> Contraceptive Status   </th>
                <th> Last Visit </th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1;
            if(count($usequery) > 1){
            foreach($usequery as $us){
                $patient = Patient::find($us->id);
              ?>
            <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $us->hospital_id ?></td>
                <td style="text-transform: capitalize"><?php echo $us->first_name ?> <?php echo $us->middle_name ?> <?php echo $us->last_name ?></td>
                <td><?php echo date('Y')-date('Y',strtotime($us->birth_date)) ?> Yrs</td>
                <td><?php echo $patient->report->regions->region;  ?></td>
                <td><?php echo $patient->report->districts->district ?></td>
                <td><?php echo Facility::find($us->facility_id)->facility_name ?></td>
                <td><?php echo $patient->report->HIV_status ?></td>
                <td><?php echo $patient->report->marital_status ?></td>
                <td><?php echo $patient->report->contraceptive_status ?></td>
                <td><?php echo date('j M Y',strtotime($patient->visit()->orderBy('created_at','DESC')->first()->visit_date)) ?></td>
            </tr>
           <?php }
            }?>

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

<?php


    }
    public function makePie(){
        $title = (Input::get('show')=="General")?Input::get('vertical'):Input::get('vertical')." ".Input::get('show')." ";
        $pat = false;
        $row = "categories: [";
        $column = "";
        $columntype = $this->generateArray(Input::get("show"));
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
                $column.= "{ type:'pie' name: 'Patients', data: [ ";
                foreach($columntype as $key1=>$value1){

                    $i = 1;
                    foreach($row1 as $key => $value){
                        $from = Input::get('year')."-".$key."-01";
                        $to = Input::get('year')."-".$key."-31";
                        $patientquery = DB::table('patient');
                        $visitquery   = DB::table('visit');
                        $query = $this->processQuery($patientquery,$visitquery);
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?"['".$value."',".$que->count()."],":"['".$value."',".$que->count()."]";
                        $i++;
                    }

                    $col++;
                }
                $column .= "]}";
            }
            $title .=" ". $query[2]." ".Input::get('Year');
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }
            $title .=" ". $query[2]." ".Input::get('Year');
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            $agetouse = (Input::get('age')==0)?3:Input::get('age');
            if((parent::maxAge()%$agetouse) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%$agetouse))+$agetouse;
            }
            //making a loop for values
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
                        $que = $this->checkCondition($query,true,$key1)->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
                    $col++;
                }
            }

            $title .=" Age Range ". $query[2]." ";

        }

        $row .= "]";
        ?>
        <script type="text/javascript">
            $(function () {
                $('#chartarea').highcharts({
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        }
                    },
                    title: {
                        text: 'Browser market shares at a specific website, 2014'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 35,
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}'
                            }
                        }
                    },
                    series: [<?php echo $column ?>]
                });
            });


        </script>
    <?php

    }

    /**
     * a function to export data to excel
     */
    public function excelDownload(){

        if(isset($_POST['records'])){
        /** Include PHPExcel */
        require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        $title = Input::get("vertical");$pat = false;
        $usequery = "";
        if(Input::get("horizontal") == "Year"){

            $from = Input::get('year')."-01-01";
            $to = Input::get('year')."-12-31";
            $patientquery = DB::table('patient');
            $visitquery   = DB::table('visit');
            $query = $this->processQuery($patientquery,$visitquery);
            $title .=" ". $query[2]." ".Input::get('Year');
            $usequery=$query[0]->whereBetween('created_at',array($from,$to))->get();
        }
        elseif(Input::get("horizontal") == "Years"){

            $from = Input::get('start')."-01-01";
            $to = Input::get('end')."-12-31";
            $patientquery = DB::table('patient');
            $visitquery   = DB::table('visit');
            $query = $this->processQuery($patientquery,$visitquery);
            $title .=" ". $query[2]." ".Input::get('Year');
            $usequery=$query[0]->whereBetween('created_at',array($from,$to))->get();
        }
        elseif(Input::get("horizontal") == "Age Range"){

            $patientquery = DB::table('patient');
            $visitquery   = DB::table('visit');
            $query = $this->processQuery($patientquery,$visitquery);
            $usequery=$query[0]->get();
            $title .=" Age Range ". $query[2]." ";

        }
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Cervical Cancer Prevention Program")
            ->setLastModifiedBy(Auth::user()->first_name)
            ->setTitle($title)
            ->setSubject($title)
            ->setDescription("Cervical Cancer Prevention Program Reports")
            ->setKeywords("cancer cecap openxml php")
            ->setCategory("Result file");


        // Tittle
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:I1');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$title);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Name')
            ->setCellValue('B2', 'Age')
            ->setCellValue('C2', 'Region')
            ->setCellValue('D2', 'District')
            ->setCellValue('E2', 'Facility')
            ->setCellValue('F2', 'Marital Status')
            ->setCellValue('G2', 'HIV Status')
            ->setCellValue('H2', 'Contraceptive Status')
            ->setCellValue('I2', 'Last Visit');

        $k  = 3;
        foreach($usequery as $us){
            $patient = Patient::find($us->id);
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A{$k}", $us->first_name." " .  $us->middle_name ." ". $us->last_name  )
                ->setCellValue("B{$k}", date('Y')-date('Y',strtotime($us->birth_date)))
                ->setCellValue("C{$k}", $patient->report->regions->region)
                ->setCellValue("D{$k}", $patient->report->districts->district)
                ->setCellValue("E{$k}", Facility::find($us->facility_id)->facility_name)
                ->setCellValue("F{$k}", $patient->report->marital_status)
                ->setCellValue("G{$k}", $patient->report->HIV_status)
                ->setCellValue("H{$k}", $patient->report->contraceptive_status)
                ->setCellValue("I{$k}", date('j M Y',strtotime($patient->visit()->orderBy('created_at','DESC')->first()->visit_date)));
            $k++;
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle("Cervical Cancer Patient Report");


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="records.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
        }elseif(isset($_POST['reports'])){
                /** Include PHPExcel */
                require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

                // Create new PHPExcel object
                $objPHPExcel = new PHPExcel();
                $title = Input::get("vertical");$pat = false;
                $row = array();
                $column = array();
                $columntype = $this->generateArray(Input::get("show"));

                if(Input::get("vertical") == "Patients"){
                    $pat = true;
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
                                $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                                $column[$value1][] = $que->count();
                            }

                        }
                    }$title .=" ". $query[2]." ".Input::get('year');
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
                                $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                                $column[$value1][] = $que->count();
                            }

                        }
                    }$title .=" ". $query[2]." ".Input::get('start')." - ".Input::get('end');
                }
                elseif(Input::get("horizontal") == "Age Range"){
                    //setting the limits
                    $agetouse = (Input::get('age')==0)?3:Input::get('age');
                    if((parent::maxAge()%$agetouse) == 0){
                        $limit = parent::maxAge();
                    } else{
                        $limit = (parent::maxAge()-(parent::maxAge()%$agetouse))+$agetouse;
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
                                $que = $this->checkCondition($query,true,$key1)->whereBetween('birth_date',array($end,$start));
                                $column[$value1][] = $que->count();
                            }

                        }
                        $k=$i;
                    }
                    $title .=" Age Range ". $query[2];
                }

                // Set document properties
                $objPHPExcel->getProperties()->setCreator("Cervical Cancer Prevention Program")
                    ->setLastModifiedBy(Auth::user()->first_name)
                    ->setTitle($title)
                    ->setSubject($title)
                    ->setDescription("Cervical Cancer Prevention Program Reports")
                    ->setKeywords("cancer cecap openxml php")
                    ->setCategory("Result file");




                $latterArr = Array("A","B","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BM","BL","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ");
                $ttlecont = 1;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', Input::get("show"));
                foreach($row as $header){
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("{$latterArr[$ttlecont]}2", $header);
                    $ttlecont++;
                }
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:{$latterArr[$ttlecont-1]}1");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1',$title);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $k=3; $colcount=1;
                foreach($column as $keys => $cols){
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A{$k}", $keys);
                    foreach($cols as $colsval){
                        $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue("{$latterArr[$colcount]}{$k}", $colsval);
                        $colcount++;
                    }
                    $colcount=1;
                    $k++;
                }
                // Rename worksheet
                $objPHPExcel->getActiveSheet()->setTitle("Cervical Cancer Patient Report");


                // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                $objPHPExcel->setActiveSheetIndex(0);


                // Redirect output to a client’s web browser (Excel2007)
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="'.$title.'.xlsx"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');

                // If you're serving to IE over SSL, then the following may be needed
                header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header ('Pragma: public'); // HTTP/1.0

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                $objWriter->save('php://output');
                exit;
        }
    }
/**
     * a function to export data to excel
     */
    public function excelDownload1(){
        /** Include PHPExcel */
        require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        $title = "";$pat = false;
        $row = array();
        $column = array();
        $columntype = $this->generateArray(Input::get("show"));

        if(Input::get("vertical") == "Patients"){
            $pat = true;
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                    }
                    $title .=" ". $query[2]." ".Input::get('year');;
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column[$value1][] = $que->count();
                    }
                    $title .=" ". $query[2]." ".Input::get('start')." - ".Input::get('end');
                }
            }
        }
        elseif(Input::get("horizontal") == "Age Range"){
            //setting the limits
            $agetouse = (Input::get('age')==0)?3:Input::get('age');
            if((parent::maxAge()%$agetouse) == 0){
                $limit = parent::maxAge();
            } else{
                $limit = (parent::maxAge()-(parent::maxAge()%$agetouse))+$agetouse;
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
                        $que = $this->checkCondition($query,true,$key1)->whereBetween('birth_date',array($end,$start));
                        $column[$value1][] = $que->count();
                    }
                    $title .=" Age Range ". $query[2];
                }
                $k=$i;
            }
        }

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Cervical Cancer Prevention Program")
            ->setLastModifiedBy(Auth::user()->first_name)
            ->setTitle($title)
            ->setSubject($title)
            ->setDescription("Cervical Cancer Prevention Program Reports")
            ->setKeywords("cancer cecap openxml php")
            ->setCategory("Result file");


        $latterArr = Array("A","B","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH","BI","BJ","BK","BM","BL","BO","BP","BQ","BR","BS","BT","BU","BV","BW","BX","BY","BZ");
        $ttlecont = 1;
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', Input::get("show"));
        foreach($row as $header){
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("{$latterArr[$ttlecont]}1", $header);
            $ttlecont++;
        }
        $k=2; $colcount=1;
         foreach($column as $keys => $cols){
             $objPHPExcel->setActiveSheetIndex(0)
                 ->setCellValue("A{$k}", $keys);
              foreach($cols as $colsval){
                  $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue("{$latterArr[$colcount]}{$k}", $colsval);
                  $colcount++;
              }
             $colcount=1;
             $k++;
         }
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($title);


        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$title.'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

}