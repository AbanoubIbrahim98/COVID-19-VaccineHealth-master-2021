<?php

class DiluentController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Return View::make("diluent.index");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        Return View::make("diluent.add");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(Diluent::where("diluent_name",Input::get("name"))->count() == 0){
            Diluent::create(array(
                'diluent_name'      => Input::get("name"),
                'vaccine_id'        =>Input::get("vaccine"),
                'units_per_box'        =>Input::get("units")
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
        return View::make("diluent.list");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $diluent = Diluent::find($id);
        return View::make("diluent.edit",compact("diluent"));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $diluent = Diluent::find($id);
        $diluent->diluent_name = Input::get("name");
        $diluent->vaccine_id = Input::get("vaccine");
        $diluent->units_per_box = Input::get("units");
        $diluent->save();
        $name = $diluent->diluent_name;

        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Update diluent with name ".$name
        ));
        return "<h4 class='text-success'>Diluent Updated Successfull</h4>";
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $diluent = Diluent::find($id);
        if($diluent->manufacture()->count() != 0){
            foreach($diluent->manufacturer as $manu){
                $manu->delete();
            }
        }
        $gt = $diluent->diluent_name;
        $diluent->delete();
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Delete diluent with name ".$gt
        ));
    }


}
