
    <div class="panel panel-default">
        <div class="panel-body">

            <div class='form-group'>
                <div class='col-sm-4'>
                    Have you ever tested for HIV?<br>{{ Form::select('hiv_test_status',array('No'=>'No','Yes'=>'Yes'),'',array('class'=>'form-control','required'=>'requiered')) }}
                </div>
                <div class='col-sm-4'>
                    <span id="hiv_status">HIV test result<br>{{ Form::select('hiv_status',array('Negative'=>'Negative','Positive'=>'Positive'),'',array('class'=>'form-control','required'=>'requiered')) }}</span>
                </div>
                <div class='col-sm-4'>
                    <span id="last_test">Last Test Done In<br> {{ Form::select('last_test',array("last 3 months"=>"last 3 months","last 6 months"=>"last 6 months","last 1 year"=>"last 1 year","over one year ago"=>"over one year ago"),'',array('class'=>'form-control')) }}</span>
                </div>

            </div>

            <div class='form-group' id="positive">
                <div class='col-sm-4'>
                    how many years since first diagnosis <br> {{ Form::select('year_since_diagnosis',array_combine(range(0,90), range(0,90)),'',array('class'=>'form-control')) }}
                </div>
                <div class='col-sm-4'>
                    Is the client on ART? <br> {{ Form::select('art_status',array('no'=>'No','yes'=>'Yes'),'',array('class'=>'form-control','required'=>'requiered')) }}
                </div>
                <div class='col-sm-4'>
                    Latest CD4 count(cells/mm3) (within last 6 months) <br> {{ Form::select('prev_cd4',array('unknown'=>'unknown')+array_combine(range(0,1500), range(0,1500)),'500',array('class'=>'form-control')) }}
                </div>
            </div>

            <div class='form-group' id="negative">

                <div class='col-sm-4'>
                    Patient test again<br>{{ Form::select('test_again',array('no'=>'No','yes'=>'Yes'),'',array('class'=>'form-control')) }}
                </div>
                <div class='col-sm-4'>
                    <span id="current_test_result">current test results<br>{{ Form::select('current_test_result',array('Negative'=>'Negative','Positive'=>'Positive'),'',array('class'=>'form-control')) }}</span>
                </div>
                <div class='col-sm-2'>
                    <span id="current_cd4">current CD4 (cells/mm3)<br>{{ Form::select('current_cd4',array('unknown'=>'unknown')+array_combine(range(0,1500), range(0,1500)),'500',array('class'=>'form-control')) }} </span>
                </div>
                <div class='col-sm-2'>
                    <span id="current_art">ART offered <br>{{ Form::select('current_art_status',array('no'=>'No','yes'=>'Yes'),'',array('class'=>'form-control','required'=>'requiered')) }} </span>
                </div>
                <div class='col-sm-4' id="hivstat">
                    <span >Reasons for not testing<br> {{ Form::select('unknown_reason',array('Counselling not offered'=>'Counselling not offered','Patient declined test'=>'Patient declined test','Test kits shortage'=>'Test kits shortage','Other'=>'Other'),'',array('class'=>'form-control')) }}</span>
                </div>

            </div>
            <script>
                $(document).ready(function (){

                    var last_test = $("#last_test").html();
                    var hiv_status = $("#hiv_status").html();
                    var hivstat = $("#hivstat").html();
                    var positive = $("#positive").html();
                    var negative = $("#negative").html();
                    var current_cd4 = $("#current_cd4").html();
                    var current_art = $("#current_art").html();
                    var current_test_result = $("#current_test_result").html();
                    $("#positive,#negative,#last_test,#hiv_status").html("");
                    $("#negative").html(negative);
                    $("#current_cd4").html("");
                    $("#current_art").html("");
                    $("#current_test_result").html("");
                    $("select[name=test_again]").change(function(){
                        if($(this).val() == "yes"){
                            $("#hivstat").html("");
                            $("#current_test_result").html(current_test_result)
                            $("select[name=current_test_result]").change(function(){
                                if($(this).val() == "Positive"){
                                    $("#current_cd4").html(current_cd4)
                                    $("#current_art").html(current_art)
                                }else{
                                    $("#current_cd4").html("");
                                    $("#current_art").html("");
                                }
                            });
                        }else{
                            $("#current_cd4").html("");
                            $("#current_test_result").html("");
                            $("#current_art").html("");
                            $("#hivstat").html(hivstat);
                        }
                    });

                    $("select[name=hiv_test_status]").change(function(){
                        if($(this).val() == "Yes"){
                            $("#hiv_status").html(hiv_status)
                            $("#last_test").html(last_test)
                            $("select[name=hiv_status]").change(function(){
                                if($(this).val() == "Negative"){
                                    $("#positive").html("")

                                }else if($(this).val() == "Positive"){
                                    $("#positive").html(positive)


                                }
                            })
                        }else{
                            $("#hiv_status").html("")
                            $("#last_test").html("")
                            $("#positive").html("")
                        }
                    });





                });
            </script>




        </div>
</div>