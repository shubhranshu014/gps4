<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use App\Models\Dealer;
use Illuminate\Support\Facades\Auth;

class DealerController extends Controller
{
    public function index()
    {
        if (Auth::guard('manufacturer')->check()) {
            // Manufacturer logged in
            $distributor = Distributor::where("manuf_id", auth('manufacturer')->user()->id)->get();
            $dealerIds = $distributor->pluck('id');
            $dealers = Dealer::with('distributor')->whereIn('distributor_id', $dealerIds)->get();
            $layouts = 'layouts.manufacturer';
            return view("backend.dealer.index", compact('distributor', 'dealers', 'layouts'));

        } elseif (Auth::guard('distributor')->check()) {
            // Distributor logged in
            $distributorId = auth('distributor')->user()->id;
            $dealers = Dealer::with('distributor')->where('distributor_id', $distributorId)->get();
            $layouts = 'layouts.distributor';
            return view("backend.dealer.index", compact('dealers', 'layouts'));
        }

        abort(403, 'Unauthorized'); // Optional safety fallback


    }

    public function store(Request $request)
    {

        $request->validate([
            // 'distributer' => ['required', 'exists:distributors,id'],
            'business_name' => 'required|string| max:255',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:dealers,email'],
            'gender' => ['required', 'in:Male,Female'],
            'mobile' => ['required', 'digits:10'],
            'date_of_birth' => ['required', 'date'],
            // 'age' => ['required', 'integer', 'min:1'],
            'is_map_device_edit' => ['required', 'in:yes,no'],
            'pan_number' => ['required', 'string'], // PAN format
            'occupation' => ['required', 'string'],
            'advance_payment' => ['required', 'numeric', 'min:0'],
            'language_known' => ['required', 'array'],
            'language_known.*' => ['in:english,hindi,odiya'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'district' => ['required', 'string'],
            'rto' => ['required', 'array'],
            // 'rto.*' => ['string'],
            'pincode' => ['required', 'digits:6'],
            'area' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);



        $dealer = new Dealer();
        $dealer->distributor_id = $request['distributer'];
        $dealer->business_name = $request['business_name'];
        $dealer->name = $request['name'];
        $dealer->email = $request['email'];
        $dealer->password = $request['mobile'];
        $dealer->passwordText = $request['mobile'];
        $dealer->gender = $request['gender'];
        $dealer->mobile = $request['mobile'];
        $dealer->dob = $request['date_of_birth'];
        $dealer->is_map_device_edit = $request['is_map_device_edit'];
        $dealer->pan_number = $request['pan_number'];
        $dealer->occupation = $request['occupation'];
        $dealer->advance_payment = $request['advance_payment'];
        $dealer->language_known = implode(',', $request['language_known']);
        $dealer->country = $request['country'];
        $dealer->state = $request['state'];
        $dealer->rto_devision = $request['rto'];
        $dealer->district = $request['district'];
        $dealer->pincode = $request['pincode'];
        $dealer->area = $request['area'];
        $dealer->address = $request['address'];
        $dealer->save();
        return redirect()->back()->with('success', 'Dealer Created Succesfully!');
    }
}
