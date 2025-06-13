<?php
namespace App\Services;

use Exception;
use App\Models\PartNo;


class PartNoService
{

   public function index(){
      $partNo = PartNo::all();
      return $partNo;
   }
   public function store($request){
    try {
       $partNo = new PartNo();
       $partNo->element_id = $request["element"];
       $partNo->type_id = $request["element_type"];
       $partNo->model_id = $request["model_no"];
       $partNo->part_no = $request["device_part_no"];
       $partNo->save();
    } catch (Exception $e) {
        // Log the exception message, if logging is set up
        error_log($e->getMessage());
    
        // Provide a more informative error message
        throw new Exception('Error storing model number with the specified columns: ' . $e->getMessage(), 0, $e);
    }
   }
}