<?php

namespace App\Http\Controllers;

use App\Models\Element;
use Illuminate\Http\Request;
use App\Http\Requests\ElementRequest;
use App\Services\ElementService;
class ElementController extends Controller
{

    public function __construct(private ElementService $elementService)
    {
    }

    // Show the index page
    public function index()
    {
        $layout = "layouts.super";
        $element = $this->elementService->index();
        return view("backend.element.index")->with(compact("layout", "element"));
    }

    // Store the element data using ElementService
    public function store(ElementRequest $request)
    {
        try {
            // Pass the validated request data to ElementService for storage
            $this->elementService->store($request);

            // Redirect back with a success message
            return redirect()->route('elements')->with('success', 'Element created successfully!');
        } catch (\Exception $e) {
            // Log the error and return an error message
            \Log::error('Error storing element: ' . $e->getMessage());
            return redirect()->route('elements')->with('error', 'An error occurred while creating the element.');
        }
    }

    public function destroy($id)
    {

        try {
            // Find the element by ID, or return a 404 error if not found
            $element = Element::findOrFail($id);

            // Perform the deletion
            $element->delete();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Element deleted successfully!');
        } catch (\Exception $e) {
            // In case of failure, redirect back with an error message
            return redirect()->back()->with('error', 'Element could not be deleted. Please try again.');
        }
    }
    public function update($elementId, ElementRequest $request)
    {
        try {
            $element = Element::findOrFail($elementId);
            $element->name = $request['element_name'];
            $element->is_vltd = $request['is_vltd'];
            $element->save();
            return redirect()->back()->with('success', 'Element updated');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Element could not be updated. Please try again.');
        }

    }
}
