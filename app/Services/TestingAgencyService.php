<?php
namespace App\Services;

use Exception;
use App\Models\TestingAgency;


class TestingAgencyService
{
    public function index(){
        return TestingAgency::all();
    }
    public static function store($request)
    {
        $testAgency = $request["testing_agency"];
        try {
            foreach ($testAgency as $value) {
                $testingAgency = new TestingAgency;
                $testingAgency->element_id = $request['element'];
                $testingAgency->type_id = $request['element_type'];
                $testingAgency->model_id = $request['model_no'];
                $testingAgency->part_id = $request['device_part_no'];
                $testingAgency->tacNo = $request['device_tac_no'];
                $testingAgency->copNo = $request['cop_no'];
                $testingAgency->testingAgency = $value;
                $testingAgency->save();
            }

        } catch (Exception $e) {
            // Log the exception message, if logging is set up
            error_log($e->getMessage());

            // Provide a more informative error message
            throw new Exception('Error storing TAC number with the specified columns: ' . $e->getMessage(), 0, $e);
        }
    }
}