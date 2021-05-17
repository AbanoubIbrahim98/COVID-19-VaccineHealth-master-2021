<?php

class ManuBarController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Return View::make("manufabar.index");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        Return View::make("manufabar.add");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $package = ManufacturePackage::create(array(
            'sscc'            =>Input::get("barcode"),
            'vaccine_id'            =>Input::get("vaccine"),
            'Manufacture_date'      =>Input::get("manu"),
            'expiry_date'           =>Input::get("exp"),
            'lot_number'            =>Input::get("lot"),
            'number_of_doses'       =>Input::get("quantity")
        ));

    }


    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function lists()
    {
        return View::make("manufabar.list");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $manu = Manufacturer::find($id);
        return View::make("manufabar.edit",compact("manu"));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $manu = Manufacturer::find($id);
        $manu->name = Input::get("name");
        $manu->country = Input::get("country");
        $manu->email = Input::get("email");
        $manu->physcal_address = Input::get("address");
        $manu->save();
        $name = $manu->name;



        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Update manufacture with name ".$name
        ));
        return "<h4 class='text-success'>Manufacture Updated Successfull</h4>";
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $manu = ManufacturePackage::find($id);
        $gt = $manu->sscc;
        $manu->delete();

        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Delete Manufacture Package with SSCC ".$gt
        ));
    }


}