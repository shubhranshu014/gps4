<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RtoModel;
class SettingMfgController extends Controller
{
    public function mfgSetting($setting = 'rtoSetting')
    {
        $setting = "rtoSetting";
        $view = "backend.setting.rto";
        $rto = RtoModel::all();
        return view("backend.setting.rto")->with(compact("rto"));
    }

    public function mfgSettingstore(Request $request, $setting = 'rtoSetting')
    {
        if ($setting = 'rtoSetting') {
            $request->validate(
                [
                    'state'=> 'required|string',
                    'district'=> 'required|string',
                    'rto'=> 'required|string',
                ]
            );
            $setting = new RtoModel();
            $setting->state = $request->state;
            $setting->district = $request->district;
            $setting->rto = $request->rto;
            $setting->save();
            return redirect()->back()->with('success', 'RTO Added Successfully!');
        } else {
            echo 'Only RTO SETTING ADDED';
        }


    }
}
