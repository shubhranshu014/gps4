<?php
namespace App\Services;

use Exception;
use App\Models\Manufacturer;

class ManufacturerService
{
    public function index(){
        return Manufacturer::where("parent_id",auth("wlp")->user()->id)->get();
    }
    public function store($request)
    {
        try {
            $manufacturer = new Manufacturer();
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
        } catch (Exception $e) {
            error_log($e->getMessage());

            // Provide a more informative error message
            throw new Exception('Error storing Manufacturer with the specified columns: ' . $e->getMessage(), 0, $e);
        }
    }
}
