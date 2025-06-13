<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistributorRequest;
use App\Services\DistributorService;
use App\Models\Distributor;
// use Illuminate\Http\Request;
class DistributorController extends Controller
{
    public function __construct(private DistributorService $distributorService)
    {

    }
    public function index()
    {
        $distributors = $this->distributorService->index();
        return view("backend.distributor.index")->with(compact('distributors'));
    }

    public function store(DistributorRequest $request)
    {
        // dd($request->all());

        try {
            $this->distributorService->store($request);
            return redirect()->back()->with('success', 'Distributor Created Successfully!.');
        } catch (\Exception $e) {
            // Log the error and return an error message
            \Log::error('Error storing element: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the Distributor.');
        }
    }

    public function delete($id)
    {
        $distributor = Distributor::find($id);
        if ($distributor != null) {
            $distributor->delete();
            return redirect()->back()->with('delete', 'Distributor Deleted Suuccessfully!');
        }
        return redirect()->back();
    }


    public function edit($id)
    {
        $distributor = Distributor::find($id);
        if ($distributor != null) {
            return view('backend.distributor.edit')->with(compact('distributor'));
        }
        return redirect()->back();
    }
}
