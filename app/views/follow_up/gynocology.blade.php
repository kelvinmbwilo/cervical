<?php $gyno = $patient->gynocology()->orderBy('visit_id',"DESC")->first(); ?>
<div class='form-group'>

    <div class='col-sm-6'>
        Parity <br>{{ Form::select('parity',array_combine(range(0,15), range(0,15)),$gyno->parity,array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-6'>
        Total Number of Pregnancy<br> {{ Form::select('number_of_preg',array_combine(range(0,15), range(0,15)),$gyno->number_of_pregnancy,array('class'=>'form-control','required'=>'requiered')) }}
    </div>
</div>

<div class='form-group'>
    <div class='col-sm-6'>
        Menarche (Years) <br> {{ Form::select('menarche',array('Not Applicable'=>'Not Applicable')+array_combine(range(8,40), range(8,40)),$gyno->menarche,array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-6'>
        Age At sexual Debut (years) <br> {{ Form::select('start_sex_age',array_merge(array('Not Applicable'=>'Not Applicable'),array_combine(range(1,100), range(1,100))),$gyno->age_at_sexual_debut,array('class'=>'form-control','required'=>'requiered')) }}
    </div>
</div>

<div class='form-group'>

    <div class='col-sm-6'>
        Marital Status<br>{{ Form::select('marital',array("Married"=>"Married","Cohabit"=>"Cohabit","Single-never married"=>"Single-never married","Widowed"=>"Widowed","Separated/Divorced"=>"Separated/Divorced"),$gyno->marital_status,array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-6'>
        Age At first Marriage<br>{{ Form::select('first_marriage',array('Not Applicable'=>'Not Applicable')+array_combine(range(1,50), range(1,50)),$gyno->age_at_first_marriage,array('class'=>'form-control','required'=>'requiered')) }}
    </div>

</div>
<div class='form-group'>
    <div class='col-sm-6'>
        Number of sexual partners<br>{{ Form::select('sexual_partner',array_combine(range(0,15), range(0,15)),$gyno->sexual_partner,array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-6'>
        Number of your partner's sexual partners<br> {{ Form::select('partner_sexual_partner',array_combine(range(1,15), range(1,15)),$gyno->partner_sexual_partner,array('class'=>'form-control','required'=>'requiered')) }}
    </div>
</div>