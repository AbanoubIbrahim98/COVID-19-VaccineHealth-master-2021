<?php

class VaccineController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        Return View::make("vaccine.index");
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        Return View::make("vaccine.add");
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Vaccine::where("GTIN",Input::get("gtn"))->count() == 0){
            Vaccine::create(array(
                'name'              => Input::get("name"),
                'GTIN'              => Input::get("gtn"),
                'packaging'         => Input::get("pack"),
                'doses_per_vial'    => Input::get("dose"),
                'vials_per_box'     => Input::get("package"),
                'warning_period'    => Input::get("warning"),
                'country_id'        => Input::get("country"),
                'manufacturer'      => Input::get("manufacturer"),
                'type'              => Input::get("type"),
                'wastage'           => Input::get("wastage"),
                'schedule'          => Input::get("schedule"),
            ));
            Logs::create(array(
                "user_id"=>  Auth::user()->id,
                "action"  =>"Add vaccine with GTIN number ".Input::get("gtn")
            ));
        }else{
            return "<h4 class='text-error'>Vaccine with GTIN Number ".Input::get("gtn")." already existed </h4>";
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function lists()
	{
		return View::make("vaccine.list");
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$vaccine = Vaccine::find($id);
        return View::make("vaccine.edit",compact("vaccine"));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $vaccine = Vaccine::find($id);
        $vaccine->name              =Input::get("name");
        $vaccine->GTIN              =Input::get("gtn");
        $vaccine->packaging         =Input::get("pack");
        $vaccine->doses_per_vial    =Input::get("dose");
        $vaccine->vials_per_box     =Input::get("package");
        $vaccine->warning_period    =Input::get("warning");
        $vaccine->country_id        =Input::get("country");
        $vaccine->manufacturer      =Input::get("manufacturer");
        $vaccine->type              =Input::get("type");
        $vaccine->wastage           =Input::get("wastage");
        $vaccine->schedule          =Input::get("schedule");
        $vaccine->save();
        $name = $vaccine->GTIN;

        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Update vaccine with GTIN number ".$name
        ));
        return "<h4 class='text-success'>Vaccine Updated Successfull</h4>";
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $vaccine = Vaccine::find($id);
        $gt = $vaccine->GTIN;
        $vaccine->delete();
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Delete vaccine with GTIN ".$gt
        ));
	}


}
