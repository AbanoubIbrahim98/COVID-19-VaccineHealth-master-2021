@extends("layout/master")

@section("title")
<h1>
    Dashboard
    <small>Control panel</small>
</h1>
@stop

@section("breadcumb")
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@stop

@section("contents")
<?php
if(Auth::user()->role_id == 'admin' || Auth::user()->role_id == 'National IVD' || Auth::user()->role_id == 'National'){
    $pop    = 42000000;
    $birth  = 1470000;
    $infants= 1344000;
    $preg   = 1680000;
}elseif(Auth::user()->role_id == 'Region'){
    $pop    = Auth::user()->region->tagert_population;
    $birth  = Auth::user()->region->annual_birth;
    $infants= Auth::user()->region->surviving_infants;
    $preg   = Auth::user()->region->pregnancy;
}elseif(Auth::user()->role_id == 'District'){
    $pop    = Auth::user()->district->target_population;
    $birth  = Auth::user()->district->annual_birth;
    $infants= Auth::user()->district->surviving_infants;
    $preg   = Auth::user()->district->pregnancy;
}
?>
<div class="col-sm-12">
    <div class="col-sm-3">
        <div class="panel panel-default">
            <h3 class="text-center lead">Target Population</h3>
            <h4 class="text-center">{{ number_format($pop) }}</h4>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-default">
            <h3 class="text-center lead">Expected pregnancies</h3>
            <h4 class="text-center">{{ number_format($preg) }}</h4>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-default">
            <h3 class="text-center lead">Expected births</h3>
            <h4 class="text-center">{{ number_format($birth) }}</h4>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="panel panel-default">
            <h3 class="text-center lead">Surviving infants</h3>
            <h4 class="text-center">{{ number_format($infants) }}</h4>
        </div>
    </div>
</div>
<!--<div class="lead col-sm-12">-->
<!--    <div class="col-sm-6">Minimun Stock Level: 987</div>-->
<!--    <div class="col-sm-6 text-right">Maximum Stock Level: 5445</div>-->
<!--</div>-->

<!-- Small boxes (Stat box) -->
<!--<div class="row">-->
<!--    <div class="col-lg-3 col-xs-6">-->
<!--        <!-- small box -->
<!--        <div class="small-box bg-aqua">-->
<!--            <div class="inner">-->
<!--                <h3>-->
<!--                    150-->
<!--                </h3>-->
<!--                <p>-->
<!--                   Received Packages-->
<!--                </p>-->
<!--            </div>-->
<!--            <div class="icon">-->
<!--                <i class="ion ion-bag"></i>-->
<!--            </div>-->
<!--            <a href="#" class="small-box-footer">-->
<!--                More info <i class="fa fa-arrow-circle-right"></i>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div><!-- ./col -->
<!--    <div class="col-lg-3 col-xs-6">-->
<!--        <!-- small box -->
<!--        <div class="small-box bg-green">-->
<!--            <div class="inner">-->
<!--                <h3>-->
<!--                    53<sup style="font-size: 20px">%</sup>-->
<!--                </h3>-->
<!--                <p>-->
<!--                   Sent Packages-->
<!--                </p>-->
<!--            </div>-->
<!--            <div class="icon">-->
<!--                <i class="ion ion-stats-bars"></i>-->
<!--            </div>-->
<!--            <a href="#" class="small-box-footer">-->
<!--                More info <i class="fa fa-arrow-circle-right"></i>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div><!-- ./col -->
<!--    <div class="col-lg-3 col-xs-6">-->
<!--        <!-- small box -->
<!--        <div class="small-box bg-yellow">-->
<!--            <div class="inner">-->
<!--                <h3>-->
<!--                    44-->
<!--                </h3>-->
<!--                <p>-->
<!--                    User Registrations-->
<!--                </p>-->
<!--            </div>-->
<!--            <div class="icon">-->
<!--                <i class="ion ion-person-add"></i>-->
<!--            </div>-->
<!--            <a href="#" class="small-box-footer">-->
<!--                More info <i class="fa fa-arrow-circle-right"></i>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div><!-- ./col -->
<!--    <div class="col-lg-3 col-xs-6">-->
<!--        <!-- small box -->
<!--        <div class="small-box bg-red">-->
<!--            <div class="inner">-->
<!--                <h3>-->
<!--                    65-->
<!--                </h3>-->
<!--                <p>-->
<!--                    Damaged Packages-->
<!--                </p>-->
<!--            </div>-->
<!--            <div class="icon">-->
<!--                <i class="ion ion-pie-graph"></i>-->
<!--            </div>-->
<!--            <a href="#" class="small-box-footer">-->
<!--                More info <i class="fa fa-arrow-circle-right"></i>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div><!-- ./col -->
<!--</div><!-- /.row -->

<div class="row">
    <div class="col-sm-7" id="chat1">

    </div>
    <div class="col-sm-5" id="chat2">

    </div>
</div>
<?php

$cats = "";$i = 0;
$currlevel = "name: 'Current Level',data: [";
$relevel =  "name: 'Reorder Level',data: [";
$distr =  "name: 'Expected Shipment',data: [";
foreach(Vaccine::where('type','vaccine')->get() as $vaccine){
    $bcg  =  Vaccine:: where("GTIN","1234567889771")->first();
    $bcg_serum = Vaccine:: where("GTIN","1234567890074")->first();
    $i++;
    $len = Vaccine::where('type','vaccine')->count() ;
    if($vaccine->GTIN == "1234567889771"){
        $cats .=($i == $len)?"'".$vaccine->name ."'":"'".$vaccine->name ."',";
        if(Auth::user()->role_id == 'admin' || Auth::user()->role_id == 'National IVD' || Auth::user()->role_id == 'National'){
            $min = round((1344000 *$vaccine->wastage *$vaccine->schedule*0.5 ) );
            $s = NationalStock::where('GTIN',"1234567889771")->sum('number_of_doses');
            $s1= NationalStock::where('GTIN',"1234567890074")->sum('number_of_doses');
            $stock = $s + $s1;
            $b = ManufacturePackage::where('status','')->where('vaccine_id','6')->sum('number_of_doses');
            $b1= ManufacturePackage::where('status','')->where('vaccine_id','8')->sum('number_of_doses');
            $pack = $b + $b1;
        }
        elseif(Auth::user()->role_id == 'Region'){
            $min = round((Auth::user()->region->surviving_infants *$vaccine->wastage *$vaccine->schedule*0.5 )/4 );
            $s = RegionStock::where('vaccine_id',"1234567889771")->sum('number_of_doses');
            $s1= RegionStock::where('vaccine_id',"1234567890074")->sum('number_of_doses');
            $stock = $s +$s1;
            $b =(NationalPackageContent::where('status','')->whereIn('package_id',NationalPackage::where('region_id',Auth::user()->region_id)->where('date_sent','!=','')->get()->lists('id')+array(0))->where('vaccine_id','6')->sum('number_of_boxes'))*$bcg->vials_per_box*$bcg->doses_per_vial;
            $b1= (NationalPackageContent::where('status','')->whereIn('package_id',NationalPackage::where('region_id',Auth::user()->region_id)->where('date_sent','!=','')->get()->lists('id')+array(0))->where('vaccine_id','8')->sum('number_of_boxes'))*$bcg_serum->vials_per_box*$bcg_serum->doses_per_vial;
            $pack = $b + $b1;
        }
        elseif(Auth::user()->role_id == 'District'){
            $min = round((Auth::user()->district->surviving_infants *$vaccine->wastage *$vaccine->schedule*0.5 )/12 );
            $s = DistrictStock::where('vaccine_id',"1234567889771")->sum('number_of_doses');
            $s1=DistrictStock::where('vaccine_id',"1234567890074")->sum('number_of_doses');
            $stock = $s + $s1;
            $b =  (RegionalPackageContent::where('status','')->whereIn('package_id',RegionalPackage::where('district_id',Auth::user()->district_id)->where('date_sent','!=','')->get()->lists('id')+array(0))->where('vaccine_id','6')->sum('number_of_boxes'))*$bcg->vials_per_box*$bcg->doses_per_vial;
            $b1=  (RegionalPackageContent::where('status','')->whereIn('package_id',RegionalPackage::where('district_id',Auth::user()->district_id)->where('date_sent','!=','')->get()->lists('id')+array(0))->where('vaccine_id','8')->sum('number_of_boxes'))*$bcg_serum->vials_per_box*$bcg_serum->doses_per_vial;
            $pack = $b + $b1;
        }
        $relevel .=($i == $len)? $min : $min.",";
        $currlevel .=($i == $len)? $stock : $stock.",";
        $distr .=($i == $len )? $pack : $pack.",";
    }elseif($vaccine->GTIN == "1234567890074" ){

    }else{
        $cats .=($i == $len)?"'".$vaccine->name ."'":"'".$vaccine->name ."',";
        if(Auth::user()->role_id == 'admin' || Auth::user()->role_id == 'National IVD' || Auth::user()->role_id == 'National'){
            $min = round((1344000 *$vaccine->wastage *$vaccine->schedule*0.5 ) );
            $stock = NationalStock::where('GTIN',$vaccine->GTIN)->sum('number_of_doses');
            $pack = ManufacturePackage::where('status','')->where('vaccine_id',$vaccine->id)->sum('number_of_doses');
        }
        elseif(Auth::user()->role_id == 'Region'){
            $min = round((Auth::user()->region->surviving_infants *$vaccine->wastage *$vaccine->schedule*0.5 )/4 );
            $stock = RegionStock::where('vaccine_id',$vaccine->GTIN)->sum('number_of_doses');
            $pack = (NationalPackageContent::where('status','')->whereIn('package_id',NationalPackage::where('region_id',Auth::user()->region_id)->where('date_sent','!=','')->get()->lists('id')+array(0))->where('vaccine_id',$vaccine->id)->sum('number_of_boxes'))*$vaccine->vials_per_box*$vaccine->doses_per_vial;
        }
        elseif(Auth::user()->role_id == 'District'){
            $min = round((Auth::user()->district->surviving_infants *$vaccine->wastage *$vaccine->schedule*0.5 )/12 );
            $stock = DistrictStock::where('vaccine_id',$vaccine->GTIN)->sum('number_of_doses');
            $pack = (RegionalPackageContent::where('status','')->whereIn('package_id',RegionalPackage::where('district_id',Auth::user()->district_id)->where('date_sent','!=','')->get()->lists('id')+array(0))->where('vaccine_id',$vaccine->id)->sum('number_of_boxes'))*$vaccine->vials_per_box*$vaccine->doses_per_vial;
        }
        $relevel .=($i == $len)? $min : $min.",";
        $currlevel .=($i == $len)? $stock : $stock.",";
        $distr .=($i == $len )? $pack : $pack.",";

    }




}
$currlevel .="]";
$relevel .="]";
$distr .="]";
?>
<script>
    $(function () {
        $('#chat1').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'My Store'
            },
            subtitle: {
                text: 'Stock Level'
            },
            xAxis: {
                categories: [<?php echo $cats ?> ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Stock Level(Doses)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px"><b>{point.key}</b></span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} Doses</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                <?php echo $currlevel ?>
            }, {
                <?php echo $relevel ?>
            }]
        });

        $('#chat2').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: ' Expected Shipments '
            },
            xAxis: {
                categories: [
                   <?php echo $cats ?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Doses'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key} </span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} Doses</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                <?php echo $distr ?>
            }]
        });
    });
</script>

@stop