<div class="col-md-6" style="padding-left: 0px;padding-right: 5px">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class='form-group'>

                <div class='col-sm-6'>
                    Ever used any contraceptions<br>{{ Form::select('ever_used_contra',array('no'=>'No','yes'=>'Yes'),'',array('class'=>'form-control','required'=>'requiered')) }}
                </div>
                <div class='col-sm-6'>
                    <span id="prevcontralist">List Them<br>{{ Form::select('ever_contra',ContraceptiveResult::all()->lists('name','id'),'',array('class'=>'form-control','multiple'=>'multiple')) }}</span>
                </div>

            </div>
        </div>
    </div>

</div>
<div class="col-md-6" style="padding-left: 5px;padding-right: 0px">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class='form-group'>

                <div class='col-sm-6'>
                    Currently using contraception?<br>{{ Form::select('current_on_contra',array('no'=>'No','yes'=>'Yes'),'',array('class'=>'form-control','required'=>'requiered')) }}
                </div>
                <div class='col-sm-6'>
                    <span id="currcontralist"> List Them<br>{{ Form::select('current_contra',ContraceptiveResult::all()->lists('name','id'),'',array('class'=>'form-control','multiple'=>'multiple')) }}</span>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function (){
        var currcontralist = $("#currcontralist").html()
        var prevcontralist = $("#prevcontralist").html()
        $("#currcontralist,#prevcontralist").html("")
        $("select[name=current_on_contra]").change(function(){
            if($(this).val() == "yes"){
                $("#currcontralist").html(currcontralist)
            }else{
                $("#currcontralist").html("")
            }
        })

        $("select[name=ever_used_contra]").change(function(){
            if($(this).val() == "yes"){
                $("#prevcontralist").html(prevcontralist)
            }else{
                $("#prevcontralist").html("")
            }
        })
    });
</script>