<?php

class UserController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        Return View::make("user.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        Return View::make("user.add");
    }

    public function userlist()
    {
        Return View::make("user.list");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(Input::get("password") == Input::get("repassword")){
            $usser = User::where("email",Input::get("email"))->count();
            if($usser != 0){
                return "<h4 class='text-error'>User with ".Input::get("email")." already existed </h4>";
            }else{

                $user = User::create(array(
                    "firstname"=>Input::get("firstname"),
                    "middlename"=>Input::get("middlename"),
                    "lastname"=>Input::get("lastname"),
                    "phone"=>Input::get("phone"),
                    "email"=>Input::get("email"),
                    "role"=>Input::get("role"),
                    "password"=>Input::get("password"),
                    "region"=>(Input::has('region'))?Input::get("region"):0,
                    "district"=>(Input::has('district'))?Input::get("district"):0,
                    "facility"=>(Input::has('facility'))?Input::get("facility"):0,
                    "status"=>"active"
                ));
                $name = $user->firstname." ".$user->middlename." ".$user->lastname;
                Logs::create(array(
                    "user_id"=>  Auth::user()->id,
                    "action"  =>"Add user named ".$name
                ));
                return "<h4 class='text-error'>User Successful Registered</h4>";
            }
        }else{
            return "<h4 class='text-error'>two password do not match</h4>";
        }
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
        $user = User::find($id);
        return View::make('user.edit',  compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::find($id);
        $user->firstname  = Input::get("firstname");
        $user->lastname   = Input::get("lastname");
        $user->middlename = Input::get("middlename");
        $user->email      = Input::get("email");
        $user->phone      = Input::get("phone");
        $user->region     =(Input::has('region'))?Input::get("region"):0;
        $user->district   =(Input::has('district'))?Input::get("district"):0;
        $user->facility   =(Input::has('facility'))?Input::get("facility"):0;
        if(Input::has('role')){
            $user->role  = Input::get("role");
        }
        $user->save();
        $name = $user->firstname." ".$user->middlename." ".$user->lastname;
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Update user named ".$name
        ));
        return "<h4 class='text-success'>User Updated Successfull</h4>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $name = $user->firstname." ".$user->middlename." ".$user->lastname;
        $user->status="deleted";
        $user->save();
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Delete user named ".$name
        ));
    }


    /**
     * authanticate user during login.
     *
     * @return view
     */
    public function validate()
    {

        $user = User::where("email",Input::get('email'))->first();
        if($user && $user->password == Input::get('password')){
            if(Input::get('keep') == "cheked"){
                Auth::login($user,TRUE);
            }else{
                Auth::login($user,FALSE);
            }
            if(Auth::check()){
                Logs::create(array(
                    "user_id"=>  Auth::user()->id,
                    "action"  =>"Logging in"
                ));
                return Redirect::to("home");
            }
        }
        else{
            return View::make("login")->with("error","Incorrect Username or Password");
        }
    }

    /**
     * loging out a user
     *
     * @return view
     */
    public function logout(){
        Auth::logout();
        return Redirect::to("/");
    }

    /**
     * displaying user profile
     *
     * @return view
     */
    public function profile(){
        $user = Auth::user();
        return View::make('user.profile',compact('user'));
    }


}
