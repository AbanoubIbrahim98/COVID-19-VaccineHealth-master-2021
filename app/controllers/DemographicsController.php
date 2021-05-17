<?php

class DemographicsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Return View::make("demographics.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     *@param  int  $id
     * @return Response
     */
    public function create($id)
    {
        $district = District::find($id);
        Return View::make("demographics.add",compact('district'));
    }


    /**
     * Store a newly created resource in storage.
     *@param  int  $id
     * @return Response
     */
    public function putt($id)
    {
        $district = District::find($id);
        $district->target_population=Input::get("population");
        $district->annual_birth     =Input::get("birth");
        $district->surviving_infants= Input::get("infants");
        $district->pregnancy = Input::get("preg");
        $district->save();
        $target = 0; $anual = 0; $survivng = 0; $preg=0;
        foreach ($district->region->district as $dis){
            ($dis->target_population == "")?$target+=0:$target+=$dis->target_population;
            ($dis->annual_birth == "")?$anual+=0:$anual+=$dis->annual_birth;
            ($dis->surviving_infants == "")?$survivng+=0:$survivng+=$dis->surviving_infants;
            ($dis->pregnancy == "")?$preg+=0:$preg+=$dis->pregnancy;
        }
        $district->region->tagert_population=$target;
        $district->region->annual_birth     =$anual;
        $district->region->surviving_infants=$survivng;
        $district->region->pregnancy=$preg;
        $district->region->save();
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Update Demographic information for  ".$district->district." district"
        ));
        return "<h4 class='text-success'>Demographic information Updated Successful</h4>";
    }


    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function lists()
    {
        return View::make("demographics.list");
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
        return View::make("demographics.edit",compact("facility"));
    }



}
