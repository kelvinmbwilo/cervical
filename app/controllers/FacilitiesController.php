<?php

class FacilitiesController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        Return View::make("facilities.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        Return View::make("facilities.add");
    }

    public function userlist()
    {
        Return View::make("facilities.list");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        $facility = Facility::create(array(
            "facility_name"=>Input::get("firstname"),
            "region"=>Input::get("region"),
            "district"=>Input::get("district")
        ));
        $name = $facility->facility_name;
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Add facility named ".$name
        ));
        return "<h4 class='text-error'>Facility Successful Registered</h4>";

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);
//        return View::make("user.log",  compact("user"));
        return View::make("user.log",compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $facility = Facility::find($id);
        return View::make('facilities.edit',  compact("facility"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $facility = Facility::find($id);
        $facility->facility_name = Input::get("firstname");
        $facility->district = Input::get("district");
        $facility->region = Input::get("region");
        $facility->save();
        $name = $facility->facility_name;
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Update facility named ".$name
        ));
        return "<h4 class='text-success'>Facility Updated Successfull</h4>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $facility = Facility::find($id);
        $name = $facility->facility_name;
        $facility->delete();
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Delete facility named ".$name
        ));
    }

}