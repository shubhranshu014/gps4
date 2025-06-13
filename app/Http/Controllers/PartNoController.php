<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartNoRequest;
use App\Models\PartNo;
use App\Services\PartNoService;
use Illuminate\Http\Request;
class PartNoController extends Controller
{
    public function __construct(private PartNoService $partNoService)
    {

    }

    public function index()
    {
        $layout = "layouts.super";
        $partNo = $this->partNoService->index();
        return view("backend.partNo.index")->with(compact("layout", 'partNo'));
    }
    public function store(PartNoRequest $request)
    {

        try {
            // Pass the validated request data to ElementService for storage
            $this->partNoService->store($request);
            // Redirect back with a success message
            return redirect()->route('parts')->with('success', 'Part number created successfully!');
        } catch (\Exception $e) {
            // Log the error and return an error message
            \Log::error('Error storing element: ' . $e->getMessage());
            return redirect()->route('parts')->with('error', 'An error occurred while creating the part number.');
        }
    }

    public function destroy($partId)
    {
        try {
            $partNo = PartNo::find($partId);
            $partNo->delete();
            return redirect()->route('parts')->with('success', 'Device Part Number Deleted!');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('parts')->with('error', 'Device Part Number Not Deleted! Something Went Wrong.');

        }
    }

    public function update($partId, Request $request)
    {
        try {
            $partNo = PartNo::findOrFail($partId );
            $partNo->part_no = $request['part_no'];
            $partNo->save();
            return redirect()->route('parts')->with('success', 'Device Part Number Updated!');
        } catch (\Throwable $th) {
            return redirect()->route('parts')->with('error', 'Device Part Number Not Updated! Something Went Wrong!');
        }
    }
}
