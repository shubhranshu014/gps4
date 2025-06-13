<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ElementController;
use App\Http\Controllers\ElementTypeController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\PartNoController;
use App\Http\Controllers\TacController;
use App\Http\Controllers\COPController;
use App\Http\Controllers\TestingAgencyController;
use App\Http\Controllers\ElementAssignController;
use App\Http\Controllers\AssignedElementController;
use App\Http\Controllers\WlpController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\BarCodeController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\BarCodeImportController;
use App\Http\Controllers\SettingMfgController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth.login');
})->name('login-form');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', function () {
    Auth::logout();
    // Redirect to a specific page after logging out
    return redirect()->route('login-form')->with('success', 'Logged out successfully!');
})->name('logout');

Route::get('/public/uploads/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
})->name('public.uploads');

Route::middleware(['auth'])->prefix('superadmin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('super.dashboard');
    //admin
    Route::get('/onboard/admin', [AdminController::class, 'create'])->name('create.admin');
    Route::post('/onboard/admin', [AdminController::class, 'store'])->name('store.admin');
    Route::get('/admins', [AdminController::class, 'index'])->name('admin.list');
    Route::delete('/admin/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admins-edit/{id}', [AdminController::class, 'update'])->name('admin.update');


    //element
    Route::get('/elements', [ElementController::class, 'index'])->name('elements');
    Route::post('/element/store', [ElementController::class, 'store'])->name('elements.store');
    Route::delete('/element/delete/{elementId}', [ElementController::class, 'destroy'])->name('element.delete');
    Route::put('/element/update/{elementId}', [ElementController::class, 'update'])->name('element.update');

    //element type
    Route::get('/elements/types', [ElementTypeController::class, 'index'])->name('elements.types');
    Route::post('/elements/types/store', [ElementTypeController::class, 'store'])->name('elements.types.store');
    Route::delete('/elements/types/delete/{elementTypeId}', [ElementTypeController::class, 'destroy'])->name('element.type.delete');
    Route::put('/element-type/update/{elementTypeId}', [ElementTypeController::class, 'update'])->name('element.type.update');

    //model 
    Route::post('/model-no/store', [ModelController::class, 'store'])->name('model.store');
    Route::get('/model-no', [ModelController::class, 'index'])->name('modelNo');

    //part 
    Route::post('/part-no/store', [PartNoController::class, 'store'])->name('part.store');
    Route::get('/part-no', [PartNoController::class, 'index'])->name('parts');

    //tac
    Route::post('/tac-no/store', [TacController::class, 'store'])->name('tac.store');
    Route::get('/tac-no', [TacController::class, 'index'])->name('tacs');
    //COP

    Route::post('/cop/store', [COPController::class, 'store'])->name('cop.store');
    Route::get('/cop', [COPController::class, 'index'])->name('cop');


    //testing agency
    Route::post('/testing-agency/store', [TestingAgencyController::class, 'store'])->name('testingAgency.store');
    Route::get('testing-agency', [TestingAgencyController::class, 'index'])->name('testingagency');
    // assign element
    Route::get('/assing-element', [ElementAssignController::class, 'index'])->name('assignElement.admin');
    Route::post('/assing-element/store', [ElementAssignController::class, 'store'])->name('assignElement.admin.store');

    Route::post('/model-no/store', [ModelController::class, 'store'])->name('model.store');
    Route::get('/model-no', [ModelController::class, 'index'])->name('modelNo');
    Route::delete('/model-no/delete/{modelId}', [ModelController::class, 'destroy'])->name('model_no.delete');
    Route::put('/model-no/update/{modelId}', [ModelController::class, 'update'])->name('model_no.update');

    //part 
    Route::post('/part-no/store', [PartNoController::class, 'store'])->name('part.store');
    Route::get('/part-no', [PartNoController::class, 'index'])->name('parts');
    Route::delete('/part-no/delete/{partId}', [PartNoController::class, 'destroy'])->name('part_no.delete');
    Route::put('/part-no/update/{partId}', [PartNoController::class, 'update'])->name('part_no.update');

    //tac
    Route::post('/tac-no/store', [TacController::class, 'store'])->name('tac.store');
    Route::get('/tac-no', [TacController::class, 'index'])->name('tacs');
    Route::delete('/tac-no/delete/{tacId}', [TacController::class, 'destroy'])->name('tacNo.delete');
    Route::put('/tac-no/update/{tacId}', [TacController::class, 'update'])->name('tacNo.update');


    //COP 
    Route::post('/cop/store', [COPController::class, 'store'])->name('cop.store');
    Route::get('/cop', [COPController::class, 'index'])->name('cop');
    Route::delete('/cop-no/delete/{copId}', [COPController::class, 'destroy'])->name(name: 'cop.delete');
    Route::put('/cop-no/update/{copId}', [COPController::class, 'update'])->name(name: 'cop.update');



    //testing agency
    Route::post('/testing-agency/store', [TestingAgencyController::class, 'store'])->name('testingAgency.store');
    Route::get('testing-agency', [TestingAgencyController::class, 'index'])->name('testingagency');
    Route::delete('/testing-agency/{testingId}', [TestingAgencyController::class, 'destroy'])->name('testing-agency.destroy');
    Route::put('/testing-agency/{testingId}', [TestingAgencyController::class, 'update'])->name('testing-agency.update');

    // ajax
    Route::get('/fetch/element-type/{element_id}', [AjaxController::class, 'fetchElementTypeByElemeNt']);
    Route::get('/fetch/model-no/{type_id}', [AjaxController::class, 'fetchModelNoByType']);
    Route::get('/fetch/part-no/{model_id}', [AjaxController::class, 'fetchPartNoByModel']);
    Route::get('/fetch/tac-no/{partId}', [AjaxController::class, 'fetchTacNoByPart']);
    Route::get('/fetch/cop-no/{tacId}', [AjaxController::class, 'fetchcopNoByTacno']);


});


Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    // Admin routes here
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    //elements
    Route::get('/assigned/elements/{id}', [AssignedElementController::class, 'index'])->name('admin.assignedElement');
    Route::get('/assigne/elements', [ElementAssignController::class, 'assignToWlp'])->name('assigneElement.wlp');
    Route::post('/assigne/elements/store', [ElementAssignController::class, 'assignToWlpStore'])->name('assigneElement.wlp.store');

    Route::get('/wlps', action: [WlpController::class, 'index'])->name('wlps');
    Route::post('/wlp/store', [WlpController::class, 'store'])->name('wlp.store');
    Route::delete('/wlp/delete/{id}', [WlpController::class, 'delete'])->name('wlp.delete');
    Route::put('/wlp/update/{id}', [WlpController::class, 'update'])->name('wlp.update');

    // assign element
    //  Route::get('/assing-element', [ElementAdminController::class, 'index'])->name('assignElement');
    //  Route::post('/assing-element/store', [ElementAdminController::class, 'store'])->name('assignElement.store');

});


Route::middleware(['auth:wlp'])->prefix('wlp')->group(function () {
    Route::get('/dashboard', [DashboardController::class, "wlp"])->name('wlp.dashboard');
    Route::get('/manufacturer', [ManufacturerController::class, "index"])->name('manufacturers');
    Route::post('/manufacturer/store', [ManufacturerController::class, "store"])->name('manufacturer.store');
    Route::delete('/manufacturer/delete/{id}', [ManufacturerController::class, "delete"])->name('manufacturer.delete');
    Route::get('/manufacturer/edit/{id}', [ManufacturerController::class, 'edit'])->name('manufacturer.edit');

    Route::put('/manufacturer/{manufacturer}', [ManufacturerController::class, 'update'])->name('manufacturer.update');

    //elements
    Route::get('/elements', [AssignedElementController::class, 'wlp'])->name('assignedElements.Wlp');
    Route::get('/assign/elements', [ElementAssignController::class, 'assignToMfg'])->name('assigneElements.mfg');
    Route::post('/assign/elements/store', [ElementAssignController::class, 'assignToMfgStore'])->name('assigneElements.mfg.store');


});

Route::middleware(['auth:manufacturer'])->prefix('manufacturer')->group(function () {
    Route::get('/dashboard', [DashboardController::class, "manufacturer"])->name('manufacturer.dashboard');
    Route::get('/distributors', [DistributorController::class, "index"])->name("distributors");
    Route::post('/distributors/store', [DistributorController::class, "store"])->name("distributor.store");
    Route::delete('/distributors/delete/{id}', [DistributorController::class, "delete"])->name("distributor.delete");
    Route::get('/distributors/edit/{id}', [DistributorController::class, "edit"])->name("distributor.edit");


    //subscription
    Route::get("/subscriptions", [SubscriptionController::class, 'index'])->name('subscriptions');
    Route::post("/subscription/store", [SubscriptionController::class, 'store'])->name('subscription.store');
    Route::get("/subscriptions/edit/{id}", [SubscriptionController::class, 'edit'])->name('subscriptions.edit');
    Route::post("/subscriptions/update/{id}", [SubscriptionController::class, 'update'])->name('subscriptions.update');

    //Ajax
    Route::get('/fetch-dealer', [AjaxController::class, 'getDealerByDistributor']);
    Route::get('/fetch/element-type/{element_id}', [AjaxController::class, 'fetchElementTypeByElemeNt']);
    Route::get('/fetch/model-no/{type_id}', [AjaxController::class, 'fetchModelNoByType']);
    Route::get('/fetch/part-no/{model_id}', [AjaxController::class, 'fetchPartNoByModel']);
    Route::get('/fetch/tac-no/{partId}', [AjaxController::class, 'fetchTacNoByPart']);
    Route::get('/fetch/cop-no/{tacId}', [AjaxController::class, 'fetchcopNoByTacno']);
    Route::get('/fetch/testing-agency/{copId}', [AjaxController::class, 'fetchTestingAgencyByCop']);
    Route::get('/fetch/barcode/{part_id}', [AjaxController::class, 'fetchBarcodeByPartNo']);
    Route::get('/fetch/distributer/{state}', [AjaxController::class, 'fetchdistributer']);
    Route::get('/fetch/simInfoByBarcode/{barcodeId}', [AjaxController::class, 'fetchsimInfoByBarcode']);
    Route::get('/fetch/technician/{dealerid}', [AjaxController::class, 'fetchTechnicianByDealer']);
    Route::get('/fetch-customer-by-email', [AjaxController::class, 'customerFetchByEmail']);
    Route::get('/fetch-customer-by-mobile', [AjaxController::class, 'customerFetchByMobile']);

    //Bar Code
    Route::get('/manage/barcode', [BarcodeController::class, 'index'])->name('manage.barcode');
    Route::post('/manage/barcode', [BarcodeController::class, 'store'])->name('barcode.store');
    // Route::get('/manufacturer/barcode/list', action: [BarcodeController::class, 'index'])->name('manufacturer.barcode.list');
    Route::get('/allocate/barcode', action: [BarcodeController::class, 'allocate'])->name('barcode.allocate');
    Route::post('/allocate/barcode/store', action: [BarcodeController::class, 'storeAllocate'])->name('barcode.allocate.store');
    Route::get('/download/templete/{filename}', [BarCodeImportController::class, 'download'])->name('barcode.templete.download');
    Route::post('/barcode/import', [BarCodeImportController::class, 'import'])->name('barcode.spreadsheet.import');



    //certificate 
    Route::post('/download-pdf', [CertificateController::class, 'downloadPDF'])->name('download.PDF');

    #Setting
    Route::get('/setting', [SettingMfgController::class, 'mfgSetting'])->name('mgf.setting');
    Route::post('/setting/store', [SettingMfgController::class, 'mfgSettingstore'])->name('mgf.setting.store');


});

Route::middleware(['auth:distributor'])->prefix('distributor')->group(function () {
    Route::get('/dashboard', [DashboardController::class, "distributor"])->name('distributor.dashboard');
    Route::get('/allocated/barcode', [BarCodeController::class, "allocatedDistributor"])->name('distributor.barcode');
    Route::get('/allocate/barcode', [BarCodeController::class, "allocateDistributor"])->name('distributor.allocate.barcode');
    Route::post('/allocate/barcode/store', [BarCodeController::class, "allocateDistributorStore"])->name('distributor.allocate.barcode.store');


    // Ajax


    Route::get('/fetch/dealerByDistrict', [AjaxController::class, "dealerByDistrict"]);

});

Route::middleware(['auth:dealer'])->prefix('dealer')->group(function () {
    Route::get('/dashboard', [DashboardController::class, "dealer"])->name('dealer.dashboard');


});


Route::middleware(['multi.guard.auth:manufacturer,distributor'])->group(function () {
     Route::get('/allocated/barcode', [BarCodeController::class, "allocatedDealer"])->name('dealer.barcode');

    Route::get("/dealers", [DealerController::class, "index"])->name("dealers");
    Route::post("/dealers/store", [DealerController::class, "store"])->name("dealer.store");
    Route::delete("/dealers/delete/{id}", [DealerController::class, "delete"])->name("dealer.delete");

    Route::get('/fetch/distributor/details/{distributorId}', [AjaxController::class, 'fetchDistributor']);
    Route::get('/fetch/rto/{district}', [AjaxController::class, 'fetchRtoByDistrict']);


    Route::get("/technicians", [TechnicianController::class, "index"])->name("technicians");
    Route::post("/technician/store", [TechnicianController::class, "store"])->name("technician.store");


    //Map dcevice
    Route::get('/map-deive', [DeviceController::class, 'map'])->name('map.device');
    Route::post('/map-deive/store', [DeviceController::class, 'store'])->name('map.device.store');

    Route::get('/fetch/dealer/{distributer_id}', [AjaxController::class, 'fetchdealer']);
    Route::get('/fetch/device-by-dealer/{dealerid}', [AjaxController::class, 'deviceByDealer']);

});

