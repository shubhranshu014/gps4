<?php
namespace App\Services;

use Exception;
use App\Models\ModelNo;


class ModelNoService
{
  public function index(){
    return ModelNo::with('elements','type')->get();
  }
  public function store($request){
    // dd($request->all());
    try {
        $modelNo = new ModelNo();
        $modelNo->element_id = $request["element"];
        $modelNo->type_id = $request["element_type"];
        $modelNo->model_no = $request["model_no"];
        $modelNo->voltage = $request["voltage"];
        $modelNo->save();
    } catch (Exception $e) {
        // Log the exception message, if logging is set up
        error_log($e->getMessage());
    
        // Provide a more informative error message
        throw new Exception('Error storing model number with the specified columns: ' . $e->getMessage(), 0, $e);
    }

  }
}