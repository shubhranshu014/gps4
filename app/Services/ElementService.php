<?php
namespace App\Services;

use Exception;
use App\Models\Element;

class ElementService
{
    public function index()
    {
        try {
            // Fetch element data (ensure Element::get() is defined correctly)
            $element = Element::get(['id', 'name', 'is_vltd']);
            return $element;
        
        } catch (Exception $e) {
            // Log the exception message, if logging is set up
            error_log($e->getMessage());
        
            // Provide a more informative error message
            throw new Exception('Error fetching element with the specified columns: ' . $e->getMessage(), 0, $e);
        }
        
    }
    public function store($request)
    {
        try {
            // Create a new Element model and populate it with validated data
            $element = new Element();
            $element->name = $request->element_name;
            $element->is_vltd = $request->is_vltd;

            // Save the element to the database
            $element->save();

        } catch (Exception $e) {
            // Handle the error and throw an exception
            throw new Exception('Error storing element: ' . $e->getMessage());
        }
    }
}
