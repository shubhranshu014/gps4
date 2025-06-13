<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignElementAdmin;
use App\Models\WlpElement;
class AssignedElementController extends Controller
{
    //for admin
    public function index($id)
    {
        if ($id) {
            $layout = "layouts.admin";
            $element = AssignElementAdmin::with('element')->where("admin_id", $id)->get();
            return view("backend.element.assigned")->with(compact("element","layout"));
        }
        
    }

    public function wlp(){
        $element = WlpElement::with('element')->where("wlp_id",auth('wlp')->user()->id)->get();
        return view('backend.element.assignedToWlp')->with(compact('element'));
    }

}
