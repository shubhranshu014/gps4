<?php
namespace App\Services;

use App\Http\Requests\AdminRequest;
use Exception;
use App\Models\Admin;
class AdminService
{
    public function store($adminData)
    {
        $admin = new Admin;
        $admin->business_name = $adminData["name_of_the_business"];
        $admin->regd_address = $adminData["regd_address"];
        $admin->gstin_no = $adminData["gstin_no"];
        $admin->pan_no = $adminData["pan_no"];
        $admin->name = $adminData["name_of_the_business_owner"];
        $admin->email = $adminData["email"];
        $admin->password = $adminData["contact_no"];
        $admin->password_text = $adminData["contact_no"];
        $admin->contact_no = $adminData["contact_no"];
        if ($adminData["gst_certificate"]) {
            $uploadedFileName = uploadFile($adminData["gst_certificate"], 'gst_certificate');
            $admin->gst_certificate = $uploadedFileName;
        }

        if ($adminData['pan_card']) {
            $uploadedFileName = uploadFile($adminData["pan_card"], 'pan_card');
            $admin->pan_card = $uploadedFileName;
        }

        if ($adminData['incorporation_certificate']) {
            $uploadedFileName = uploadFile($adminData["incorporation_certificate"], 'incorporation_certificate');
            $admin->incorporation_certificate = $uploadedFileName;
        }

        if ($adminData['company_logo']) {
            $uploadedFileName = uploadFile($adminData["company_logo"], 'company_logo');
            $admin->logo = $uploadedFileName;
        }

        $admin->save();

    }

    public function update($request, $id)
    {
        $details = Admin::findOrFail($id);
        // Update the Admindetails model
        $details->business_name = $request["business_name"];
        $details->regd_address = $request["regd_address"];
        $details->gstin_no = $request["gstin_no"];
        $details->pan_no = $request["pan_no"];
        $details->name = $request["name_of_the_business_owner"];
        $details->email = $request["email"];
        $details->password = $request["contact_no"];
        $details->password_text = $request["contact_no"];
        $details->contact_no = $request["contact_no"];
        $details->name = $request['name'];

        // Check and update files if they are uploaded
        if ($request->hasFile('gst_certificate')) {
            $gst_certificate = time() . rand(1, 99) . 'gst.' . $request['gst_certificate']->extension();
            $request['gst_certificate']->storeAs('uploads', $gst_certificate);
            $details->gst_certificate = $gst_certificate;
        }

        if ($request->hasFile('pan_card')) {
            $pan_filename = time() . rand(1, 99) . 'pan.' . $request['pan_card']->extension();
            $request['pan_card']->storeAs('uploads', $pan_filename);
            $details->pan_card = $pan_filename;
        }

        if ($request->hasFile('incorporation_certificate')) {
            $incorporation_certificate = time() . rand(1, 99) . 'incorporation_certificate.' . $request['incorporation_certificate']->extension();
            $request['incorporation_certificate']->storeAs('uploads', $incorporation_certificate);
            $details->incorporation_certificate = $incorporation_certificate;
        }

        if ($request->hasFile('company_logo')) {
            $logo = time() . rand(1, 99) . 'logo.' . $request['company_logo']->extension();
            $request['company_logo']->storeAs('uploads', $logo);
            $details->logo = $logo;
        }
        $details->save();
    }
}
