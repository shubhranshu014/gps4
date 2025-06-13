<?php

namespace App\Http\Controllers;

use App\Models\Element;
use App\Models\ElementType;
use Illuminate\Http\Request;
use App\Http\Requests\ElementTypeRequest;
use App\Services\ElementTypeService;
class ElementTypeController extends Controller
{
    public function __construct(private ElementTypeService $elementService)
    {

    }
    public function index()
    {
        $layout = "layouts.super";
        $elementType = $this->elementService->index();
        return view("backend.elementType.index")->with(compact("layout", "elementType",));

    }

    public function store(ElementTypeRequest $request)
    {

        try {
            // Pass the validated request data to ElementService for storage
            $this->elementService->store($request);

            // Redirect back with a success message
            return redirect()->route('elements.types')->with('success', 'Element type created successfully!');
        } catch (\Exception $e) {
            // Log the error and return an error message
            \Log::error('Error storing element: ' . $e->getMessage());
            return redirect()->route('elements.types')->with('error', 'An error occurred while creating the element type.');
        }

    }
    public function destroy($elementTypeId)
    {
        try {
            ElementType::findOrFail($elementTypeId)->delete();
            return redirect()->back()->with('success', 'Element Type Delete!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Failed to delete Element Type. Please try again.');

        }

    }

    public function update(ElementTypeRequest $request, $elementTypeId)
    {
        try {
            // Find the ElementType by ID
            $type = ElementType::findOrFail($elementTypeId);

            // Update the model fields
            $type->element_id = $request->input('element');
            $type->type = $request->input('type');

            // Update simCount only if it's provided
            if ($request->filled('no_of_sim')) {
                $type->sim_count = $request->input('no_of_sim');
            }
            // Save changes
            $type->save();

            // Redirect with success message
            return redirect()->back()->with('success', 'Element Type Updated Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Element Type. Please try again.');
        }
    }


}
