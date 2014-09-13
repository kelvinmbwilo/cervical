

<div class='form-group'>

    <div class='col-sm-6'>
        First Name <br>  {{ Form::text('firstname','',array('class'=>'form-control','placeholder'=>'First Name','required'=>'required')) }}
    </div>
    <div class='col-sm-6'>
        Middle Name<br> {{ Form::text('middlename','',array('class'=>'form-control','placeholder'=>'Middle Name')) }}
    </div>
</div>

<div class='form-group'>
    <div class='col-sm-6'>
        Last Name <br> {{ Form::text('lastname','',array('class'=>'form-control','placeholder'=>'Last Name','required'=>'required')) }}
    </div>
    <div class='col-sm-6'>
        Date of Birth <br> {{ Form::text('dob','',array('class'=>'form-control','placeholder'=>'Date of Birth','required'=>'required','id'=>'Birth_Date')) }}
    </div>
</div>

<div class='form-group'>

    <div class='col-sm-6'>
        Region<br>{{ Form::select('region',Region::all()->lists('region','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-6'>
        District<br><span id="district-area">{{ Form::select('district',Region::first()->district()->lists('district','id'),'',array('class'=>'form-control','required'=>'requiered')) }}</span>
    </div>

</div>
<div class='form-group'>
    <div class='col-sm-6'>
        Ward<br>{{ Form::text('ward','',array('class'=>'form-control','placeholder'=>'Ward')) }}
    </div>
    <div class='col-sm-6'>
        Name of Ten Cell Leader <br> {{ Form::text('t_cell_leadr','',array('class'=>'form-control','placeholder'=>'Ten Cell Leader')) }}
    </div>
</div>
<script>
    $(document).ready(function (){
        $("#Birth_Date").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1950:<?php echo date("Y") ?>",
            dateFormat:"yy-mm-dd"
        });

        $("select[name=region]").change(function(){
            $("#district-area").html("<i class='fa fa-spinner fa-spin'></i> Wait... ")
            $.post("<?php echo url('patient/region_check') ?>/"+$(this).val(),function(dat){
                $("#district-area").html(dat);
            })
        })
    });
</script>


