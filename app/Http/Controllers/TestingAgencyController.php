<?php

namespace App\Http\Controllers;

use App\Models\TestingAgency;
use Illuminate\Http\Request;
use App\Http\Requests\TestingAgencyRequest;
use App\Services\TestingAgencyService;
class TestingAgencyController extends Controller
{

    public function __construct(private TestingAgencyService $testingAgencyService)
    {

    }
    public function index()
    {
        $layout = "layouts.super";
        $testingAgency = $this->testingAgencyService->index();
        return view("backend.testingAgency.index")->with(compact("layout", "testingAgency"));
    }
    public function store(TestingAgencyRequest $testingAgencyRequest)
    {

        try {
            $this->testingAgencyService->store($testingAgencyRequest);
            return redirect()->route('testingagency')->with('success', 'Testing agency created successfully!');
        } catch (\Exception $e) {
            // Log the error and return an error message
            \Log::error('Error storing element: ' . $e->getMessage());
            return redirect()->route('testingagency')->with('error', 'An error occurred while creating the testing agency.');
        }
    }

    public function destroy($testingId)
    {
        $testingAgency = TestingAgency::find($testingId);
        if (!$testingAgency) {
            return redirect()->route('testingagency')->with('error', 'Testing Agency Not Found');
        }
        try {
            $testingAgency->delete();
            return redirect()->route('testingagency')->with('success', 'Testing Agency Deleted!');
        } catch (\Throwable $th) {
            return redirect()->route('testingagency')->with('success', 'Testing Agency Not Deleted! Something Went Wrong');
        }
    }

    public function update($testingId, Request $request)
    {
        $testingAgency = TestingAgency::find($testingId);
        if (!$testingAgency) {
            return redirect()->route('testingagency')->with('error', 'Testing Agency Not Found');
        }
        try {
            $testingAgency->testingAgency = $request['testingAgency'];
            $testingAgency->save();
            return redirect()->route('testingagency')->with('success', 'Testing Agency Updated!');
        } catch (\Throwable $th) {
            return redirect()->route('testingagency')->with('success', 'Testing Agency Not Updated! Something Went Wrong');
        }
    }
}
