<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;
use App\Models\ManufacturerElement;
use App\Models\BarCode;
use App\Models\Sim;
use Carbon\Carbon;
use App\Models\AllocatedBarCode;
use Illuminate\Support\Facades\Auth;

class BarCodeController extends Controller
{
    public function index()
    {
        $element = ManufacturerElement::with('element')->where('mfg_id', auth('manufacturer')->user()->id)->get();
        // dd(auth('manufacturer')->user()->id);
        $currentTime = Carbon::now()->setTimezone('Asia/Kolkata');
        $batchNo = $currentTime->format('YmdHis');
        $barCode = BarCode::with('manufacturer', 'element', 'elementType', 'modelNo', 'partNo')->where('mfg_id', auth('manufacturer')->user()->id)->get();
        return view("backend.barcode.index")->with(compact('element', 'currentTime', 'batchNo', 'barCode'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate(
            [
                'element' => 'required|integer',
                'element_type' => 'required|integer',
                'model_no' => 'required|integer',
                'device_part_no' => 'required|integer',
                'tacNo' => 'required|integer',
                'copNo' => 'required|integer',
                'copValidTill' => 'required|string',
                'testingAgency' => 'required|integer',
                'voltage' => 'required|string',
                'batchNo' => 'required|string',
                'barcodeNo' => 'required|string',
                'is_renew' => 'required|integer',
                'serialNo' => 'required|string',
            ]
        );
        $simNo = $request['simNo'];
        $iccidNo = $request['iccidNo'];
        $validity = $request['validity'];
        $operator = $request['operator'];

        $barcode = new Barcode;
        $barcode->mfg_id = auth('manufacturer')->user()->id;
        $barcode->element_id = $request['element'];
        $barcode->type_id = $request['element_type'];
        $barcode->model_id = $request['model_no'];
        $barcode->part_id = $request['device_part_no'];
        $barcode->tac_id = $request['tacNo'];
        $barcode->cop_id = $request['copNo'];
        $barcode->testing_agencyId = $request['testingAgency'];
        $barcode->serialNumber = $request['serialNo'];
        $barcode->barcodeNo = $request['barcodeNo'];
        $barcode->IMEINO = $request['barcodeNo'];
        $barcode->batchNo = $request['batchNo'];
        $barcode->save();
        $barcodeId = $barcode->id;

        if ($simNo != null) {
            foreach ($simNo as $key => $value) {
                $sim = new Sim;
                $sim->barcode_id = $barcodeId;
                $sim->simNo = $simNo[$key];
                $sim->ICCIDNo = $iccidNo[$key];
                $sim->validity = $validity[$key];
                $sim->operator = $operator[$key];
                $sim->save();
            }
        }
        return redirect()->back()->with("success", "Barcode Created!");

    }

    public function allocate()
    {
        $element = ManufacturerElement::with('element')->where('mfg_id', auth('manufacturer')->user()->id)->get();
        $allocatedBarcode = AllocatedBarCode::with('barcode', 'distributor', 'dealer')->where('mfg_id', auth('manufacturer')->user()->id)->get();
        return view("backend.barcode.allocate")->with(compact('element', 'allocatedBarcode'));
    }

    public function storeAllocate(Request $request)
    {
        //dd($request->all());
        $barcode = $request['allocated_barcodes'];
        try {
            foreach ($barcode as $value) {
                // echo $value;
                $allocate = new AllocatedBarCode();
                $allocate->mfg_id = auth('manufacturer')->user()->id;
                $allocate->distributor_id = $request['distributor'];
                $allocate->dealer_id = $request['dealer'];
                $allocate->barcode_id = $value;
                $allocate->save();
                $bar = BarCode::find($value);
                $bar->status = '1';
                $bar->save();
            }
            return redirect()->back()->with('success', 'Bar Code Allocated Successfully!');
        } catch (\Throwable $th) {
            //throw $th
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function allocatedDistributor()
    {
        $barcode = AllocatedBarCode::with('barcode','barcode.elementType','barcode.modelNo','barcode.modelNo','barcode.partNo')->where('distributor_id',auth('distributor')->user()->id)->get();
        // echo count($barcode);
        return view('backend.distributor.barcode')->with(compact('barcode'));
    }

    public function allocateDistributor()
    {
        $barcodes = AllocatedBarCode::with('barcode','barcode.elementType','barcode.modelNo','barcode.modelNo','barcode.partNo')->where('distributor_id',auth('distributor')->user()->id)->where('status','0')->get();
        
        return view('backend.distributor.allocateBarcode')->with(compact('barcodes'));
    }

    public function allocateDistributorStore(Request  $request){
        $request->validate([
            'district' => 'required',
            'dealer' => 'required',
            'barcode' => 'required',
        ]);
        
        $distributer = auth('distributor')->user();
        $barcodes = $request['barcode'];
        
        foreach ($barcodes as $barcode) {
        $allocateDevice = new AllocatedBarCode();
        $allocateDevice->mfg_id = $distributer->manuf_id;
        $allocateDevice->distributor_id = $distributer->id;
        $allocateDevice->dealer_id  = $request['dealer'];
        $allocateDevice->barcode_id  = $barcode;
        $allocateDevice->save();
        }

        return redirect()->back()->with('success','Barcode Allocated Successfully!');
        
        

    }


    public function allocatedDealer(){
     $user = Auth('dealer')->user();
     $barcode = AllocatedBarCode::where('dealer_id', $user->id)->get();
     return view('backend.dealer.allocatedbarcode')->with(compact('barcode'));
    }

    public function rollBack(){

    }
}
