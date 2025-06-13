<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AssignElementAdminRequest;
use App\Models\AssignElementAdmin;
use App\Models\Wlp;
use App\Models\WlpElement;
use App\Models\Manufacturer;
use App\Models\ManufacturerElement;
class ElementAssignController extends Controller
{
    public function index()
    {

        // 
        // if (auth()->guard() == "web") {
        //     $layout = 'layouts.super';
        //     $admin = \App\Models\Admin::all();
        //    
        //     return view("backend.element.assign")->with(compact("admin", "element", "layout", 'assignElements'));
        // } else {
        //     $layout = 'layouts.admin';
        //     $wlp = \App\Models\Wlp::all();
        //     return view("backend.element.assign")->with(compact("wlp", "element", "layout"));
        // }
        $assignElements = AssignElementAdmin::all();
        $element = \App\Models\Element::all();
        $layout = 'layouts.super';
        $admin = \App\Models\Admin::all();
        return view("backend.element.assign")->with(compact("admin", "element", "layout", 'assignElements'));
    }

    public function store(AssignElementAdminRequest $request)
    {
        $elements = $request['element'];
        try {
            echo count($elements);
            foreach ($elements as $value) {
                $assign = new AssignElementAdmin();
                $assign->admin_id = $request['admin'];
                $assign->element_id = $value;
                $assign->save();
            }

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Element Assigned successfully!');
        } catch (\Exception $e) {
            // Log the error and return an error message
            \Log::error('Error storing element: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while assining element to admin.');
        }

    }

    public function assignToWlp()
    {
        $element = AssignElementAdmin::with('element')->where("admin_id", auth('admin')->user()->id)->get();
        $Wlp = Wlp::where('admin_id', auth('admin')->user()->id)->get();
        $assignElements = WlpElement::with('wlp','element')->where("admin_id",auth("admin")->user()->id)->get();
        return view('backend.element.assignToWlp')->with(compact('element', 'Wlp','assignElements'));
    }


    public function assignToWlpStore(Request $request)
    {
        $elements = $request['element'];
        try {
            foreach ($elements as $value) {
                $wlpElement = new WlpElement();
                $wlpElement->admin_id = auth('admin')->user()->id;
                $wlpElement->wlp_id = $request['wlp'];
                $wlpElement->element_id = $value;
                $wlpElement->save();
            }
            return redirect()->back()->with('success', 'Elements Assigned Successfully!');
        } catch (\Throwable $th) {
            \Log::error('Error storing element: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while assigning elements to WLP.');
        }
    }

    public function assignToMfg(){
        $element = WlpElement::with('element')->where("wlp_id", auth('wlp')->user()->id)->get();
        $mfg = Manufacturer::where('parent_id',auth('wlp')->user()->id)->get();
        $assignedEleement = ManufacturerElement::with('mfg','element')->where('wlp_id',auth('wlp')->user()->id)->get();
        return view('backend.element.assignToMfg')->with(compact('element','mfg','assignedEleement'));
    }
    public function assignToMfgStore(Request $request){
        $element = $request['element'];
        try {
            foreach ($element as $value) {
                $mfgElement = new ManufacturerElement();
                $mfgElement->wlp_id = auth('wlp')->user()->id;
                $mfgElement->mfg_id = $request['manufacturer'];
                $mfgElement->element_id = $value;
                $mfgElement->save();
            }
            return redirect()->back()->with('success', 'Element Assigned Successfully!.');
        } catch (\Throwable $th) {
            \Log::error('Error storing element: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while assigning elements to manufacturer.');
        }
    }
}
