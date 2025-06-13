<?php

namespace App\Http\Controllers;

use App\Models\Wlp;
use Illuminate\Http\Request;
use App\Http\Requests\WlpRequest;
use App\Services\WlpService;
use Illuminate\Support\Facades\Log;
class WlpController extends Controller
{

    public function __construct(private WlpService $wlpService)
    {

    }
    public function index()
    {
        $layout = "layouts.admin";
        $wlps = $this->wlpService->index();
        return view("backend.wlp.index")->with(compact("layout", "wlps"));
    }

    public function store(WlpRequest $request)
    {

        try {
            $this->wlpService->store($request);
            return redirect()->back()->with('success', 'WLP created Successfully.');
        } catch (\Throwable $th) {
            \Log::error('Error storing WLP: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the WLP.');
        }
    }



    public function delete($id)
    {
        $wlp = Wlp::find($id);

        if (!$wlp) {
            return redirect()->back()->with('error', 'Wlp not found!');
        }
        try {
            $wlp->delete();
            return redirect()->back()->with('success', 'Wlp deleted successfully!');
        } catch (\Throwable $th) {
            // Log the error for debugging purposes
            Log::error("Error occurred while deleting Wlp with ID $id: " . $th->getMessage(), [
                'error' => $th,
                'trace' => $th->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred while deleting the Wlp.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $this->wlpService->update($request, $id);
            return redirect()->back()->with('success', 'WLP updated Successfully.');
        } catch (\Throwable $th) {
            \Log::error('Error storing WLP: ' . $th->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the WLP.');
        }
    }

}
