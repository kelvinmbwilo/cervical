<a class="dropdown-toggle button" data-toggle="dropdown" href="#">
    <i class="fa fa-bell"></i>
    <span class="label label-transparent-black">{{ count(Notification::where('next_visit',date('Y-m-d'))->get()) }}</span>
</a>

<ul class="dropdown-menu wide arrow nopadding bordered">
    <li><h1>Your expecting <strong>{{ count(Notification::where('next_visit',date('Y-m-d'))->get()) }}</strong> patient today for followup</h1></li>
    @foreach(Notification::where('next_visit',date('Y-m-d'))->get() as $notify)
    <li>
        <a href="#">
            <span class="label label-green"><i class="fa fa-user-md"></i></span>
             {{ Patient::find($notify->patient_id)->first_name }} {{ Patient::find($notify->patient_id)->last_name }}
            <span class="small">Last Visit on {{ date('j M Y',strtotime(Patient::find($notify->patient_id)->visit()->orderBy('created_at','DESC')->first()->visit_date)) }}</span>
        </a>
    </li>
 @endforeach


