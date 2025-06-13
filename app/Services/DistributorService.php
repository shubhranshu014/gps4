<?php
namespace App\Services;

use Exception;
use App\Models\Distributor;

class DistributorService
{

    public function index()
    {
        return $distributors = Distributor::where('manuf_id', auth('manufacturer')->user()->id)->get();
    }
    public function store($request)
    {
        try {
            $distributor = new Distributor();
            $distributor->manuf_id = auth("manufacturer")->user()->id;
            $distributor->business_name = $request['business_name'];
            $distributor->name = $request['business_name'];
            $distributor->email = $request['email'];
            $distributor->password = $request['mobile'];
            $distributor->passwordText = $request['mobile'];
            $distributor->gender = $request['gender'];
            $distributor->mobile = $request['mobile'];
            $distributor->dob = $request['date_of_birth'];
            $distributor->is_map_device_edit = $request['is_map_device_edit'];
            $distributor->pan_number = $request['pan_number'];
            $distributor->occupation = $request['occupation'];
            $distributor->advance_payment = $request['advance_payment'];
            $distributor->language_known = implode(', ', $request['language_known']);
            $distributor->country = $request['country'];
            $distributor->state = $request['state'];
            // $distributor->rto_devision = $request['rto_devision'];
            $distributor->districts = $request['districts'];
            // $distributor->pincode = $request['pincode'];
            // $distributor->area = $request['area'];
            $distributor->address = $request['address'];
            $distributor->save();

        } catch (\Throwable $th) {
            throw new Exception('Error storing distributor: ' . $th->getMessage());
        }
    }
}