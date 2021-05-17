<?php

class PackageController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make("recieve_national.index");
	}

/** send packagae*/
    public function sendPackage(){
        return View::make("send_national.index");

    }

    public function receive()
    {
        return View::make("recieve.national");
    }

    /**
     * Checking for a package with required sscc and return it details
     *
     * @param  int  $id
     * @return Response
     */
    public function checksscc($id){
        $package = ManufacturePackage::where('sscc',$id)->where('status',"")->get();
        if($package->count() != 0){
        if(ArrivalNational::where('ssc',$id)->count() == ManufacturePackage::where('sscc',$id)->count() ){
            echo "<h3 class='text-danger'>All packages from this shipping information have been received</h3>";
        }else{
                return View::make("recieve_national.package",compact('package'));
            }
        }else{
            echo "<h3 class='text-danger'>There are no information about this package</h3>";
        }

    }

    public function checkqr($id){
        $arr = $this->breakqr($id);
        $arrival = ManufacturePackage::where('lot_number',$arr['lot_number'])->where('status',"")->first();
        if($arrival){
                return View::make("recieve_national.confirm",compact('arrival'));            }
        else{
            echo "<h3 class='text-danger'>There are no information about this item</h3>";
        }
    }

    public function listconfirmed($id){
       $packages = ArrivalNational::where('ssc',$id)->where('status','')->get();
        return View::make('recieve_national.listconfirmed',compact('packages'));
    }

    public function cancelreceive($id){
        ArrivalNational::where('ssc',$id)->get();
        foreach(ArrivalNational::where('ssc',$id)->get() as $pack){
            $nat = NationalPackage::where('GTIN',$pack->GTIN)->where('lot_number',$pack->lot_number)->first();
            $nat->number_of_doses = $nat->number_of_doses - $pack->number_received;
            $nat->save();
            $pack->delete();
        }
    }

    public function additemtostock($id){
        $package = ManufacturePackage::find($id);
        $arrival = ArrivalNational::create(array(
            'ssc'                   =>$package->sscc,
            'GTIN'                  =>$package->vaccine->GTIN,
            'lot_number'            =>$package->lot_number,
            'number_as_expected'    =>Input::get('quantity'),
            'temperature_monitor'   =>Input::get('temp'),
            'physcal_damege'        =>Input::get('damage'),
            'vvm_status'            =>Input::get('vvm'),
            'number_received'       =>(Input::has('quantity1'))?Input::get('quantity1')*$package->vaccine->doses_per_vial:$package->number_of_doses,
            'number_expected'       =>$package->number_of_doses,
            'receiver'              =>Auth::user()->id,
            'problem'               =>Input::get('comments'),
        ));
        $arr = ArrivalNational::where('ssc',$package->ssc)->count();
        $arr1 = ManufacturePackage::where('sscc',$package->sscc)->where('status','received')->count();

        $stock = NationalStock::where('lot_number',$package->lot_number)->first();
        if($stock){
            $stock->number_of_doses = $stock->number_of_doses + $arrival->number_received;
            $stock->save();
        }else{
            NationalStock::create(array(
                'number_of_doses'   => $arrival->number_received,
                'lot_number'        => $package->lot_number,
                'GTIN'              => $package->vaccine->GTIN,
                'expiry_date'       => $package->expiry_date
            ));
        }
        $package->status = "received";
        $package->save();
        Logs::create(array(
            "user_id"=>  Auth::user()->id,
            "action"  =>"Receive ".$package->vaccine->name." From Shipment number ". $package->sscc
        ));
        echo "<h3 class='text-success'>Received Successful</h3>";

    }

    public function listrecieved(){
        return View::make('recieve_national.list');
    }

    public function areainfo($id){
        $region = Region::find($id);
        return View::make('send_national.info',compact('region'));
    }

    public function prepareform($id){
            $arr = $this->breakqr(Input::get('sscc'));
            $package = NationalStock::where('lot_number',$arr['lot_number'])->where('number_of_doses','!=','0')->first();
            $idd = "";
            if($package){
                if(Input::get('id') == "first"){
                    $createdid = NationalPackage::create(array(
                        'region_id' => $id,
                    ));
                    $createdid->package_number = '01'.strtotime($createdid->created_at);
                    $createdid->save();
                    $idd = $createdid->id;
                }
                //ckecking expiry and diluent collarance
                $expiry_status ="";
                 if(strtotime($package->expiry_date) < strtotime(date('Y-m-d')) ){
                     $expiry_status = "expired";
                 }elseif((strtotime($package->expiry_date) - strtotime(date('Y-m-d')))/2592000 < $package->vaccine->warning_period){
                     $expiry_status = "near expiry";
                 }

                //checking the existance of same vaccine with close expiry date
                $other_available="";
                $other_vaccine = NationalStock::where('GTIN',$package->GTIN)->where('number_of_doses','!=','0')->get();
                foreach($other_vaccine as $vaccine){
                    if(strtotime($vaccine->expiry_date)<strtotime($package->expiry_date) && strtotime($vaccine->expiry_date) > strtotime(date('Y-m-d')))
                        $other_available = $vaccine->lot_number;
                }
                $region = Region::find($id);
                return View::make("send_national.package",compact('package','idd','expiry_status','other_available','region'));
            }else{
                echo "<h3 class='text-danger'>There is no vaccine or diluent with this lot number</h3>";
            }


    }

    public function processaddpackage(){
        $stock = NationalStock::where('lot_number',Input::get('lot'))->first();
        $doses = Input::get('box') * $stock->vaccine->vials_per_box * $stock->vaccine->doses_per_vial;
        if($stock->number_of_doses >= $doses){
            $pack = NationalPackageContent::where('package_id',Input::get('idd'))->where('lot_number',Input::get('lot'))->first();
            if($pack){
                $pack->number_of_boxes = $pack->number_of_boxes+Input::get('box');
                $pack->save();
            }else{
                NationalPackageContent::create(array(
                    'package_id' => Input::get('idd'),
                    'number_of_boxes' => Input::get('box'),
                    'lot_number' => Input::get('lot'),
                    'vaccine_id' => $stock->vaccine->id
                ));
            }
            echo '<h3 class="text-success">Added Successfull</h3>';
        }else{
            echo '<h3 class="text-danger"> This amount is not available on stock</h3>';
        }
    }

    public function sendPackageList($id){
        $natpack = NationalPackage::find($id);
        return View::make('send_national.list',compact('natpack'));
    }

    public function deleteinlist($id){
        $pack = NationalPackageContent::find($id);
        $pack->delete();
    }

    public function confirmsend($id){
        $package = NationalPackage::find($id);
        if($package->packages()->count() != 0){
            $package->date_sent = date("Y-m-d");
            $package->sender = Auth::user()->id;

            foreach($package->packages as $pack){
                //$doses = ($pack->manufacturer->vaccine->doses_per_vial / $pack->number_of_doses )*$pack->manufacturer->vaccine->vials_per_box;
                $doses = $pack->number_of_boxes * $pack->vaccine->vials_per_box * $pack->vaccine->doses_per_vial;
                $stock = NationalStock::where('lot_number',$pack->lot_number)->first();
                $stock->number_of_doses = $stock->number_of_doses - $doses;
                $stock->save();
            }
            $package->save();
            Logs::create(array(
                "user_id"=>  Auth::user()->id,
                "action"  =>"Send a package to ".$package->region->region ." Region with Shipment number ". $package->package_number
            ));
        }else{
            echo "not";
        }

    }

    public function voucher($id){
        $natpack = NationalPackage::find($id);
        return View::make('send_national.voucher',compact('natpack'));
    }

    public function deletprepared($id){
        $package = NationalPackage::find($id);
        foreach($package->packages as $pack){
            $pack->delete();
        }
        $package->delete();
        echo "<h4 class='text-success'>Cancelled</h4>";
    }

    public function viewstock(){
        return View::make('send_national.stock');
    }

    public function viewsent(){
        return View::make('send_national.List_sent');
    }

    public function breakqr($qr){
        if (strpos($qr,'(01)') !== false && strpos($qr,'(17)') !== false) {
        $arr = explode(")",$qr);
        unset($arr[0]);
        $gtnarr1 = explode("(",$arr[1]);
        $exparr1 = explode("(",$arr[2]);
        $gtin=$gtnarr1[0];
        $lot_number=$arr[3];
        $expiry_date=$exparr1[0];
            return array("gtin"=>$gtin,"lot_number"=>$lot_number,"expiry_date"=>$expiry_date);
        }else{
            return array("lot_number"=>$qr);
        }

    }

    public function easysend(){
        $regions = Region::all();
        return View::make('send_national.easy_send',compact('regions'));
    }

    public function checkstocklot($id){
        $arr = $this->breakqr($id);
        $package = NationalStock::where('lot_number',$arr['lot_number'])->first();
        if($package){
            $period = Input::get('period');
            return View::make("send_national.countstock",compact('package','period'));            }
        else{
            echo "<h3 class='text-danger'>There are no information about this item from your stock</h3>";
        }
    }

    public function performcount(){
        $count = NationalInventory::where('lot_number',Input::get('lot'))->where('reporting_period',date('M Y'))->first();
        if($count){
            $count->delete();
            $inv = NationalInventory::create(array(
                'reporting_period'  => date("M Y"),
                'user_id'           => Auth::user()->id,
                'lot_number'        => Input::get('lot'),
                'GTIN'              => Input::get('GTIN'),
                'status'            => (Input::has('positive'))?"positive":"negative",
                'reason'            => (Input::has('positive'))? Input::get('positive'): Input::get('negative'),
                'boxes'             => Input::get('box'),
                'vials'             => Input::get('vials'),
            ));
        }else{
            $inv = NationalInventory::create(array(
                'reporting_period'  => date("M Y"),
                'user_id'           => Auth::user()->id,
                'lot_number'        => Input::get('lot'),
                'GTIN'              => Input::get('GTIN'),
                'status'            => (Input::has('positive'))?"positive":"negative",
                'reason'            => (Input::has('positive'))? Input::get('positive'): Input::get('negative'),
                'boxes'             => Input::get('box'),
                'vials'             => Input::get('vials'),
            ));
        }
    }

    public function liststock(){
//        $packages = NationalInvertory::all();
        return View::make('send_national.listcount');
    }

    public function liststock1(){
//        $packages = NationalInvertory::all();
        return View::make('send_national.listcount1');
    }

    public function confirmcount($id){

            $boxx =  Input::get('box');
            $viall =  Input::get('vials');

        $stock = NationalStock::where('lot_number',$id)->first();
        $doses = $stock->number_of_doses;
        $fromdoses =  ($boxx*$stock->vaccine->doses_per_vial*$stock->vaccine->vials_per_box) + ($viall*$stock->vaccine->doses_per_vial);
        if($doses > $fromdoses){
            echo "negative";
        }elseif($doses < $fromdoses){
            echo "positive";
        }elseif($doses == $fromdoses){
            echo "equals";
        }
    }
}