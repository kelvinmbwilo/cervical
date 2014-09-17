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
        $quer = parent::processRegion($patientquery,$visitquery,Input::get('region'),"");
        $query = parent::processDistrict($quer[0],$quer[1],Input::get('district'),$quer[2]);
        $query1 = parent::processMarital($query[0],$query[1],Input::get('marital'),$query[2]);
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
            $columntype = array('0'=>'0-200','200'=>'200-400','400'=>'400-600','600'=>'600-1000','1000'=>'1000-1500');
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
                    $que = $query[1]->whereIn('id', HivStatus::whereBetween('pitc_cd4',array($arr[0],$arr[1]))->get()->lists('visit_id')+ContraceptiveHistory::where('current_status',$key1)->get()->lists('visit_id')+array('0'));
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
                    $title = Input::get('vertical')." ". $query[2]." ".Input::get('year');;
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
                    $title = Input::get('vertical')." ". $query[2]." ".Input::get('start')." - ".Input::get('end');
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('birth_date',array($end,$start));
                        $column[$value1][] = $que->count();
                    }
                    $title = Input::get('vertical')." Age Range ". $query[2];
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
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

    public function makeColumn(){
        $title = "";$pat = false;
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
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
        $title = "";$pat = false;
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $column1 .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= "]},";
                    $column1 .= ($col < count($columntype))?"]},":"]}";
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
        $title = "";$pat = false;
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
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

    public function makePie(){
        $title = "";$pat = false;
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('created_at',array($from,$to));
                        $column .= ($i < count($row1))?$que->count().",":$que->count();
                        $i++;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
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
                        $que = $this->checkCondition($query,$pat,$key1)->whereBetween('birth_date',array($end,$start));
                        $column .= ($i < $limit)?$que->count().",":$que->count();
                        $k=$i;
                    }
                    $column .= ($col < count($columntype))?"]},":"]}";
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

}