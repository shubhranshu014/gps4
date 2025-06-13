@extends('layouts.manufacturer')
@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="row align-items-center py-3 mb-4"
            style="background: linear-gradient(135deg, #260950 0%, #260950 100%); border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <h4 class="text-white mb-0 px-3 py-2 fw-bold">
                        <i class="fas fa-barcode me-2"></i>
                        Barcode Management
                    </h4>
                    <span class="badge bg-light text-dark ms-2">Total: {{ count($barCode) }}</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-end pe-3">
                    <a class="btn btn-theme t d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        <i class="fas fa-plus-circle me-2"></i>
                        Add Barcode
                    </a>
                </div>
            </div>
        </div>

        <!-- Alerts Section -->
        <div class="row mb-4">
            <div class="col-12">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>{{ Session::get('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100"
                    style="background: linear-gradient(135deg, #260950 0%, #3a1b7a 100%);">
                    <div class="card-body text-center py-3">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <i class="fas fa-microchip text-white fs-4 me-2"></i>
                            <h3 class="card-title text-white mb-0">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->count() }}
                            </h3>
                        </div>
                        <p class="card-text text-white mb-0">TOTAL DEVICES</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100"
                    style="background: linear-gradient(135deg, #086c57 0%, #0d9d7f 100%);">
                    <div class="card-body text-center py-3">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <i class="fas fa-check-circle text-white fs-4 me-2"></i>
                            <h3 class="card-title text-white mb-0">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', '0')->count() }}
                            </h3>
                        </div>
                        <p class="card-text text-white mb-0">AVAILABLE DEVICES</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100"
                    style="background: linear-gradient(135deg, #e9b517 0%, #f5c542 100%);">
                    <div class="card-body text-center py-3">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <i class="fas fa-user-clock text-white fs-4 me-2"></i>
                            <h3 class="card-title text-white mb-0">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', '1')->count() }}
                            </h3>
                        </div>
                        <p class="card-text text-white mb-0">ALLOCATED DEVICES</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-0 shadow-sm h-100"
                    style="background: linear-gradient(135deg, #dc3545 0%, #e4606d 100%);">
                    <div class="card-body text-center py-3">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <i class="fas fa-bolt text-white fs-4 me-2"></i>
                            <h3 class="card-title text-white mb-0">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', '2')->count() }}
                            </h3>
                        </div>
                        <p class="card-text text-white mb-0">INSTALLED DEVICES</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Table Section -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-list-alt me-2 text-primary"></i>
                        Barcode Records
                    </h5>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover dataTable align-middle mb-0" id="barcodeTable">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Device Serial No</th>
                                <th>SIM Details</th>
                                <th>ICCID No / SIM Manufacture</th>
                                <th>Type</th>
                                <th>Model No</th>
                                <th>Part No</th>
                                <th>Barcode Type</th>
                                <th>Created At</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barCode as $item)
                                                    <tr>
                                                        <td class="ps-4">
                                                            <a href="#" class="text-primary fw-semibold" data-bs-toggle="modal"
                                                                data-bs-target="#deviceModal{{ $loop->iteration }}" title="Device Info">
                                                                <div>{{ $item->serialNumber }}</div>
                                                                <small class="text-muted">{{ $item->barcodeNo }}</small>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @php
                                                                $sim = DB::table('sims')->where('barcode_id', $item->id)->get();
                                                            @endphp
                                                            @foreach ($sim as $simdata)
                                                                <a href="#" class="d-block text-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#SimModal{{ $simdata->simNo }}" title="Sim Info">
                                                                    {{ $simdata->simNo }}
                                                                </a>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($sim as $simdata)
                                                                <div>{{ $simdata->ICCIDNo }}</div>
                                                                <small class="text-primary">{{ $simdata->manufacture }}</small>
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $item->elementType->pluck('type')->first() }}</td>
                                                        <td>{{ $item->modelNo->pluck('model_no')->first() }}</td>
                                                        <td>{{ $item->partNo->pluck('part_no')->first() }}</td>
                                                        <td>
                                                            @if ($item->is_renew == 0)
                                                                <span class="badge bg-success bg-opacity-10 text-success">NEW</span>
                                                            @else
                                                                <span class="badge bg-secondary bg-opacity-10 text-secondary">RENEWED</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                                        <td class="text-center">
                                                            @if ($item->status == 0)
                                                                <span class="badge bg-success">ACTIVE</span>
                                                            @elseif($item->status == 1)
                                                                <span class="badge bg-warning">ALLOCATED</span>
                                                            @else
                                                                <span class="badge bg-danger">USED</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SIM Modal Template -->
    @foreach ($barCode as $item)
        @php
            $sim = DB::table('sims')->where('barcode_id', $item->id)->get();
        @endphp
        @foreach ($sim as $simdata)
            <div class="modal fade" id="SimModal{{ $simdata->simNo }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header" style="background-color: #260950;color:#fff">
                            <h5 class="modal-title">
                                <i class="fas fa-sim-card me-2"></i>
                                SIM Information
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Basic Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-5">SIM No.</dt>
                                                <dd class="col-sm-7">{{ $simdata->simNo }}</dd>

                                                <dt class="col-sm-5">ICCID No.</dt>
                                                <dd class="col-sm-7">{{ $simdata->ICCIDNo }}</dd>

                                                <dt class="col-sm-5">Operator</dt>
                                                <dd class="col-sm-7">{{ $simdata->operator }}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h6 class="mb-0">Validity & Details</h6>
                                        </div>
                                        <div class="card-body">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-5">Valid Till</dt>
                                                <dd class="col-sm-7">{{ $simdata->validity }}</dd>

                                                <dt class="col-sm-5">Manufacturer</dt>
                                                <dd class="col-sm-7">{{ $simdata->manufacture }}</dd>

                                                <dt class="col-sm-5">Created At</dt>
                                                <dd class="col-sm-7">
                                                    {{ \Carbon\Carbon::parse($simdata->created_at)->format('d M Y H:i') }}
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Device Modal Template -->
        <div class="modal fade" id="deviceModal{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-barcode me-2"></i>
                            Device Details: {{ $item->barcodeNo }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion" id="deviceAccordion{{ $loop->iteration }}">
                            <!-- Device Details Card -->
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingOne{{ $loop->iteration }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne{{ $loop->iteration }}" aria-expanded="true"
                                        aria-controls="collapseOne{{ $loop->iteration }}">
                                        <i class="fas fa-microchip me-2"></i> Device Information
                                    </button>
                                </h2>
                                <div id="collapseOne{{ $loop->iteration }}" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne{{ $loop->iteration }}"
                                    data-bs-parent="#deviceAccordion{{ $loop->iteration }}">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Device Serial Number</label>
                                                <input type="text" class="form-control" value="{{ $item->serialNumber }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Barcode Number</label>
                                                <input type="text" class="form-control" value="{{ $item->barcodeNo }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">IMEI Number</label>
                                                <input type="text" class="form-control" value="{{ $item->IMEINO }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Element Type</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->elementType->pluck('type')->first() }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Model Details Card -->
                            <div class="accordion-item border-0 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="headingTwo{{ $loop->iteration }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo{{ $loop->iteration }}" aria-expanded="false"
                                        aria-controls="collapseTwo{{ $loop->iteration }}">
                                        <i class="fas fa-box-open me-2"></i> Model Specifications
                                    </button>
                                </h2>
                                <div id="collapseTwo{{ $loop->iteration }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo{{ $loop->iteration }}"
                                    data-bs-parent="#deviceAccordion{{ $loop->iteration }}">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Model Number</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->modelNo->pluck('model_no')->first() }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Part Number</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->partNo->pluck('part_no')->first() }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Voltage</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->modelNo->pluck('voltage')->first() }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Batch Number</label>
                                                <input type="text" class="form-control" value="{{ $item->BatchNo }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Manufacturer Details Card -->
                            <div class="accordion-item border-0 shadow-sm">
                                <h2 class="accordion-header" id="headingThree{{ $loop->iteration }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree{{ $loop->iteration }}" aria-expanded="false"
                                        aria-controls="collapseThree{{ $loop->iteration }}">
                                        <i class="fas fa-industry me-2"></i> Manufacturer Details
                                    </button>
                                </h2>
                                <div id="collapseThree{{ $loop->iteration }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree{{ $loop->iteration }}"
                                    data-bs-parent="#deviceAccordion{{ $loop->iteration }}">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Manufacturer</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $item->manufacturer->pluck('businees_name')->first() }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Created At</label>
                                                <input type="text" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Modified At</label>
                                                <input type="text" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y H:i') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header" style="background-color: #260950; color: white;">
                    <h5 class="modal-title">
                        <i class="fas fa-barcode me-2"></i>
                        Create New Barcode
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('barcode.store') }}" method="post" id="creationForm"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- Device Information Section -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="fas fa-microchip me-2"></i>
                                    Device Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Element Selection -->
                                    <div class="col-md-6">
                                        <label class="form-label">Select Element <span class="text-danger">*</span></label>
                                        <select name="element"
                                            class="form-select element @error('element') is-invalid @enderror">
                                            <option value="" selected disabled>Select Element</option>
                                            @foreach ($element as $item)
                                                <option value="{{ $item->element_id }}"
                                                    @selected(old('element') == $item->element_id)>
                                                    {{ $item->element->pluck('name')->first() }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('element')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Element Type -->
                                    <div class="col-md-6">
                                        <label class="form-label">Select Type <span class="text-danger">*</span></label>
                                        <select name="element_type"
                                            class="form-select element_type @error('element_type') is-invalid @enderror">
                                            <option value="" selected disabled>Select Type</option>
                                        </select>
                                        @error('element_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Model Number -->
                                    <div class="col-md-6">
                                        <label class="form-label">Select Model No <span class="text-danger">*</span></label>
                                        <select name="model_no"
                                            class="form-select model-no @error('model_no') is-invalid @enderror">
                                            <option value="" selected disabled>Select Model</option>
                                        </select>
                                        @error('model_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Part Number -->
                                    <div class="col-md-6">
                                        <label class="form-label">Device Part No <span class="text-danger">*</span></label>
                                        <select name="device_part_no"
                                            class="form-select partNo @error('device_part_no') is-invalid @enderror">
                                            <option value="" selected disabled>Select Part No</option>
                                        </select>
                                        @error('device_part_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Specifications Section -->
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="fas fa-cogs me-2"></i>
                                    Technical Specifications
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- TAC No -->
                                    <div class="col-md-3">
                                        <label class="form-label">TAC No</label>
                                        <select name="tacNo" class="form-select tacNo @error('tacNo') is-invalid @enderror">
                                            <option value="" selected disabled>Select TAC</option>
                                        </select>
                                        @error('tacNo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- COP No -->
                                    <div class="col-md-3">
                                        <label class="form-label">COP No</label>
                                        <select name="copNo" class="form-select copNo @error('copNo') is-invalid @enderror">
                                            <option value="" selected disabled>Select COP</option>
                                        </select>
                                        @error('copNo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- COP Valid Till -->
                                    <div class="col-md-3">
                                        <label class="form-label">COP Valid Till</label>
                                        <input type="date" name="copValidTill"
                                            class="form-control copValidTill @error('copValidTill') is-invalid @enderror">
                                        @error('copValidTill')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Testing Agency -->
                                    <div class="col-md-3">
                                        <label class="form-label">Testing Agency</label>
                                        <select name="testingAgency"
                                            class="form-select testingAgency @error('testingAgency') is-invalid @enderror">
                                            <option value="" selected disabled>Select Agency</option>
                                        </select>
                                        @error('testingAgency')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Voltage -->
                                    <div class="col-md-3">
                                        <label class="form-label">Voltage</label>
                                        <select name="voltage"
                                            class="form-select voltage @error('voltage') is-invalid @enderror">
                                            <option value="" selected disabled>Select Voltage</option>
                                        </select>
                                        @error('voltage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Batch No -->
                                    <div class="col-md-3">
                                        <label class="form-label">Batch No</label>
                                        <input type="text" name="batchNo"
                                            class="form-control @error('batchNo') is-invalid @enderror"
                                            value="{{ $batchNo }}">
                                        @error('batchNo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Barcode Creation Type -->
                                    <div class="col-md-3" id="creationTypeContainer">
                                        <label class="form-label">Barcode Creation Type</label>
                                        <select class="form-select" id="barCodeCreationType" name="barCodeCreationType">
                                            <option value="" selected disabled>Select Type</option>
                                            <option value="manual">Manual</option>
                                            <option value="import">Import</option>
                                        </select>
                                    </div>

                                    <!-- Barcode No -->
                                    <div class="col-md-3" id="barcodeNoBox">
                                        <label class="form-label">Barcode No <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('barcodeNo') is-invalid @enderror"
                                            name="barcodeNo" value="{{ old('barcodeNo') }}">
                                        @error('barcodeNo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Details Section -->
                        <div class="card mb-4 border-0 shadow-sm" id="bottomRow">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Additional Details
                                </h6>
                            </div>
                            <div class="card-body" id>
                                <div class="row g-3">
                                    <!-- Renew Status -->
                                    <div class="col-md-2">
                                        <label class="form-label">Is Renew</label>
                                        <select name="is_renew" class="form-select @error('is_renew') is-invalid @enderror">
                                            <option value="1" @selected(old('is_renew') == '1')>No</option>
                                            <option value="0" @selected(old('is_renew') == '0')>Yes</option>
                                        </select>
                                        @error('is_renew')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Serial No -->
                                    <div class="col-md-4">
                                        <label class="form-label">Device Serial No <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="serialNo"
                                            class="form-control @error('serialNo') is-invalid @enderror"
                                            value="{{ old('serialNo') }}">
                                        @error('serialNo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SIM Details Section (Dynamic Content) -->
                        <div id="simDetails"></div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="button" class="btn btn-outline-secondary me-3" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Cancel
                            </button>
                            <button type="submit" class="btn" style="background-color: #260950; color: white;">
                                <i class="fas fa-save me-2"></i>Create Barcode
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            const $element = $('.element');
            $element.on('change', function () {
                const selectedValue = $(this).val();
                var serialNo = serialNo;
                const $form = $(this).parents("form"); // Cache the form for reuse
                const $elementType = $form.find(
                    ".element_type"); // Target the dropdown within the same form

                $elementType.empty(); // Clear previous options
                $elementType.append('<option value="">Loading...</option>'); // Temporary loading indicator

                $.ajax({
                    url: `/manufacturer/fetch/element-type/${selectedValue}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $elementType.empty();
                        $elementType.append(
                            '<option value="">Select Element Type</option>');
                        if (data && data.length > 0) {
                            data.forEach(type => {
                                //alert(JSON.stringify(type));
                                $elementType.append(
                                    `<option value="${type.id}" simcount="${type.sim_count}">${type.type}</option>`
                                );
                            });
                        } else {
                            $elementType.append(
                                '<option value="">No options available</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        // console.error('Error:', error); // Log the error for debugging
                        $elementType.empty();
                        $elementType.append('<option value="">Failed to load options</option>');
                    }
                });

            });

            const $element_type = $('.element_type');
            $element_type.on('change', function () {
                const $simCount = $(this).find('option:selected').attr('simcount');
                const $simDetailsContainer = $('#simDetails');
                $simDetailsContainer.empty();
                if ($simCount != null && $simCount > 0) {
                    // Clear previous SIM details
                    $simDetailsContainer.empty();

                    // Add a heading for the SIM section
                    $simDetailsContainer.append(`
                                                <div class="mb-3">
                                                    <h5 class="text-primary">
                                                        <i class="fas fa-sim-card me-2"></i>
                                                        SIM Card Details
                                                    </h5>
                                                    <hr class="mt-1">
                                                </div>
                                            `);

                    // Create SIM card entries
                    for (let index = 1; index <= $simCount; index++) {
                        $simDetailsContainer.append(`
                                                    <div class="card mb-3 sim-entry" data-sim-index="${index}">
                                                        <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                            <h6 class="mb-0">
                                                                <span class="badge bg-primary me-2">${index}</span>
                                                                SIM Card Configuration
                                                            </h6>
                                                            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-sim" title="Remove SIM">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row g-3">
                                                                <div class="col-md-3">
                                                                    <label class="form-label">SIM Number <span class="text-danger">*</span></label>
                                                                    <input type="text" 
                                                                           class="form-control" 
                                                                           name="simNo[]" 
                                                                           placeholder="e.g. 9876543210123"
                                                                           pattern="[0-9]{13}"
                                                                           title="13-digit SIM number">
                                                                    <div class="invalid-feedback">Please enter a valid 10-digit SIM number</div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">ICCID Number <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"  name="iccidNo[]" placeholder="e.g. 12345ABCDEF12345XYZ67890"  pattern="{25}" title="25 characters are allowed">
                                                                    <div class="invalid-feedback">Please enter a valid ICCID number</div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Validity Date <span class="text-danger">*</span></label>
                                                                    <input type="date" 
                                                                           class="form-control" 
                                                                           name="validity[]"

                                                                           min="${new Date().toISOString().split('T')[0]}">
                                                                    <div class="invalid-feedback">Please select a future date</div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Operator <span class="text-danger">*</span></label>
                                                                    <select class="form-select" name="operator[]" >
                                                                        <option value="" disabled selected>Select Operator</option>
                                                                        <option value="Airtel">Airtel</option>
                                                                        <option value="Jio">Jio</option>
                                                                        <option value="Vodafone Idea">Vodafone Idea</option>
                                                                        <option value="BSNL">BSNL</option>
                                                                        <option value="MTNL">MTNL</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">Please select an operator</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                `);
                    }
                } else {
                    $simDetailsContainer.empty();
                }

                // Handle SIM card removal
                $(document).on('click', '.btn-remove-sim', function () {
                    const $card = $(this).closest('.sim-entry');
                    const index = $card.data('sim-index');

                    // Show confirmation before removal
                    if (confirm(`Are you sure you want to remove SIM ${index}?`)) {
                        $card.remove();
                        // Optionally renumber remaining SIM cards here
                    }
                });

                const $form = $(this).parents("form"); // Cache the form for reuse
                const $model_no = $form.find(
                    ".model-no"); // Target the dropdown within the same form
                const $customFieldsContainer = $form.find(
                    ".type");
                const $voltage = $form.find(
                    ".voltage");
                $customFieldsContainer.remove();
                $model_no.empty(); // Clear previous options
                $model_no.append('<option value="">Loading...</option>'); // Temporary loading indicator
                $voltage.empty();
                $voltage.append('<option value="">Loading...</option>')
                $.ajax({
                    url: `/manufacturer/fetch/model-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $model_no.empty(); // Clear loading message
                        $model_no.append(
                            '<option value="">Select Element Type</option>');
                        $voltage.empty(); // Clear loading message
                        $voltage.append(
                            '<option value="">Select Voltage</option>');
                        if (data && data.length > 0) {
                            data.forEach(modelNo => {
                                $model_no.append(
                                    `<option value="${modelNo.id}">${modelNo.model_no}</option>`
                                );
                                $voltage.append(
                                    `<option value="${modelNo.id}">${modelNo.voltage}</option>`
                                );
                            });
                        } else {
                            $model_no.append(
                                '<option value="">No options available</option>');
                            $voltage.append('<option value="">No options available</option>')
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $model_no.empty();
                        $model_no.append('<option value="">Failed to load options</option>');
                    }
                });
            })


            const $modelNo = $('.model-no');
            $modelNo.on('change', function () {
                const $form = $(this).parents("form"); // Cache the form for reuse
                const $partNo = $form.find(
                    ".partNo"); // Target the dropdown within the same form
                $partNo.empty(); // Clear previous options
                $partNo.append('<option value="">Loading...</option>'); // Temporary loading indicator

                $.ajax({
                    url: `/manufacturer/fetch/part-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $partNo.empty(); // Clear loading message
                        if (data && data.length > 0) {
                            $partNo.empty();
                            $partNo.append(
                                '<option value="">Select Part No.</option>');
                            data.forEach(partlNo => {
                                $partNo.append(
                                    `<option value="${partlNo.id}">${partlNo.part_no}</option>`
                                );
                            });
                        } else {
                            $partNo.append(
                                '<option value="">No options available</option>');

                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $partNo.empty();
                        $partNo.append('<option value="">Failed to load options</option>');
                    }
                });

            })

            const $partNo = $('.partNo');
            $partNo.on('change', function () {
                const $form = $(this).parents("form"); // Cache the form for reuse
                const $tacNo = $form.find(
                    ".tacNo"); // Target the dropdown within the same form
                $tacNo.empty(); // Clear previous options
                $tacNo.append('<option value="">Loading...</option>'); // Temporary loading indicator    
                $.ajax({
                    url: `/manufacturer/fetch/tac-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $tacNo.empty(); // Clear loading message
                        if (data && data.length > 0) {
                            $tacNo.empty();
                            $tacNo.append(
                                '<option value="">Select Part No.</option>');
                            data.forEach(tacNo => {
                                $tacNo.append(
                                    `<option value="${tacNo.id}">${tacNo.tacNo}</option>`
                                );
                            });
                        } else {
                            $tacNo.append(
                                '<option value="">No options available</option>');

                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $tacNo.empty();
                        $tacNo.append('<option value="">Failed to load options</option>');
                    }
                });
            });


            const $tacNo = $('.tacNo');
            $tacNo.on('change', function () {
                const $form = $(this).parents("form"); // Cache the form for reuse
                const $copNo = $form.find(
                    ".copNo"); // Target the dropdown within the same form
                $copNo.empty(); // Clear previous options
                $copNo.append('<option value="">Loading...</option>'); // Temporary loading indicator    
                $.ajax({
                    url: `/manufacturer/fetch/cop-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $copNo.empty(); // Clear loading message
                        if (data && data.length > 0) {
                            $copNo.empty();
                            $copNo.append(
                                '<option value="">Select COP No.</option>');
                            data.forEach(copNo => {
                                $copNo.append(
                                    `<option value="${copNo.id}" validity="${copNo.validTill}">${copNo.COPNo}</option>`
                                );
                            });
                        } else {
                            $copNo.append(
                                '<option value="">No options available</option>');

                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $copNo.empty();
                        $copNo.append('<option value="">Failed to load options</option>');
                    }
                });
            });


            const $copNo = $('.copNo');
            $copNo.on('change', function () {
                const $form = $(this).parents("form"); // Cache the form for reuse
                const $validityState = $(this).find('option:selected').attr('validity') || '';
                alert($validityState);
                const $copValidTill = $form.find(
                    ".copValidTill"); // Target the dropdown within the same form
                const $testingAgency = $form.find(
                    ".testingAgency"); // Target the dropdown within the same form

                $testingAgency.empty(); // Clear previous options
                $testingAgency.append(
                    '<option value="" disabled>Loading...</option>'); // Temporary loading indicator
                $copValidTill.val($validityState);

                $.ajax({
                    url: `/manufacturer/fetch/testing-agency/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $testingAgency.empty(); // Clear loading message
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(testingAgency => {
                                $testingAgency.append(
                                    `<option value="${testingAgency.id}">${testingAgency.testingAgency}</option>`
                                );
                            });
                        } else {
                            $testingAgency.append(
                                '<option value="">No options available</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $testingAgency.empty();
                        $testingAgency.append(
                            '<option value="">Failed to load options</option>');
                    }
                });
            });


        });
    </script>

    <script>
        const $barCodeCreationType = $('#barCodeCreationType');

        $barCodeCreationType.on('change', function () {
            const selectedValue = $(this).val();

            const $simDetails = $("#simDetails");
            const $barcodeNo = $("#barcodeNoBox");
            const $bottomRow = $("#bottomRow");

            if (selectedValue == 'import') {
                // Hide elements
                $("#simDetails").hide();
                $("#barcodeNoBox").hide();
                $("#bottomRow").hide();
                // Set the form action to import route
                $('#creationForm').attr('action', '{{ route('barcode.spreadsheet.import') }}');
                // Avoid duplicating the file upload field on multiple imports
                if (!$('#fileUploadContainer').length) {
                    let templateUrl = '';

                    // Determine the template URL based on simcount value
                    const simcount = $('.element_type').find('option:selected').attr('simcount');
                    if (simcount === '2') {
                        templateUrl = "{{ route('barcode.templete.download', ['filename' => 'ais140.xlsx']) }}";
                    } else if (simcount === '1') {
                        templateUrl = "{{ route('barcode.templete.download', ['filename' => 'nonais.xlsx']) }}";
                    } else {
                        templateUrl = "{{ route('barcode.templete.download', ['filename' => 'nonvltd.xlsx']) }}";
                    }

                    // Create the HTML
                    const uploadHtml = `
                                        <div class="col-md-3" id="fileUploadContainer">
                                            <label for="importFile" class="form-label">Upload File (xml, csv)</label>
                                            <a href="${templateUrl}" class="mt-1">Download Template</a>
                                            <input type="file" name="import" id="importFile" class="form-control form-control-sm mt-1">
                                        </div>`;

                    // Insert the HTML after the specified container
                    $('#creationTypeContainer').after(uploadHtml);
                }



            } else {
                // Show the hidden elements again
                $simDetails.show();
                $barcodeNo.show();
                $bottomRow.show();

                // Reset the form action if needed
                $('#creationForm').attr('action', '{{ route('barcode.store') }}');

                // Remove the file upload field if it exists
                $('#fileUploadContainer').remove();
            }
        });
    </script>

@endsection