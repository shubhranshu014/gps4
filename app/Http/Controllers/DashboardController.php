<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Wlp;
use App\Models\Element;
use Illuminate\Support\Collection;
use App\Models\AssignElementAdmin;
use App\Models\WlpElement;
use App\Models\Manufacturer;
use App\Models\Distributor;
use App\Models\Dealer;
use App\Models\Technician;
use App\Models\BarCode;



class DashboardController extends Controller
{
    public function index()
    {
        $layout = 'layouts.super';
        $admins = Admin::all();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $adminCountThisWeek = Admin::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $wlp = Wlp::all();
        $elements = Element::all();

        // Get 5 latest from each model and map to unified structure
        $recentAdmins = Admin::latest()->take(5)->get()->map(function ($admin) {
            return (object) [
                'type' => 'Admin',
                'name' => $admin->name,
                'created_at' => $admin->created_at,
            ];
        });

        $recentWlps = Wlp::latest()->take(5)->get()->map(function ($wlp) {
            return (object) [
                'type' => 'WLP',
                'name' => $wlp->title ?? 'Untitled',
                'created_at' => $wlp->created_at,
            ];
        });

        $recentElements = Element::latest()->take(5)->get()->map(function ($element) {
            return (object) [
                'type' => 'Element',
                'name' => $element->name ?? 'Unnamed',
                'created_at' => $element->created_at,
            ];
        });

        // Merge and sort using Laravel Collection
        $recentActivities = collect()
            ->merge($recentAdmins)
            ->merge($recentWlps)
            ->merge($recentElements)
            ->sortByDesc('created_at')
            ->values(); // Reset keys


        return view('backend.dashboard')->with(compact('layout', 'admins', 'adminCountThisWeek', 'wlp', 'elements', 'recentActivities'));
    }


    public function admin()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $wlpCountThisWeek = Wlp::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $wlp = Wlp::where('admin_id', auth('admin')->user()->id)->count();
        $element = AssignElementAdmin::where('admin_id', auth('admin')->user()->id)->count();
        $layout = 'layouts.admin';
        $adminId = auth('admin')->user()->id;

        // Recent WLPs
        $recentWlps = Wlp::where('admin_id', $adminId)
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {
                $item->type = 'wlp';
                return $item;
            });

        // Recent WLP Elements
        $recentWlpElements = WlpElement::where('admin_id', $adminId)
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {
                $item->type = 'wlpelement';
                return $item;
            });


        $recentActivities = collect()
            ->merge($recentWlps)
            ->merge($recentWlpElements)
            ->sortByDesc('created_at')
            ->values(); // Reset keys

        // Merge and sort both collections by created_at


        return view('backend.admin.dashbord')->with(compact('layout', 'element', 'wlp', 'wlpCountThisWeek', 'recentActivities'));
    }

    public function wlp()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $mfgCountThisWeek = Manufacturer::where('parent_id', auth('wlp')->user()->id)->whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
        $mfg = Manufacturer::where('parent_id', auth('wlp')->user()->id)->count();
        $elements = WlpElement::where('admin_id', auth('wlp')->user()->id)->count();

        $userId = auth('wlp')->user()->id;

        // Get recent Manufacturer records
        $recentManufacturers = Manufacturer::where('parent_id', $userId)
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {
                $item->type = 'manufacturer';
                return $item;
            });

        // Get recent WlpElement records
        $recentElements = WlpElement::where('admin_id', $userId)
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {
                $item->type = 'wlpelement';
                return $item;
            });

        // Merge and sort by created_at descending
        $recentActivity = collect()
            ->merge($recentManufacturers)
            ->merge($recentElements)
            ->sortByDesc('created_at')
            ->values();
        return view('backend.wlp.dashboard')->with(compact('mfg', 'mfgCountThisWeek', 'elements', 'recentActivity'));
    }


    public function manufacturer()
    {
        $distributors = Distributor::with(['dealers.technicians']) // eager load dealers and their technicians
            ->where('manuf_id', auth('manufacturer')->user()->id)
            ->get();

        //Optional: Flatten all technicians if needed
        $allTechnicians = collect();

        foreach ($distributors as $distributor) {
            // echo $distributor->dealers;
            foreach ($distributor->dealers as $dealer) {

                $allTechnicians = $allTechnicians->merge($dealer->technicians);
                // echo count($allTechnicians);
            }
        }


        $totalDevice = BarCode::where('mfg_id', auth('manufacturer')->user()->id)->count();

        $totalDeviceActive = BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', 0)->count();

        $totalDeviceAllocated = BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', 1)->count();
        $totalDeviceAllocatedToday = BarCode::where('mfg_id', auth('manufacturer')->user()->id)
            ->where('status', 1)
            ->whereDate('updated_at', Carbon::today())
            ->count();

        $totalDeviceAllocatedThisMonth = BarCode::where('mfg_id', auth('manufacturer')->user()->id)
            ->where('status', 1)
            ->whereMonth('updated_at', Carbon::now()->month)
            ->whereYear('updated_at', Carbon::now()->year)
            ->count();

        $totalMapDevice = BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', 2)->count();

        $totalDeviceMapToday = BarCode::where('mfg_id', auth('manufacturer')->user()->id)
            ->where('status', 2)
            ->whereDate('updated_at', Carbon::today())
            ->count();

         $totalDeviceMapThisMonth = BarCode::where('mfg_id', auth('manufacturer')->user()->id)
            ->where('status', 2)
            ->whereMonth('updated_at', Carbon::now()->month)
            ->whereYear('updated_at', Carbon::now()->year)
            ->count();
        return view('backend.manufacturer.dashboard')->with(compact('distributors', 'allTechnicians', 'totalDevice', 'totalDeviceActive', 'totalDeviceAllocated', 'totalDeviceAllocatedToday', 'totalDeviceAllocatedThisMonth', 'totalMapDevice', 'totalDeviceMapToday','totalDeviceMapThisMonth'));
    }

    public function distributor(){
        return view('backend.distributor.dashboard');
    }

    public function dealer(){
        return view('backend.dealer.dashboard');
    }
}
