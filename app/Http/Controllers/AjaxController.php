<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElementType;
use App\Models\ModelNo;
use App\Models\PartNo;
use App\Models\Tac;
use App\Models\Cop;
use App\Models\Dealer;
use App\Models\TestingAgency;
use App\Models\Distributor;
use App\Models\BarCode;
use App\Models\AllocatedBarCode;
use App\Models\Sim;
use App\Models\Technician;
use App\Models\RtoModel;
use App\Models\MapDevice;
class AjaxController extends Controller
{
    public function fetchElementTypeByElemeNt($element_id)
    {
        $type = ElementType::where('element_id', $element_id, )->get();
        return $type;
    }

    public function fetchModelNoByType($type_id)
    {
        $model = ModelNo::where('type_id', $type_id)->get();
        return $model;
    }

    public function fetchPartNoByModel($model_id)
    {
        $partNo = PartNo::where('model_id', $model_id)->get();
        return $partNo;
    }


    public function fetchTacNoByPart($partId)
    {
        $tac = Tac::where('part_id', $partId)->get();
        return $tac;
    }

    public function fetchcopNoByTacno($tacId)
    {
        $copNo = Cop::where('tacNo', $tacId)->get();
        return $copNo;
    }

    public function getDealerByDistributor(Request $request)
    {
        $dealer = Dealer::where('distributor_id', $request['distributer'])->get();
        return $dealer;
    }


    public function fetchTestingAgencyByCop($copId)
    {
        $testingAgency = TestingAgency::where('copNo', $copId)->get();
        return $testingAgency;
    }

    public function fetchdistributer($state)
    {
        $distributer = Distributor::where('manuf_id', auth('manufacturer')->user()->id)->where('state', $state)->get();

        return response()->json($distributer);
    }


    public function fetchdealer($distributer_id)
    {
        $dealer = Dealer::where('distributor_id', $distributer_id)->get();

        return response()->json($dealer);
    }

    public function fetchBarcodeByPartNo($part_id)
    {
        $barcode = BarCode::where('part_id', $part_id)
            ->where('status', "0")
            ->where('mfg_id', auth('manufacturer')->user()->id)->get();

        return response()->json(['barcodes' => $barcode]);
    }


    public function deviceByDealer($dealerid)
    {
        $device = AllocatedBarCode::with('barcode')->where('dealer_id', $dealerid)->where('status', '0')->get();
        return response()->json($device);
    }


    public function fetchsimInfoByBarcode($barcodeId)
    {
        $simInfo = Sim::where('barcode_id', $barcodeId)->get();
        return response()->json($simInfo);
    }

    public function fetchTechnicianByDealer($dealerid)
    {
        $technician = Technician::where('dealer_id', $dealerid)->get();
        return response()->json($technician);
    }

    public function fetchRtoByDistrict($district)
    {
        $rto = RtoModel::where('district', $district)->get();
        return response()->json($rto);
    }

    public function fetchDistributor($distributorId)
    {
        $distributor = Distributor::find($distributorId);
        return response()->json($distributor);
    }

    public function customerFetchByEmail(Request $request)
    {
        $email = $request->query('query');
        $customer = MapDevice::where('customer_email', $email)->first();

        if ($customer) {
            return response()->json(['success' => true, 'data' => $customer]);
        }

        return response()->json(['success' => false, 'message' => 'Customer not found']);
    }

    public function customerFetchByMobile(Request $request)
    {
        $mobile = $request->query('query');
        $customer = MapDevice::where('customer_mobile', $mobile)->first();

        if ($customer) {
            return response()->json(['success' => true, 'data' => $customer]);
        }

        return response()->json(['success' => false, 'message' => 'Customer not found']);
    }

    public function dealerByDistrict(Request $request){
        $dealer = Dealer::where('distributor_id',auth('distributor')->user()->id)->where('district',$request['district'])->get();
     return response()->json($dealer);
    }
}
