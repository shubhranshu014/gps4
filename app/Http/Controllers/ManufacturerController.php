<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ManufacturerRequest;
use App\Services\ManufacturerService;
use App\Models\Manufacturer;
class ManufacturerController extends Controller
{
    public function __construct(private ManufacturerService $manufacturerService){

    }
    public function index(){
        $mfg = $this->manufacturerService->index();
        return view("backend.manufacturer.index")->with(compact("mfg"));
    }

    public function store(ManufacturerRequest $request){
     try {
       $this->manufacturerService->store(request: $request);
       return redirect()->back()->with('success', 'Manufacturer Created Successfully!');
     } catch (\Exception $e) {
        // Log the error and return an error message
        \Log::error('Error storing Manuafacturer: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An error occurred while creating the manufacturer type.');
    }
    }

    public function delete($id){
     $mfg = Manufacturer::find($id);
     if ($mfg != null) {
        $mfg->delete();
        return redirect()->back()->with('delete','Manufacturer Deleted Successfully!');
     }
    }


    public function edit($id){
         $mfg = Manufacturer::find($id);
     if ($mfg != null) {
        return view('backend.manufacturer.edit')->with(compact('mfg'));
     }
    }

    public function update($id,Request $request){
            $manufacturer =  Manufacturer::find($id);
            $manufacturer->parent_id = $request["parent_name"];
            $manufacturer->country = $request["country"];
            $manufacturer->state = $request["state"];
            $manufacturer->code = $request["manufacturer_code"];
            $manufacturer->businees_name = $request["business_name"];
            $manufacturer->gst_no = $request["gst_number"];
            $manufacturer->name = $request["manufacturer_name"];
            $manufacturer->mobile_no = $request["mobile_no"];
            $manufacturer->email = $request["email"];
            $manufacturer->password = $request["mobile_no"];
            $manufacturer->passwordText = $request["mobile_no"];
            $manufacturer->address = $request["address"];
            $manufacturer->tollfreeNo = $request["toll_free_no"];
            $manufacturer->website = $request["website"];
            $manufacturer->address  = $request["address"];
            if ($request["logo"]) {
                $uploadedFileName = uploadFile($request["logo"], 'logo');
                $manufacturer->logo = $uploadedFileName;
            }
            $manufacturer->save();

            return redirect()->route('manufacturers')->with('success','Manufacturer Updated Successfully!');
    }


}
