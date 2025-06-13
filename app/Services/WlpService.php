<?php
namespace App\Services;

use Exception;
use App\Models\Wlp;


class WlpService
{
    public function index()
    {
        return Wlp::all();
    }
    public function store($request)
    {
        try {
            $wlp = new Wlp();
            $wlp->admin_id = auth('admin')->user()->id;
            $wlp->country = $request['country'];
            $wlp->state = $request['state'];
            $wlp->default_lan = $request['language'];
            $wlp->name = $request['name'];
            $wlp->mobile_no = $request['mobile_no'];
            $wlp->sales_mobile_no = $request['sales_mobile_no'];
            $wlp->sales_landline_no = $request['landline_no'];
            $wlp->email = $request['email_id'];
            $wlp->password = $request['mobile_no'];
            $wlp->passwordText = $request['mobile_no'];
            $wlp->smart_parent_app_package = $request['smart_parent_app_package'];
            $wlp->show_powered_by = $request['show_powered_by'];
            $wlp->power_by = $request['power_by'];
            $wlp->account_limit = $request['account_limit'];
            $wlp->http_sms_url = $request['http_sms_url'];
            $wlp->http_sms__gateway_method = $request['http_sms__gateway_method'];
            $wlp->gstn_no = $request['gstn_no'];
            $wlp->billing_email = $request[''];
            $wlp->isallowthirdpartyapi = $request[''];
            $wlp->weburl = $request['web_url'];
            if ($request["logo"]) {
                $uploadedFileName = uploadFile($request["logo"], 'logo');
                $wlp->logo = $uploadedFileName;
            }

            $wlp->address = $request['address'];
            $wlp->save();
        } catch (\Throwable $th) {
            \Log::error('Error storing WLP: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the WLP.');
        }
    }

    public function update($request, $id)
    {
        $wlp = Wlp::find($id);
        $wlp->country = $request['country'];
        $wlp->state = $request['state'];
        $wlp->default_lan = $request['language'];
        $wlp->name = $request['name'];
        $wlp->mobile_no = $request['mobile_no'];
        $wlp->sales_mobile_no = $request['sales_mobile_no'];
        $wlp->sales_landline_no = $request['landline_no'];
        $wlp->email = $request['email_id'];
        $wlp->password = $request['mobile_no'];
        $wlp->passwordText = $request['mobile_no'];
        $wlp->smart_parent_app_package = $request['smart_parent_app_package'];
        $wlp->show_powered_by = $request['show_powered_by'];
        $wlp->power_by = $request['power_by'];
        $wlp->account_limit = $request['account_limit'];
        $wlp->http_sms_url = $request['http_sms_url'];
        $wlp->http_sms__gateway_method = $request['http_sms__gateway_method'];
        $wlp->gstn_no = $request['gstn_no'];
        $wlp->billing_email = $request[''];
        $wlp->isallowthirdpartyapi = $request[''];
        $wlp->weburl = $request['web_url'];
        if ($request["logo"]) {
            $uploadedFileName = uploadFile($request["logo"], 'logo');
            $wlp->logo = $uploadedFileName;
        }

        $wlp->address = $request['address'];
        $wlp->save();
    }
}