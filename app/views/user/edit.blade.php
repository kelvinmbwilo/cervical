
<div class="panel panel-default">
    <div class="panel-body">
        {{ Form::open(array("url"=>url("user/edit/{$user->id}"),"class"=>"form-horizontal","id"=>'FileUploader')) }}
        <h3 class="text-center text-muted">Update User Information</h3>
        <div class='form-group'>

            <div class='col-sm-6'>
                First Name <br>  {{ Form::text('firstname',$user->firstname,array('class'=>'form-control','placeholder'=>'First Name','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Middle Name<br> {{ Form::text('middlename',$user->middlename,array('class'=>'form-control','placeholder'=>'Middle Name')) }}
            </div>
        </div>

        <div class='form-group'>
            <div class='col-sm-6'>
                Last Name <br> {{ Form::text('lastname',$user->lastname,array('class'=>'form-control','placeholder'=>'Last Name','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Email <br> {{ Form::email('email',$user->email,array('class'=>'form-control','placeholder'=>'Email','required'=>'required')) }}
            </div>
        </div>

        <div class='form-group'>

            <div class='col-sm-6'>
                Phone Number<br>{{ Form::text('phone',$user->phone,array('class'=>'form-control','placeholder'=>'Phone Number','required'=>'required')) }}
            </div>
            <div class='col-sm-6'>
                Role<br>{{ Form::select('role',array("admin"=>"Administrator","Region Focal Person"=>"Region Focal Person","District Focal Person"=>"District Focal Person","Hospital Focal Person"=>"Hospital Focal Person"),$user->role,array('class'=>'form-control','required'=>'requiered')) }}
            </div>

        </div>
        <div class='form-group'>
            <div class='col-sm-12' id="regions">
                Region<br>{{ Form::select('region',array(''=>'Select Region') + Region::all()->lists('region','id'),$user->region,array('class'=>'form-control','required'=>'requiered')) }}
            </div>
            <div class='col-sm-12' id="districts">
                District<br>{{ Form::select('district',array(''=>'Select District') + District::all()->lists('district','id'),$user->district,array('class'=>'form-control','required'=>'requiered')) }}
            </div>
            <div class='col-sm-12' id="facilities">
                Facility<br>{{ Form::select('facility',array(''=>'Select Facility') + Facility::all()->lists('facility_name','id'),$user->facility,array('class'=>'form-control','required'=>'requiered')) }}
            </div>

        </div>
       <div class='col-sm-12 form-group text-center'>
            {{ Form::submit('Submit',array('class'=>'btn btn-primary','id'=>'submitqn')) }}
        </div>
        <div id="output"></div>
      {{ Form::close() }}
    </div>
      </div>
<script>
    $(document).ready(function (){
        var region = $('#regions').html();
        var district = $('#districts').html();
        var facility = $('#facilities').html();
        $('#regions,#districts,#facilities').html("");
        if($('select[name=role]').val() == "Region Focal Person"){
            $('#regions').html(region);
        }if($('select[name=role]').val() == "District Focal Person"){
            $('#districts').html(district);
        }if($('select[name=role]').val() == "Hospital Focal Person"){
            $('#facilities').html(facility);
        }
        $('select[name=role]').change(function(){
            if($(this).val() == "Region Focal Person"){
                $('#regions,#districts,#facilities').html("");
                $('#regions').html(region);
            }if($(this).val() == "District Focal Person"){
                $('#regions,#districts,#facilities').html("");
                $('#districts').html(district);
            }if($(this).val() == "Hospital Focal Person"){
                $('#regions,#districts,#facilities').html("");
                $('#facilities').html(facility);
            }
        })

        $('#FileUploader').on('submit', function(e) {
            e.preventDefault();
            $("#output").html("<h3><i class='fa fa-spin fa-spinner '></i><span>Making changes please wait...</span><h3>");
            $(this).ajaxSubmit({
                target: '#output',
                success:  afterSuccess
            });

        });

        function afterSuccess(){
            setTimeout(function() {
                $("#modalDialog").modal("hide");
            }, 3000);
            $("#listuser").load("<?php echo url("user/list") ?>")
        }
    });
</script>


