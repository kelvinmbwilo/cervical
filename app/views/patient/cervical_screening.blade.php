<div class='form-group'>
    <div class='col-sm-6'>
        Have you ever had cervical cancer screening?<br>{{ Form::select('screening_status',array('no'=>'No','yes'=>'Yes'),'',array('class'=>'form-control','required'=>'requiered')) }}
    </div>
    <div class='col-sm-6'>
        <?php $arr = array("Last one year"=>"Last one year","Last two years"=>"Last two years","Last three years"=>"Last three years","Last five years"=>"Last five years","More than five years"=>"More than five years") ?>
        <span id="colporesss">how many years ago?<br>{{ Form::select('last_screen',$arr,'',array('class'=>'form-control')) }}</span>
    </div>
</div>


<script>
    $(document).ready(function (){
        var colporesss = $("#colporesss").html()
        $("#colporesss").html("")
        $("select[name=screening_status]").change(function(){
            if($(this).val() == "yes"){
                $("#colporesss").html(colporesss)
            }else{
                $("#colporesss").html("")
            }
        })
    });
</script>

