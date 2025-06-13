<?php
namespace App\Services;

use Exception;
use App\Models\Tac;


class TacService
{
    public function index(){
        return Tac::all();
    }

    public function store($tacRequest)
    {
        $tac_No = $tacRequest["tac_No"];

        try {
            foreach ($tac_No as $value) {
                $tac = new Tac();
                $tac->element_id = $tacRequest['element'];
                $tac->type_id = $tacRequest['element_type'];
                $tac->model_id = $tacRequest['model_no'];
                $tac->part_id = $tacRequest['device_part_no'];
                $tac->tacNo = $value;
                $tac->save();
            }


        } catch (Exception $e) {
            // Log the exception message, if logging is set up
            error_log($e->getMessage());

            // Provide a more informative error message
            throw new Exception('Error storing TAC number with the specified columns: ' . $e->getMessage(), 0, $e);
        }
    }
}