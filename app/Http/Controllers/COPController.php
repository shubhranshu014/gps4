<?php

namespace App\Http\Controllers;

use App\Models\Cop;
use Illuminate\Http\Request;
use App\Http\Requests\CopRequest;
use App\Services\CopService;
class COPController extends Controller
{
    public function __construct(private CopService $copService)
    {

    }
    public function index()
    {
        $loyout = 'layouts.super';
        $cop = $this->copService->index();
        return view("backend.cop.index", compact("cop", "loyout"));
    }
    public function store(CopRequest $copRequest)
    {
        try {
            // Pass the validated request data to ElementService for storage
            $this->copService->store($copRequest);

            // Redirect back with a success message
            return redirect()->route('cop')->with('success', 'COP created successfully!');
        } catch (\Exception $e) {
            // Log the error and return an error message
            \Log::error('Error storing element: ' . $e->getMessage());
            return redirect()->route('cop')->with('error', 'An error occurred while creating the COP.');
        }
    }

    public function destroy($copId)
    {
        $cop = Cop::findOrFail($copId);
        if (!$cop) {
            return redirect()->route('cop')->with('error', 'COP No Not Found!');
        }

        try {
            $cop->delete();
            return redirect()->route('cop')->with('success', 'COP No Deleted!');

        } catch (\Throwable $th) {
            return redirect()->route('cop')->with('error', 'COP No Not Deleted! Something went wrong!');
        }
    }

    public function update($copId, Request $request)
    {
        $cop = Cop::findOrFail($copId);
        if (!$cop) {
            return redirect()->route('cop')->with('error', 'COP No Not Found!');
        }

        try {

            $cop->COPNo = $request['copNo'];
            $cop->validTill = $request['copValidTill'];
            $cop->save();


            return redirect()->route('cop')->with('success', 'COP No Updated!');

        } catch (\Throwable $th) {
            return redirect()->route('cop')->with('error', 'COP No Not Updated! Something went wrong!');
        }
    }
}
