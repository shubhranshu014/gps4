<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distributor;
use App\Models\Dealer;
use App\Models\Technician;
use Illuminate\Support\Facades\Auth;

class TechnicianController extends Controller
{
    public function index()
    {
        if (Auth::guard('manufacturer')->check()) {
            $layouts = 'layouts.manufacturer';
            $distributor = Distributor::where("manuf_id", auth('manufacturer')->user()->id)->get();
            $dealer = [];
            foreach ($distributor as $key => $value) {
                $dealer = Dealer::with('distributor')->where('distributor_id', $distributor[$key]->id)->get();
            }

            $technician = [];
            foreach ($dealer as $key => $value) {
                $technician = Technician::with('dealer')->where('dealer_id', $dealer[$key]->id)->get();
            }
            return view("backend.technician.index")->with(compact('distributor', 'technician', 'layouts'));
        } else {
            $layouts = 'layouts.distributor';
            $dealer = Dealer::with('distributor')->where('distributor_id', auth('distributor')->user()->id)->get();
            $dealerIds = $dealer->pluck('id');
            $technician = Technician::with('dealer')->where('dealer_id', $dealerIds)->get();
            return view("backend.technician.index")->with(compact('technician', 'layouts','dealer'));
        }


    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'gender' => 'required|in:Male,Female',
            'email' => 'required|email|unique:technicians,email',
            'mobile_no' => 'required|digits:10',
            'aadhar' => 'required|digits:12',
            'dob' => 'required|date',
            'qulification' => 'required|string|max:255',
        ];
        if (Auth::guard('manufacturer')->check()) {

            $ruls = [
                'distributer' => 'required|exists:distributors,id',
                'dealer' => 'required|exists:dealers,id',
            ];
        }
        $request->validate($rules);

        $technician = new Technician();
        if (Auth::guard('manufacturer')->check()) {
         $technician->dealer_id = $request->input('dealer');
        }else {
            $technician->dealer_id = Auth('distributor')->user()->id;
            $technician->dealer_id = $request->input('dealer');
        }
       
        $technician->name = $request->input('name');
        $technician->gender = $request->input('gender');
        $technician->email = $request->input('email');
        $technician->mobile = $request->input('mobile_no');
        $technician->aadhar = $request->input('aadhar');
        $technician->dob = $request->input('dob');
        $technician->qualification = $request->input('qulification');
        $technician->save();
        return redirect()->back()->with('success', 'Technician Added Successfully!');
    }
}
