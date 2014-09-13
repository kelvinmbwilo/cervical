

<div class='form-group'>
    <div class='col-sm-6'>
        Pap smea done?<br>{{ Form::select('pap_status',array('no'=>'No','yes'=>'Yes'),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-6'>
        <span id="papsmeares">what was the results<br>{{ Form::select('pap_result',PapsmearResult::all()->lists('name','id'),'',array('class'=>'form-control')) }}</span>
    </div>
</div>


<script>
    $(document).ready(function (){
        var papsmeares = $("#papsmeares").html();
        $("#papsmeares").html("")
        $("select[name=pap_status]").change(function(){
            if($(this).val() == "yes"){
                $("#papsmeares").html(papsmeares)
            }else{
                $("#papsmeares").html("")
            }
        })
    });
</script>


