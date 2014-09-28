
    <div class="panel panel-default">
        <div class="panel-body">

            <div class='form-group'>

                <div class='col-sm-3'>
                    Intervention done<br>{{ Form::select('intervention',InterventionResult::all()->lists('name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
                </div>
                <div class='col-sm-3'>
                    Reasons for the intervention<br>{{ Form::select('indicator',InterventionIndicators::all()->lists('name','id'),'',array('class'=>'form-control','required'=>'requiered')) }}
                </div>
                <div class='col-sm-3' id="via_reason">
                    Tumor Histological Type<br> {{ Form::select('differentiation',array("none"=>"none","Squomous Cell Carcinoma"=>"Squomous Cell Carcinoma","Adenocarcinoma"=>"Adenocarcinoma","Adenosquoumous carcinoma"=>"Adenosquoumous carcinoma"),'',array('class'=>'form-control','required'=>'requiered')) }}
                </div>
                <div class='col-sm-3' id="">
                    Tumor histology grade<br> {{ Form::select('hist_grade',array("none"=>"none","Highly differentiated"=>"Highly differentiated","Moderately differentiated"=>"Moderately differentiated","Low differentiation"=>"Low differentiation"),'',array('class'=>'form-control','required'=>'requiered')) }}
                </div>

            </div>
            <div class='form-group'>

                <div class='col-sm-6'>
                    <span id="histology">what is the histology results<br>{{ Form::select('histology',HistologyResult::all()->lists('name','id'),'',array('class'=>'form-control')) }}</span>
                </div>
                <div class='col-sm-6'>
                    <span id="cancer">which type of cancer?<br>{{ Form::select('cancer',CancerType::all()->lists('name','id'),'',array('class'=>'form-control')) }}</span>
                </div>
                <div class='col-sm-6'>
                    <span id="stages">Stage of cancer<br>{{ Form::select('stages',array("I"=>"I","IIa"=>"IIa","IIb"=>"IIb","IIIa"=>"IIIa","IIIb"=>"IIIb","IIIc"=>"IIIc","IVa"=>"IVa","IVb"=>"IVb"),'',array('class'=>'form-control')) }}</span>
                </div>

            </div>

        <script>
            $(document).ready(function (){
                var histology = $("#histology").html()
                var cancer = $("#cancer").html()
                var stages = $("#stages").html()
                $("#histology,#cancer,#stages").html("");
                $("select[name=intervention]").change(function(){
                    if($(this).val() == "5" || $(this).val() == "8" || $(this).val() == "6" || $(this).val() == "7" ){
                        $("#histology").html(histology);

                        $("select[name=histology]").change(function(){
                            if($(this).val() == "5"){
                                $("#cancer").html(cancer);
                            }else{
                                $("#cancer").html("");
                            }
                        });
                        $("#cancer").html("");
                        $("#stages").html("");
                    }else if($(this).val() == "10"){
                        $("#histology").html("");
                        $("#cancer").html("");
                        $("#stages").html(stages);
                    }else{
                        $("#histology").html("");
                        $("#cancer").html("");
                        $("#stages").html("");

                    }
                })
            });
        </script>



    </div>
</div>
