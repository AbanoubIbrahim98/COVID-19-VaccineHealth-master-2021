<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('password', 'RemindersController');

Route::get('/', function()
{
	return View::make('login');
});


Route::get('home', function()
{
    return View::make('dashboard');
});

Route::post('home', function()
{

    return View::make('dashboard');
});

Route::get('mystore', function()
{
    if(Auth::user()->role_id == 'admin' || Auth::user()->role_id == 'National' || Auth::user()->role_id == 'National IVD' ){
        return View::make('send_national.stocklevel');
    }
    elseif(Auth::user()->role_id == 'Region'){
        return View::make('send_region.stocklevel');
    }
    elseif(Auth::user()->role_id == 'District'){
        return View::make('send_district.stocklevel');
    }
});

Route::get('receive', function()
{
    if(Auth::user()->role_id == 'admin' || Auth::user()->role_id == 'National' || Auth::user()->role_id == 'National IVD' ){
        return View::make('send_national.listreceived');
    }
    elseif(Auth::user()->role_id == 'Region'){
        return View::make('send_region.listreceived');
    }
    elseif(Auth::user()->role_id == 'District'){
        return View::make('send_district.listreceived');
    }
});

Route::get('dispatched', function()
{
    if(Auth::user()->role_id == 'admin' || Auth::user()->role_id == 'National' || Auth::user()->role_id == 'National IVD' ){
        return View::make('send_national.List_sent');
    }
    elseif(Auth::user()->role_id == 'Region'){
    return View::make('send_region.List_sent');
}
    elseif(Auth::user()->role_id == 'District'){
    return View::make('send_district.List_sent');
}
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Managing user actions
 * Directing routes to correct controllers
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//validating user during login
Route::post('login',array('as'=>'login', 'uses'=>'UserController@validate'));

//logging a user out
Route::get('logout',array('as'=>'logout', 'uses'=>'UserController@logout'));

//display a form to add new user
Route::get('user/add',array('as'=>'adduser', 'uses'=>'UserController@create'));

//display a list of users
Route::get('user/list',array('uses'=>'UserController@userlist'));

//adding new user
Route::post('user/add',array('as'=>'adduser1', 'uses'=>'UserController@store'));

//viewing list of users
Route::get('users',array('as'=>'listuser', 'uses'=>'UserController@index'));

//display a form to edit users information
Route::get('user/edit/{id}',array('as'=>'edituser', 'uses'=>'UserController@edit'));

//editng users information
Route::post('user/edit/{id}',array('as'=>'edituser', 'uses'=>'UserController@update'));

//deleting user
Route::post('user/delete/{id}',array('as'=>'deleteuser', 'uses'=>'UserController@destroy'));

//display a system usage log for a user
Route::get('user/log/{id}',array('as'=>'userlog', 'uses'=>'UserController@show'));

//check for a regions district...
Route::post('user/region_check/{id}',array('uses'=>'UserController@check_region'));

//check for a regions district...
Route::post('user/region_check1/{id}',array('uses'=>'UserController@check_region1'));

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Managing Vaccines actions
 * Directing routes to correct controllers
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


//display a form to add new vaccine
Route::get('vaccine/add',array('uses'=>'VaccineController@create'));

//display a list of vaccines
Route::get('vaccine/list',array('uses'=>'VaccineController@lists'));

//adding new vaccine
Route::post('vaccine/add',array('uses'=>'VaccineController@store'));

//viewing index page
Route::get('vaccine',array('uses'=>'VaccineController@index'));

//display a form to edit vaccine information
Route::get('vaccine/edit/{id}',array('uses'=>'VaccineController@edit'));

//editng vaccine information
Route::post('vaccine/edit/{id}',array('uses'=>'VaccineController@update'));

//deleting vaccine
Route::post('vaccine/delete/{id}',array('uses'=>'VaccineController@destroy'));


////////////////////////////////////////////////////////////////////////////////////////
////manage profile routes
///////////////////////////////////////////////////////////////////////////////////////

//route to display profile
Route::get('profile',array('as'=>'profile', 'uses'=>'UserController@profile'));

//route to display profile info
Route::get('profileInfo',array('as'=>'profileInfo', 'uses'=>'UserController@profileInfo'));

//route to display profile edit
Route::get('profileEdit',array('as'=>'profileEdit', 'uses'=>'UserController@profileEdit'));


//display a form to add new role
//Route::get('package/index',array('uses'=>'PackageController@index'));

//display a list of vaccines
Route::get('package/receive/national',array('uses'=>'PackageController@index'));

//display a list of vaccines
Route::get('package/national/stock',array('uses'=>'PackageController@viewstock'));

//display a list of vaccines
Route::get('package/national/sent',array('uses'=>'PackageController@viewsent'));

//display a list of vaccines
Route::post('package/receive/sscc/{id}',array('uses'=>'PackageController@checksscc'));

//display a list of vaccines
Route::post('package/receive/qrcode/{id}',array('uses'=>'PackageController@checkqr'));

//display a list of vaccines
Route::post('package/receive/confirmqr/{id}',array('uses'=>'PackageController@additemtostock'));

//display a list of vaccines
Route::post('package/receive/cancelrecieve/{id}',array('uses'=>'PackageController@cancelreceive'));

//display a list of vaccines
Route::post('package/receive/confirm/{id}',array('uses'=>'PackageController@confirmpackage'));

//display a list of vaccines
Route::get('package/receive/list',array('uses'=>'PackageController@listrecieved'));

//display a list of vaccines
Route::get('package/receive/form',array('uses'=>'PackageController@fillform'));

//display a list of vaccines
Route::get('package/receive/listconfirmed/{id}',array('uses'=>'PackageController@listconfirmed'));

//viewing index page
Route::get('package/send/national',array('uses'=>'PackageController@sendPackage'));

//viewing index page
Route::get('package/send/list/{id}',array('uses'=>'PackageController@sendPackageList'));


//display a list of vaccines
Route::post('package/prepare/{id}',array('uses'=>'PackageController@prepareform'));

//display a list of vaccines
Route::get('package/prepare/areainfo/{id}',array('uses'=>'PackageController@areainfo'));

//display a list of vaccines
Route::get('package/prepare/easysend',array('uses'=>'PackageController@easysend'));

//display a list of vaccines
Route::post('package/prepare/add',array('uses'=>'PackageController@addpackage'));

//display a list of vaccines
Route::post('package/addpack',array('uses'=>'PackageController@processaddpackage'));

//display a form to edit vaccine information
Route::post('package/send',array('uses'=>'PackageController@edit'));

//display a form to edit vaccine information
Route::post('package/national/listed/delete/{id}',array('uses'=>'PackageController@deleteinlist'));

//display a form to edit vaccine information
Route::post('package/national/confirmsend/{id}',array('uses'=>'PackageController@confirmsend'));

//display a voucher ready to print
Route::get('package/displayvoucher/{id}',array('uses'=>'PackageController@voucher'));


//display a form to edit vaccine information
Route::post('package/national/prepared/delete/{id}',array('uses'=>'PackageController@deletprepared'));

//display a form to edit vaccine information
Route::post('package/stock/checklot/{id}',array('uses'=>'PackageController@checkstocklot'));

//display a form to edit vaccine information
Route::post('package/stock/count',array('uses'=>'PackageController@performcount'));

//display a form to edit vaccine information
Route::post('package/confirmcount/{id}',array('uses'=>'PackageController@confirmcount'));

//display a form to edit vaccine information
Route::get('package/inventory/list',array('uses'=>'PackageController@liststock'));

//display a form to edit vaccine information
Route::get('package/inventory/list1',array('uses'=>'PackageController@liststock1'));


///////////////////////////////////////////////////////////////////////////////////
////// Routes for Regional package management
/////  Using RegionPackageController
///////////////////////////////////////////////////////////////////////////////////


//display a form to add new role
//Route::get('package/index',array('uses'=>'PackageController@index'));

//display a list of vaccines
Route::get('region_package/receive/national',array('uses'=>'RegionPackageController@index'));

//display a list of vaccines
Route::get('region_package/national/stock',array('uses'=>'RegionPackageController@viewstock'));

//display a list of vaccines
Route::get('region_package/national/sent',array('uses'=>'RegionPackageController@viewsent'));

//display a list of vaccines
Route::post('region_package/receive/sscc/{id}',array('uses'=>'RegionPackageController@checksscc'));

//display a list of vaccines
Route::post('region_package/receive/qrcode/{id}',array('uses'=>'RegionPackageController@checkqr'));

//display a list of vaccines
Route::post('region_package/receive/confirmqr/{id}',array('uses'=>'RegionPackageController@additemtostock'));

//display a list of vaccines
Route::post('region_package/receive/confirm/{id}',array('uses'=>'RegionPackageController@confirmpackage'));

//display a list of vaccines
Route::get('region_package/receive/list',array('uses'=>'RegionPackageController@listrecieved'));

//display a list of vaccines
Route::get('region_package/receive/form',array('uses'=>'RegionPackageController@fillform'));

//viewing index page
Route::get('region_package/send/national',array('uses'=>'RegionPackageController@sendPackage'));

//viewing index page
Route::get('region_package/send/list/{id}',array('uses'=>'RegionPackageController@sendPackageList'));

//display a list of vaccines
Route::post('region_package/prepare/{id}',array('uses'=>'RegionPackageController@prepareform'));

//display a list of vaccines
Route::get('region_package/prepare/areainfo/{id}',array('uses'=>'RegionPackageController@areainfo'));

//display a list of vaccines
Route::post('region_package/prepare/add',array('uses'=>'RegionPackageController@addpackage'));

//display a list of vaccines
Route::post('region_package/addpack',array('uses'=>'RegionPackageController@processaddpackage'));

//display a form to edit vaccine information
Route::post('region_package/send',array('uses'=>'RegionPackageController@edit'));

//display a form to edit vaccine information
Route::post('region_package/national/listed/delete/{id}',array('uses'=>'RegionPackageController@deleteinlist'));

//display a form to edit vaccine information
Route::post('region_package/national/confirmsend/{id}',array('uses'=>'RegionPackageController@confirmsend'));

//display a form to edit vaccine information
Route::post('region_package/national/prepared/delete/{id}',array('uses'=>'RegionPackageController@deletprepared'));

//display a form to edit vaccine information
Route::post('region_package/stock/checklot/{id}',array('uses'=>'RegionPackageController@checkstocklot'));

//display a voucher ready to print
Route::get('region_package/displayvoucher/{id}',array('uses'=>'RegionPackageController@voucher'));

//display a form to edit vaccine information
Route::post('region_package/stock/count',array('uses'=>'RegionPackageController@performcount'));

//display a form to edit vaccine information
Route::post('region_package/confirmcount/{id}',array('uses'=>'RegionPackageController@confirmcount'));

//display a form to edit vaccine information
Route::get('region_package/inventory/list1',array('uses'=>'RegionPackageController@liststock1'));

//display a form to edit vaccine information
Route::get('region_package/inventory/list',array('uses'=>'RegionPackageController@liststock'));


///////////////////////////////////////////////////////////////////////////////////
////// Routes for District package management
/////  Using DistrictPackageController
///////////////////////////////////////////////////////////////////////////////////


//display a form to add new role
//Route::get('package/index',array('uses'=>'PackageController@index'));

//display a list of vaccines
Route::get('district_package/receive/national',array('uses'=>'DistrictPackageController@index'));

//display a list of vaccines
Route::get('district_package/national/stock',array('uses'=>'DistrictPackageController@viewstock'));

//display a list of vaccines
Route::get('district_package/national/sent',array('uses'=>'DistrictPackageController@viewsent'));

//display a list of vaccines
Route::post('district_package/receive/sscc/{id}',array('uses'=>'DistrictPackageController@checksscc'));

//display a list of vaccines
Route::post('district_package/receive/qrcode/{id}',array('uses'=>'DistrictPackageController@checkqr'));

//display a list of vaccines
Route::post('district_package/receive/confirmqr/{id}',array('uses'=>'DistrictPackageController@additemtostock'));

//display a list of vaccines
Route::post('district_package/receive/confirm/{id}',array('uses'=>'DistrictPackageController@confirmpackage'));

//display a list of vaccines
Route::get('district_package/receive/list',array('uses'=>'DistrictPackageController@listrecieved'));

//display a list of vaccines
Route::get('district_package/receive/form',array('uses'=>'DistrictPackageController@fillform'));

//viewing index page
Route::get('district_package/send/national',array('uses'=>'DistrictPackageController@sendPackage'));

//viewing index page
Route::get('district_package/send/list/{id}',array('uses'=>'DistrictPackageController@sendPackageList'));

//display a list of vaccines
Route::post('district_package/prepare/{id}',array('uses'=>'DistrictPackageController@prepareform'));

//display a list of vaccines
Route::get('district_package/prepare/areainfo/{id}',array('uses'=>'DistrictPackageController@areainfo'));

//display a list of vaccines
Route::post('district_package/prepare/add',array('uses'=>'DistrictPackageController@addpackage'));

//display a list of vaccines
Route::post('district_package/addpack',array('uses'=>'DistrictPackageController@processaddpackage'));

//display a form to edit vaccine information
Route::post('district_package/send',array('uses'=>'DistrictPackageController@edit'));

//display a form to edit vaccine information
Route::post('district_package/national/listed/delete/{id}',array('uses'=>'DistrictPackageController@deleteinlist'));

//display a form to edit vaccine information
Route::post('district_package/national/confirmsend/{id}',array('uses'=>'DistrictPackageController@confirmsend'));

//display a form to edit vaccine information
Route::post('district_package/national/prepared/delete/{id}',array('uses'=>'DistrictPackageController@deletprepared'));

//display a voucher ready to print
Route::get('district_package/displayvoucher/{id}',array('uses'=>'DistrictPackageController@voucher'));

//display a form to edit vaccine information
Route::post('district_package/stock/count',array('uses'=>'DistrictPackageController@performcount'));

//display a form to edit vaccine information
Route::post('district_package/confirmcount/{id}',array('uses'=>'DistrictPackageController@confirmcount'));

//display a form to edit vaccine information
Route::get('district_package/inventory/list1',array('uses'=>'DistrictPackageController@liststock1'));

//display a form to edit vaccine information
Route::get('district_package/inventory/list',array('uses'=>'DistrictPackageController@liststock'));

//display a form to edit vaccine information
Route::post('district_package/stock/checklot/{id}',array('uses'=>'DistrictPackageController@checkstocklot'));


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Managing Manufacture Barcodes actions
 * Directing routes to correct controllers
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


//display a form to add new vaccine
Route::get('manubarcode/add/',array('uses'=>'ManuBarController@create'));

//display a list of vaccines
Route::get('manubarcode/list',array('uses'=>'ManuBarController@lists'));

//adding new vaccine
Route::post('manubarcode/add',array('uses'=>'ManuBarController@store'));

//viewing index page
Route::get('manubarcode',array('uses'=>'ManuBarController@index'));

//display a form to edit vaccine information
Route::get('manubarcode/edit/{id}',array('uses'=>'ManuBarController@edit'));

//editng vaccine information
Route::post('manubarcode/edit/{id}',array('uses'=>'ManuBarController@update'));

//deleting vaccine
Route::post('manubarcode/delete/{id}',array('uses'=>'ManuBarController@destroy'));

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Managing Facility actions
 * Directing routes to correct controllers
 * using FacilityController
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


//display a form to add new vaccine
Route::get('facility/add',array('uses'=>'FacilityController@create'));

//display a list of vaccines
Route::get('facility/list',array('uses'=>'FacilityController@lists'));

//adding new facility
Route::post('facility/add',array('uses'=>'FacilityController@store'));

//viewing index page
Route::get('facility',array('uses'=>'FacilityController@index'));

//display a form to edit facility information
Route::get('facility/edit/{id}',array('uses'=>'FacilityController@edit'));

//editng facility information
Route::post('facility/edit/{id}',array('uses'=>'FacilityController@update'));

//deleting facility
Route::post('facility/delete/{id}',array('uses'=>'FacilityController@destroy'));

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Managing Demographics actions
 * Directing routes to correct controllers
 * using DemographicsController
 */
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


//display a form to add new vaccine
Route::get('demographics/add/{id}',array('uses'=>'DemographicsController@create'));

//display a list of vaccines
Route::get('demographics/list',array('uses'=>'DemographicsController@lists'));

//adding new facility
Route::post('demographics/add/{id}',array('uses'=>'DemographicsController@putt'));

//viewing index page
Route::get('demographics',array('uses'=>'DemographicsController@index'));

//display a form to edit facility information
Route::get('demographics/edit/{id}',array('uses'=>'DemographicsController@edit'));

//editng facility information
Route::post('demographics/edit/{id}',array('uses'=>'DemographicsController@update'));

//deleting facility
Route::post('demographics/delete/{id}',array('uses'=>'DemographicsController@destroy'));