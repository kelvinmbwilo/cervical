@extends("layout.report")


@section('title')
Saved Reports
@stop


@section('breadcumbs')
<li>
    <a href="{{ url('home') }}">Dashboard</a>
</li>
<li class="active">Saved Reports</li>

@stop

@section('contents')
<div class="row">
    Display Chart<br>
    <span class="col-sm-9">
        {{ Form::select('chat',array(''=>'Select Report')+Report::all()->lists("name","id"),'',array('class'=>'form-control','required'=>'requiered')) }}
    </span>
</div>
<div class="row" id="chatarea" style="">

</div>
<script>
    $(document).ready(function(){
        $('select[name=chat]').change(function(){
            $('#chatarea').load("<?php echo url('report/saved') ?>/"+$(this).val());
        })
    })
</script>
@stop