<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\MapDevice;
use App\Models\Distributor;
use App\Models\Dealer;
use App\Models\MapDeviceDetails;
use App\Models\BarCode;
use App\Models\AllocatedBarCode;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    public function map(Request $request)
    {
        // dd(Auth::guard('distributor')->check());
        // $subscriptions = Subscription::where("mfg_id", Auth('distributor')->user()->manuf_id)->get();

        if (Auth::guard('manufacturer')->check()) {
            $manufacturerId = auth('manufacturer')->user()->id;
            $subscriptions = Subscription::where("mfg_id", $manufacturerId)->get();
            $layout = 'layouts.manufacturer';
            $distributors = Distributor::where('manuf_id', auth('manufacturer')->user()->id)->get();

            $mapDevices = [];  // Initialize an array to hold all map devices

            // Iterate over distributors
            foreach ($distributors as $distributor) {
                // Get dealers for the current distributor
                $dealers = Dealer::where('distributor_id', $distributor->id)->get();

                // Iterate over dealers
                foreach ($dealers as $dealer) {
                    // Get map devices for the current dealer and merge them into the $mapDevices array
                    $mapDevices = array_merge($mapDevices, MapDeviceDetails::with('barcodes', 'dealer', 'cusmtomer')->where('dealer_id', $dealer->id)->get()->all());
                }
            }

            return view('backend.device.map')->with(compact('subscriptions', 'mapDevices', 'layout'));

        } elseif (Auth::guard('distributor')->check()) {
            $distributorId = auth('distributor')->user()->id;
            $dealers = Dealer::where('distributor_id', $distributorId)->get();
            $layout = 'layouts.distributor';
            $mapDevices = [];
            // Iterate over dealers
            foreach ($dealers as $dealer) {
                // Get map devices for the current dealer and merge them into the $mapDevices array
                $mapDevices = array_merge($mapDevices, MapDeviceDetails::with('barcodes', 'dealer', 'cusmtomer')->where('dealer_id', $dealer->id)->get()->all());
            }
            $subscriptions = Subscription::where("mfg_id", auth('distributor')->user()->manuf_id)->get();
            return view('backend.device.map')->with(compact('subscriptions', 'mapDevices', 'dealers', 'layout'));

        } elseif (Auth::guard('dealer')->check()) {
            $dealerId = auth('dealer')->user()->id;
            $dealer = Dealer::where('id', $dealerId)->first();
            $layout = 'layouts.dealer';
            $mapDevices = MapDeviceDetails::with('barcodes', 'dealer', 'cusmtomer')->where('dealer_id', Auth('dealer')->user()->id)->get();
            $subscriptions = Subscription::where("mfg_id", $dealer->distributor->manuf_id)->get();
            return view('backend.device.map')->with(compact('subscriptions', 'mapDevices', 'dealer', 'layout'));
        } else {
            $technicianId = auth('technician')->user()->id;
            $layout = 'layouts.technician';
            $technician = Technician::find($technicianId);
            $dealer = Dealer::where('id', $technician->dealer_id)->first();
            $mapDevices = MapDeviceDetails::with('barcodes', 'dealer', 'cusmtomer')->where('dealer_id', $technician->dealer_id)->get();
            $subscriptions = Subscription::where("mfg_id", $dealer->distributor->manuf_id)->get();
            return view('backend.device.map')->with(compact('subscriptions', 'mapDevices', 'dealer', 'layout'));
        }

    }


    public function store(Request $request)
    {
        $request->validate(
            [

                'customerName' => 'required|string|max:50',
                'customerEmail' => 'required|email|max:50',
                'customerMobile' => 'required',
                'state' => 'required',
                'coustomerDistrict' => 'required',
                'coustomerPincode' => 'required',
                'coustomeraddress' => 'required',
                'rto_devision' => 'required',
                'dealer' => 'required',
                'subscriptionpackage' => 'required',
                'deviceType' => 'required',
                'deviceNo' => 'required',
                'vehicleBirth' => 'required',
                'regNumber' => 'required',
                'regdate' => 'required',
                'chassisNumber' => 'required',
                'engineNumber' => 'required',
                'vehicleType' => 'required',
                'vaiclemodel' => 'required',
                'vaimodelyear' => 'required',
                'vaicleinsurance' => 'required',
                'pollutiondate' => 'required',
                'technician' => 'required',
                'InvoiceNo' => 'required',
                'VehicleKMReading' => 'required',
                'DriverLicenseNo' => 'required',
                'MappedDate' => 'required',
                'NoOfPanicButtons' => 'required',
                'vehicleimg' => 'required',
                'vehiclerc' => 'required',
                'vaicledeviceimg' => 'required',
                'pancardimg' => 'required',
                'aadharcardimg' => 'required',
                'invoiceimg' => 'required',
                'signatureimg' => 'required',
                'panicbuttonimg' => 'required',

            ],
        );
        try {
            $user = MapDevice::where('customer_email', $request['customerEmail'])->orWhere('customer_mobile', $request['customerMobile'])->first();
            if ($user != null) {
                $user_id = $user->id;
            } else {
                $mapDevice = new MapDevice();
                $mapDevice->customer_name = $request['customerName'];
                $mapDevice->customer_email = $request['customerEmail'];
                $mapDevice->password = $request['customerMobile'];
                $mapDevice->passwordText = $request['customerMobile'];
                $mapDevice->customer_mobile = $request['customerMobile'];
                $mapDevice->customer_gst_no = $request['customergstin'];
                $mapDevice->customer_state = $request['state'];
                $mapDevice->customer_district = $request['coustomerDistrict'];
                $mapDevice->customer_arear = $request['coustomerArea'];
                $mapDevice->customer_pincode = $request['coustomerPincode'];
                $mapDevice->customer_address = $request['coustomeraddress'];
                $mapDevice->customer_rto_division = $request['rto_devision'];
                $mapDevice->customer_aadhaar = $request['customeraadhar'];
                $mapDevice->customer_pan = $request['customerpanno'];
                $mapDevice->save();
                $user_id = $mapDevice->id;
            }

            $deviceDetails = new MapDeviceDetails();
            $deviceDetails->mapDevice_id = $user_id;
            $deviceDetails->dealer_id = $request['dealer'];
            $deviceDetails->package_id = $request['subscriptionpackage'];
            $deviceDetails->device_type = $request['deviceType'];
            $deviceDetails->device_seriel_no = $request['deviceNo'];
            $deviceDetails->vehicle_birth = $request['vehicleBirth'];
            $deviceDetails->vehicle_registration_number = $request['regNumber'];
            $deviceDetails->date = $request['regdate'];
            $deviceDetails->vehicle_chassis_no = $request['chassisNumber'];
            $deviceDetails->vehicle_engine_no = $request['engineNumber'];
            $deviceDetails->vehicle_type = $request['vehicleType'];
            $deviceDetails->vehicle_make_model = $request['vaiclemodel'];
            $deviceDetails->vehicle_model_year = $request['vaimodelyear'];
            $deviceDetails->vehicle_insurance_renew_date = $request['vaicleinsurance'];
            $deviceDetails->vehicle_pollution_renew_date = $request['pollutiondate'];
            $deviceDetails->technician_id = $request['technician'];
            $deviceDetails->invoice_no = $request['InvoiceNo'];
            $deviceDetails->vehicle_km_reading = $request['VehicleKMReading'];
            $deviceDetails->driver_license_no = $request['DriverLicenseNo'];
            $deviceDetails->mapped_date = $request['MappedDate'];
            $deviceDetails->no_of_panic_buttons = $request['NoOfPanicButtons'];
            if ($request['vehicleimg'] != null) {
                $uploadedFileName = uploadFile($request["vehicleimg"], 'vehicleimg');
                // $manufacturer->logo = $uploadedFileName;

                // $vehicleimgfilePath = $request->file('vehicleimg')->store('uploads', 'private');
                $deviceDetails->vehicle = $uploadedFileName;
            }
            if ($request['vehiclerc'] != null) {
                $uploadedFileName = uploadFile($request["vehiclerc"], 'vehiclerc');

                // $vehiclercfilePath = $request->file('vehiclerc')->store('uploads', 'private');
                $deviceDetails->rc = $uploadedFileName;
            }

            if ($request['vaicledeviceimg'] != null) {
                $uploadedFileName = uploadFile($request["vaicledeviceimg"], 'vaicledeviceimg');

                // $vaicledeviceimgfilePath = $request->file('vaicledeviceimg')->store('uploads', 'private');
                $deviceDetails->device = $uploadedFileName;
            }

            if ($request['pancardimg'] != null) {
                $uploadedFileName = uploadFile($request["pancardimg"], 'pancardimg');

                // $pancardimgfilePath = $request->file('pancardimg')->store('uploads', 'private');
                $deviceDetails->pan = $uploadedFileName;
            }

            if ($request['aadharcardimg'] != null) {
                $uploadedFileName = uploadFile($request["pancardimg"], 'pancardimg');

                // $aadhaarfilePath = $request->file('aadharcardimg')->store('uploads', 'private');
                $deviceDetails->aadhaar = $uploadedFileName;
            }
            if ($request['invoiceimg'] != null) {
                $uploadedFileName = uploadFile($request["invoiceimg"], 'invoiceimg');

                // $invoiceimgfilePath = $request->file('invoiceimg')->store('uploads', 'private');
                $deviceDetails->invoice = $uploadedFileName;
            }
            if ($request['signatureimg'] != null) {
                $uploadedFileName = uploadFile($request["signatureimg"], 'signatureimg');

                // $signatureimgfilePath = $request->file('signatureimg')->store('uploads', 'private');
                $deviceDetails->signature = $uploadedFileName;
            }
            if ($request['panicbuttonimg'] != null) {
                $uploadedFileName = uploadFile($request["panicbuttonimg"], 'panicbuttonimg');

                // $panicbuttonimgfilePath = $request->file('panicbuttonimg')->store('uploads', 'private');
                $deviceDetails->panic_button = $uploadedFileName;
            }
            $deviceDetails->save();
            $barcode = BarCode::find($request['deviceNo']);
            $barcode->status = '2';
            $barcode->save();
            $allocatedBarcode = AllocatedBarCode::where('barcode_id', $request['deviceNo'])->first();
            $status = AllocatedBarCode::find($allocatedBarcode->id);
            $status->status = '1';
            $status->save();
            return redirect()->back()->with('success', 'Device Mapped successfully!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
}
