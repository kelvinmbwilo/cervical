
    <div class="panel panel-default">
        <div class="panel-body">

            <div class='form-group'>

                <div class='col-sm-4'>
                    VIA Counselling done?<br>{{ Form::select('via_counceling',array('no'=>'No','yes'=>'Yes'),'',array('class'=>'form-control')) }}
                </div>
                <div class='col-sm-4'>
                    VIA test done<br>{{ Form::select('via_test',array('no'=>'No','yes'=>'Yes'),'',array('class'=>'form-control')) }}
                </div>
                <div class='col-sm-4' id="via_reason">
                    why (List reasons)<br> {{ Form::select('via_reason',array('SCJ not seen'=>'SCJ not seen','Heavy menses'=>'Heavy menses','Suspicious of cancer'=>'Suspicious of cancer','Massive endocervical discharge (cervicitis)'=>'Massive endocervical discharge (cervicitis)','pregnancy'=>'pregnancy'),'',array('class'=>'form-control')) }}
                </div>
                <div class='col-sm-4' id="viaresult">
                    what is the test results<br> {{ Form::select('via_results',array('Normal cervix (Negative)'=>'Normal cervix (Negative)','Abnormal cervix (Positive)'=>'Abnormal cervix (Positive)'),'',array('class'=>'form-control')) }}
                </div>
            </div>

        <script>
            $(document).ready(function (){
                var viaresult = $("#viaresult").html();
                var via_reason = $("#via_reason").html();
                $("#viaresult").html("");
                $("select[name=via_test]").change(function(){
                    if($(this).val() == "yes"){
                        $("#viaresult").html(viaresult);
                        $("#via_reason").html("");
                    }else{
                        $("#viaresult").html("");
                        $("#via_reason").html(via_reason);

                    }
                })
            });
        </script>



    </div>
</div>
