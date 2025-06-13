<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Models\MapDeviceDetails;
use Illuminate\Support\Carbon;

Route::get('/vehical-list', function (Request $request) {
   $vehicalList = MapDeviceDetails::with('barcodes')->where('mapDevice_id', auth('api')->user()->id)->get();
    
   return response()->json($vehicalList);
})->middleware('auth:sanctum');

Route::post('/vehical-map/{vehicalNo}', function ($vehicalNo){
// Retrieve the GPS data record containing the vehicle 
$data = App\Models\GpsData::where('IMEINumber',$vehicalNo)->latest()->first();

// Check if data exists
if (!$data) {
    return response()->json(['message' => 'Data not found for the provided vehicle number'], 404);
}

/*
$latitude = $dataArray[12] ; // 31.589618
$longitude = $dataArray[14] ; // 75.875231
$speed = $dataArray[16];
$ignitionStatus = $dataArray[23];
$sosStatus = $dataArray[27];
$response = ['latitude'=>$latitude,'longitude'=>$longitude,'data'=>$dataArray,'speed'=>$speed,'ignitionStatus'=>$ignitionStatus,'sosStatus'=>$sosStatus];
// Return the response */
 return response()->json($data); 

})->middleware('auth:sanctum');
Route::post('/route-playback/{imeiNo}', function ($imeiNo){
$data = App\Models\GpsData::where('IMEINumber', $imeiNo)
        ->whereDate('created_at', Carbon::today())
        ->get(['latitude','longitude']);
return response()->json($data);
})->middleware('auth:sanctum');

Route::post('/stopage/{imeiNo}', function ($imeiNo) {
    $records = App\Models\GpsData::where('IMEINumber', $imeiNo)
        ->whereDate('created_at', Carbon::today())
        ->orderBy('created_at')
        ->get();

      $stoppages = [];
    $isStopped = false;
    $stopStart = null;
    $stopLat = null;
    $stopLng = null;

    foreach ($records as $record) {
        if ($record->speed == 0) {
            if (!$isStopped) {
                // Starting a new stoppage
                $stopStart = $record->created_at;
                $stopLat = $record->latitude ?? $record->Latitude;
                $stopLng = $record->longitude ?? $record->Longitude;
                $isStopped = true;
            }
        } else {
            if ($isStopped) {
                // Ending the stoppage
                $stopEnd = $record->created_at;
                $duration = $stopEnd->diffInSeconds($stopStart);

                $stoppages[] = [
                    'start_time' => $stopStart->toDateTimeString(),
                    'end_time' => $stopEnd->toDateTimeString(),
                    'duration_seconds' => $duration,
                    'duration_human' => gmdate('H:i:s', $duration),
                    'latitude' => $stopLat,
                    'longitude' => $stopLng,
                ];

                $isStopped = false;
                $stopStart = null;
            }
        }
    }

    // Handle case where vehicle is still stopped at the end
    if ($isStopped && $stopStart) {
        $stopEnd = now();
        $duration = $stopEnd->diffInSeconds($stopStart);

        $stoppages[] = [
            'start_time' => $stopStart->toDateTimeString(),
            'end_time' => $stopEnd->toDateTimeString(),
            'duration_seconds' => $duration,
            'duration_human' => gmdate('H:i:s', $duration),
            'latitude' => $stopLat,
            'longitude' => $stopLng,
        ];
    }

    return response()->json($stoppages);
})->middleware('auth:sanctum');

Route::post('/over-speed/{imeiNo}', function ($imeiNo){
$overspeedLimit = 60; // you can set this dynamically

$data = App\Models\GpsData::where('IMEINumber', $imeiNo)
    ->where('speed', '>', $overspeedLimit)
    ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
    ->get(['latitude', 'longitude', 'speed', 'created_at']);
return response()->json($data);
})->middleware('auth:sanctum');


Route::post('/login', [LoginController::class,'login']);
