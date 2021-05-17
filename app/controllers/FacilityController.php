<?php

class FacilityController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Return View::make("facility.index");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        Return View::make("facility.add");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
            Facility::create(array(
                'district_id'           => Input::get("district"),
                'name'                  => Input::get("name"),
                'contact'               => Input::get("contact"),
                'target_population'     => Input::get("population"),
                'annual_birth'          => Input::get("birth"),
                'surviving_infants'     => Input::get("infants"),
                'pregnancy'             => Input::get("preg"),
            ));
            Logs::create(array(
                "user_id"=>  Auth::user()->id,
                "action"  =>"Add facility with Name ".Input::get("name")
            ));
        return "<h4 class='text-success'>Facility Added Successful</h4>";
    }


    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function lists()
    {
        return View::make("facility.list");
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
        return View::make("facility.edit",compact("facility"));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $vaccine = Facility::find($id);
        $vaccine->district_id=Input::get("district");
        $vaccine->name=Input::get("name");
        $vaccine->contact=Input::get("contact");
        $vaccine->target_population=Input::get("population");
        $vaccine->annual_birth=Input::get("birth");
        $vaccine->surviving_infants=Input::get("infants");
        $vaccine->pregnancy=Input::get("preg");
        $vaccine->save();
        $name = $vaccine->name;

        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Update facility with name ".$name
        ));
        return "<h4 class='text-success'>Facility Updated Successful</h4>";
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
        $gt = $facility->name;
        $facility->delete();
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Delete facility with name ".$gt
        ));
    }


}
