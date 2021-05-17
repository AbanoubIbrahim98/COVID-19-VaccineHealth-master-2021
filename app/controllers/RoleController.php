<?php

class RoleController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        Return View::make("roles.index");
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        Return View::make("roles.add");
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if(Roles::where("role",Input::get("role"))->count() == 0){
            Roles::create(array(
                'role'      => Input::get("role")
            ));
        }else{
            return "<h4 class='text-error'>Role ".Input::get("role")." already existed </h4>";
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
		//
	}
        /**
        list roles
         */
   public function lists(){
       return View::make("roles.list");
   }
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $role = Roles::find($id);
        return View::make("roles.edit",compact("role"));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $role = Roles::find($id);

        //udating password
        if(Input::has("role")){

                $role->role = Input::get("role");
                $role->save();
                $updatedrole = $role->role;
            }else{}

        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Update role named ".$updatedrole
        ));
        return "<h4 class='text-success'>Role Updated Successfull</h4>";
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $vaccine = Roles::find($id);
        $rol = $vaccine->role;
        $vaccine->delete();
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Delete role with name ".$rol
        ));
	}


}
