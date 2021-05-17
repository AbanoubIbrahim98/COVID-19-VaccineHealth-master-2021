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
            $usser = User::where("username",Input::get("username"))->count();
            if($usser != 0){
                return "<h4 class='text-error'>User with username ".Input::get("username")." already existed Please try another name</h4>";
            }else{
                if(User::where('email',Input::get("email"))->count() == 0){
                $user = User::create(array(
                    "firstname"=>Input::get("firstname"),
                    "username"=>Input::get("username"),
                    "lastname"=>Input::get("lastname"),
                    "phone"=>Input::get("phone"),
                    "email"=>Input::get("email"),
                    "role_id"=>Input::get("role"),
                    "region_id"=>(Input::has('region'))?Input::get("region"):0,
                    "district_id"=>(Input::has('district'))?Input::get("district"):0,
                    "password"=>Hash::make(Input::get("password")),
                    "status"=>"active"
                ));
                $name = $user->firstname." ".$user->lastname;
                Logs::create(array(
                    "user_id"=>  Auth::user()->id,
                    "action"  =>"Add user named ".$name
                ));
                return "<h4 class='text-success'>User Successful Registered</h4>";
            }
                else{
                    return "<h4 class='text-danger'>There is another user using this email, please use other email</h4>";
                }
            }
        }else{
            return "<h4 class='text-danger'>two password do not match</h4>";
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
        if(User::where('email',Input::get("email"))->where('id','!=',$id)->count() == 0){
            $user->firstname = Input::get("firstname");
            $user->lastname = Input::get("lastname");
            $user->username = Input::get("username");
            $user->role_id = Input::get("role");
            $user->email = Input::get("email");
            if(Input::has("region")){
                $user->region_id = Input::get("region");
            }if(Input::has("district")){
                $user->district_id = Input::get("district");
            }
            $user->phone = Input::get("phone");
            $user->save();
            $name = $user->firstname." ".$user->lastname;

            //udating password
            if(Input::has("password")){
                if(Input::get("password")===Input::get("re_enter_password")){
                    $user->password = Hash::make(Input::get("password"));
                    $user->save();
                }else{}
            }
            Logs::create(array(
                "user_id"=>  Auth::user()->id,
                "action"  =>"Update user named ".$name
            ));
            return "<h4 class='text-success'>User Updated Successfull</h4>";
        }else{
            return "<h4 class='text-danger'>Email already exist please use other email</h4>";
        }

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
        $name = $user->firstname." ".$user->lastname;
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
//        $user = User::where("email",Input::get('email'))->first();
        $user = User::where("username",Input::get('email'))->first();
        if($user && Hash::check( Input::get('password'),$user->password)){
            if(Input::get('keep') == "keep"){
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
    manage user profile
    return user profile
    */
    public function profile(){
        $user = Auth::user();
        return View::make("user.profile",compact("user"));
    }

    public function profileInfo(){
        $user = Auth::user();
        return View::make("user.profileInfo",compact("user"));
    }

    public function profileEdit(){
        $user = Auth::user();
        return View::make("user.profileEdit",compact("user"));
    }

    public function check_region($id){
        if($id == "all"){
            return Form::select('district',array('all'=>'all')+District::lists('district','id'),'',array('class'=>'form-control','required'=>'requiered'));

        }else{
            return Form::select('district',Region::find($id)->district()->lists('district','id'),'',array('class'=>'form-control','required'=>'requiered'));
        }
    }

    public function check_region1($id){
        if($id == "all"){
            return Form::select('district',array('all'=>'all')+District::lists('district','id'),'',array('class'=>'form-control','required'=>'requiered'));

        }else{
            return Form::select('district',array('all'=>'all')+Region::find($id)->district()->lists('district','id'),'',array('class'=>'form-control','required'=>'requiered'));
        }
    }
}