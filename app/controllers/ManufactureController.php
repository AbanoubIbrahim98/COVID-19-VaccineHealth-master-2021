<?php

class ManufactureController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        Return View::make("manufacture.index");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        Return View::make("manufacture.add");
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if(Manufacturer::where("email",Input::get("email"))->count() == 0){
            $manu = Manufacturer::create(array(
                'name'      => Input::get("name"),
                'country'        =>Input::get("country"),
//                'email'      => Input::get("email"),
//                'physical_address'        =>Input::get("address")
            ));
            foreach($_POST['vaccines'] as $vaccine){
                VaccineManufacturer::create(array(
                    "manufacturer_id"   => $manu->id,
                    "vaccine_id"        => $vaccine
                ));
            }
            foreach($_POST['diluent'] as $diluent){
                DiluentManufacturer::create(array(
                    "manufacturer_id"   => $manu->id,
                    "diluent_id"        => $diluent
                ));
            }
        }else{
            return "<h4 class='text-error'>Manufacture already existed </h4>";
        }
    }


    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function lists()
    {
        return View::make("manufacture.list");
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
        return View::make("manufacture.edit",compact("manu"));
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
//        $manu->email = Input::get("email");
//        $manu->physcal_address = Input::get("address");
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
        $manu = Manufacturer::find($id);


        if($manu->vaccine()->count() != 0){
            foreach($manu->vaccine as $vaccine){
                $vaccine->delete();
            }
        }

        if($manu->diluent()->count() != 0){
            foreach($manu->diluent as $diluent){
                $diluent->delete();
            }
        }
        $gt = $manu->name;
        $manu->delete();

        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Delete Manufacture with name ".$gt
        ));
    }


}
