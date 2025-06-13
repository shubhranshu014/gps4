<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModelRequest;
use App\Models\ModelNo;
use App\Services\ModelNoService;
class ModelController extends Controller
{
    public function __construct(private ModelNoService $modelNoService)
    {

    }

    public function index()
    {
        $layout = "layouts.super";
        $modelNo = $this->modelNoService->index();
        return view("backend.model.index")->with(compact("layout", "modelNo"));
    }
    public function store(ModelRequest $request)
    {

        try {
            // Pass the validated request data to ElementService for storage
            $this->modelNoService->store($request);
            // Redirect back with a success message
            return redirect()->route('modelNo')->with('success', 'Model number created successfully!');
        } catch (\Exception $e) {
            // Log the error and return an error message
            \Log::error('Error storing element: ' . $e->getMessage());
            return redirect()->route('modelNo')->with('error', 'An error occurred while creating the model number.');
        }
    }
    public function destroy($modelId)
    {
        $modelNo = ModelNo::find($modelId);

        // Check if the model exists
        if (!$modelNo) {
            // If the model is not found, return an error response
            return redirect()->back()->with('error', 'Device Model No not found.');
        }

        try {
            // Proceed with deletion
            $modelNo->delete();

            // Redirect with a success message after deletion
            return redirect()->back()->with('success', 'Device Model No deleted successfully.');
        } catch (\Exception $e) {
            // Handle any error during the deletion process
            return redirect()->back()->with('error', 'An error occurred while trying to delete the Device Model No.');
        }
    }

    public function update(ModelRequest $request, $modelId)
    {
        $modelNo = ModelNo::find($modelId);

        // Check if the model exists
        if (!$modelNo) {
            // If the model is not found, return an error response
            return redirect()->back()->with('error', 'Device Model No not found.');
        }

        try {
            // Proceed with updating
            $modelNo->model_no = $request['model_no'];
            $modelNo->voltage = $request['voltage'];
            $modelNo->save();

            // Redirect with a success message after updating
            return redirect()->back()->with('success', 'Device Model No updated successfully.');
        } catch (\Exception $e) {
            // Handle any error during the update process
            return redirect()->back()->with('error', 'An error occurred while trying to update the Device Model No.');
        }

    }
}
