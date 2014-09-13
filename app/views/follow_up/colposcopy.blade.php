

<div class='form-group'>
    <div class='col-sm-6'>
        Colposcopy done<br>{{ Form::select('colposcopy_status',array('no'=>'No','yes'=>'Yes'),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-6'>
        <span id="colpores">Findings<br>{{ Form::select('colpo_result',ColposcopyResult::all()->lists('name','id'),'',array('class'=>'form-control')) }}</span>
    </div>
</div>


<script>
    $(document).ready(function (){
        var colpores = $("#colpores").html()
        $("#colpores").html("")
        $("select[name=colposcopy_status]").change(function(){
            if($(this).val() == "yes"){
                $("#colpores").html(colpores)
            }else{
                $("#colpores").html("")
            }
        })
    });
</script>


