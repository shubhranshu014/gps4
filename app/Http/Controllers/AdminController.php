<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\AdminRequest;
use App\Services\AdminService;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;


class AdminController extends Controller
{
    public function __construct(private AdminService $adminService)
    {
    }

    public function index()
    {
        $layout = "layouts.super";
        $admin = Admin::all();
        return view("backend.admin.index")->with(compact("admin", "layout"));

    }

    public function create()
    {
        $layout = 'layouts.super';
        return view("backend.admin.create", compact('layout'));
    }

    public function store(AdminRequest $request)
    {


        try {
            $this->adminService->store($request);
            return redirect()->back()->with('success', 'Admin created successfully!');
        } catch (Exception $e) {
            // Log the error for debugging (you could log more detailed information if needed)
            \Log::error('Error creating admin: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'An error occurred while creating the admin.');
        }
    }


    public function delete(int $id)
    {

        $admin = Admin::find($id);

        if (!$admin) {
            return redirect()->back()->with('error', 'Admin not found!');
        }

        try {
            $admin->delete();
            return redirect()->back()->with('success', 'Admin deleted successfully!');
        } catch (\Throwable $th) {
            // Log the error for debugging purposes
            Log::error("Error occurred while deleting admin with ID $id: " . $th->getMessage(), [
                'error' => $th,
                'trace' => $th->getTraceAsString(),
            ]);

            return redirect()->back()->with('error', 'An error occurred while deleting the admin.');
        }

    }

    public function edit(int $id)
    {
        $admin = Admin::find($id);

        // Check if admin exists
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin not found!');
        }

        try {
            $layout = 'layouts.super';
            return view('backend.admin.edit', compact('admin', 'layout'));
        } catch (\Throwable $th) {
            // Log the error for debugging purposes with the admin ID
            Log::error("Error occurred while fetching admin with ID {$id} for editing: " . $th->getMessage(), [
                'error' => $th,
                'trace' => $th->getTraceAsString(),
                'admin_id' => $id,  // Log the admin ID for context
            ]);

            // Return a generic error message
            return redirect()->back()->with('error', 'An error occurred while loading the admin details for editing. Please try again later.');
        }
    }




    public function update(AdminUpdateRequest $request, $id)
    {
        $this->adminService->update($request, $id);
        return redirect()->route("admin.list")->with('success', 'Update complite!');
    }
}

