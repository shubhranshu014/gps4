<?php
namespace App\Services;

use Exception;
use App\Models\Cop;
class CopService
{
    public function index()
    {
        return Cop::all();
    }
    public function store($request)
    {

        $copNo = $request['cop_No'];
        $copValid = $request['cop_valid_till'];
        try {
            foreach ($copNo as $key => $value) {
                $cop = new Cop();
                $cop->element_id = $request["element"];
                $cop->type_id = $request["element_type"];
                $cop->model_id = $request["model_no"];
                $cop->part_id = $request["device_part_no"];
                $cop->tacNo = $request["device_tac_no"];
                $cop->COPNo = $copNo[$key];
                $cop->validTill = $copValid[$key];
                $cop->save();
            }
        } catch (Exception $e) {
            // Handle the error and throw an exception
            throw new Exception('Error storing element: ' . $e->getMessage());
        }
    }
}