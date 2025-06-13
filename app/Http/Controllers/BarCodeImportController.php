<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use App\Models\BarCode;
use App\Models\Sim;
use App\Models\ElementType;
class BarCodeImportController extends Controller
{
    public function download($filename)
    {
        $path = storage_path('app/public/files/' . $filename);

        if (File::exists($path)) {
            return Response::download($path);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }


    public function import(Request $request)
    {
          
    //   dd($request->all());
        //Validate the file
        $request->validate([
            'import' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $file = $request->file('import');

        // Read the spreadsheet file
        try {
            $spreadsheet = IOFactory::load($file); // Load the spreadsheet
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Failed to load spreadsheet: ' . $e->getMessage()]);
        }

        // Get the first sheet of the spreadsheet
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(); // Convert sheet data into an array

        // Skip the first row (header row)
        $rows = array_slice($rows, 1); // Start from the second row

        // Optionally, dump the rows to see the data (useful for debugging)

        // 
        //batchNo
        
        $elementType = ElementType::find($request['element_type']);
        $simCount = $elementType->sim_count;


        
        foreach ($rows as $row) {
        // dd($row[0]);
        if (count($row) < 5) {
            throw new \Exception("Invalid row format. Expected 11 elements, got " . count($row));
        }
        $barcode = new BarCode();
        $barcode->mfg_id = auth('manufacturer')->user()->id;
        $barcode->element_id = $request->input('element');
        $barcode->type_id = $request->input('element_type');
        $barcode->model_id = $request->input('model_no');
        $barcode->part_id = $request->input('device_part_no');
        $barcode->tac_id = $request->input('tacNo');
        $barcode->cop_id = $request->input('copNo');
        $barcode->testing_agencyId = $request->input('testingAgency');
        $barcode->serialNumber = $row[2];
        $barcode->barcodeNo = $row[0];
        $barcode->IMEINO = $row[0];
        $barcode->batchNo = $request->input('batchNo');
        $barcode->is_renew = $row[1];
        $barcode->status = '0';
        $barcode->save();
        for ($i=0; $i < $simCount; $i++) { 
            $sim = new Sim();
            $sim->barcode_id = $barcode->id;
            $sim->simNo = $row[3];
            $sim->ICCIDNo = $row[4];
            $sim->validity = $row[5];
            $sim->operator = $row[6];
            $sim->manufacture = 'webleo';
            $sim->save();
        }
        
        
        }
        
        return back()->with('success','Barcode Imported Successfully');
    }
}
