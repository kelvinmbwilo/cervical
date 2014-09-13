<?php

class DashboardController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make("dashboard.index");
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function setTitle()
	{
		if(Dashboard::all()->count() == 0){
            Dashboard::create(array(
                "title" => Input::get("name")
            ));
        }else{
            $dashboard = Dashboard::first();
            $dashboard->title = Input::get("name");
            $dashboard->save();
        }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function setWelcome()
	{
        if(Dashboard::all()->count() == 0){
            Dashboard::create(array(
                "welcome_note" => Input::get("name")
            ));
        }else{
            $dashboard = Dashboard::first();
            $dashboard->welcome_note = Input::get("name");
            $dashboard->save();
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function setChat()
	{
        if(Dashboard::all()->count() == 0){
            Dashboard::create(array(
                "report" => Input::get("name")
            ));
        }else{
            $dashboard = Dashboard::first();
            $dashboard->report = Input::get("name");
            $dashboard->save();
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}