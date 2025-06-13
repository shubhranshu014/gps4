<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::where('mfg_id',auth("manufacturer")->user()->id)->get();
        return view("backend.subscription.index")->with(compact("subscriptions"));
    }

    public function store(Request $request)
    {
        $request->validate(
            $rules = [
                'packageType' => 'required|in:TRACKER,OFFERED',
                'packageName' => 'required|string|max:50',
                'billingCycle' => 'required',
                'price' => 'required|numeric|min:0',
                'description' => 'required|string|max:250',
                'renewalcheckbox' => 'nullable',
            ]
        
            );
        try {
            $subscription = new Subscription();
            $subscription->mfg_id = auth("manufacturer")->user()->id;
            $subscription->packageType = $request['packageType'];
            $subscription->packageName = $request['packageName'];
            $subscription->billingCycle = $request['billingCycle'];
            $subscription->description = $request['description'];
            $subscription->price = $request['price'];
            $subscription->isRenewal = $request['renewalcheckbox'];
            $subscription->save();
            return redirect()->back()->with('success','Subscription created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function edit($id){
        $subscription = Subscription::find($id);
        if ($subscription != null && $subscription->mfg_id == auth('manufacturer')->user()->id) {
           return view('backend.subscription.edit')->with(compact('subscription'));
        }
    }

    public function update(Request $request, $id){
        $request->validate(
            $rules = [
                'packageType' => 'required|in:TRACKER,OFFERED',
                'packageName' => 'required|string|max:50',
                'billingCycle' => 'required',
                'price' => 'required|numeric|min:0',
                'description' => 'required|string|max:250',
                'renewalcheckbox' => 'nullable',
            ]
        
            );
        if ($id != null) {
            try {
                $subscription = Subscription::find($id);
                $subscription->mfg_id = auth("manufacturer")->user()->id;
                $subscription->packageType = $request['packageType'];
                $subscription->packageName = $request['packageName'];
                $subscription->billingCycle = $request['billingCycle'];
                $subscription->description = $request['description'];
                $subscription->price = $request['price'];
                $subscription->isRenewal = $request['renewalcheckbox'];
                $subscription->save();
                return redirect()->route('subscriptions')->with('success','Subscription edited successfully!');
            } catch (\Throwable $th) {
                return redirect()->route('subscriptions')->with('error', $th->getMessage());
            }
        }
    }
}
