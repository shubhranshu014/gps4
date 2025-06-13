@extends($layout)
@section('content')
    <div class="row align-items-center"
        style="background: linear-gradient(135deg, #2a0b5a 0%, #1a0638 100%); padding: 12px 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <i class="fas fa-map-marked-alt text-white fs-4 me-3"></i>
                <h4 class="card-title text-white mb-0" style="font-weight: 600; letter-spacing: 0.5px;">Manage Map Devices
                </h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-md-end justify-content-sm-start">
                <button type="button" class="btn px-4 py-2 d-flex align-items-center btn-theme"
                    style=" 
                                                                                                                                                           border-radius: 6px;
                                                                                                                                                           font-weight: 500;
                                                                                                                                                           letter-spacing: 0.5px;
                                                                                                                                                           box-shadow: 0 2px 8px rgba(106, 17, 203, 0.3);
                                                                                                                                                           transition: all 0.3s ease;"
                    data-bs-toggle="modal" data-bs-target="#mapDevice"
                    onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 12px rgba(106, 17, 203, 0.4)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(106, 17, 203, 0.3)'">
                    <i class="fas fa-plus-circle me-2"></i>
                    Map New Device
                </button>
            </div>
        </div>
    </div>
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
            <strong> {{ Session::get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show my-2" role="alert">
            <strong> {{ Session::get('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div
        class="d-flex flex-column flex-md-row justify-content-between align-items-md-center bg-light rounded-3 p-3 mb-4 shadow-sm my-2">
        <!-- Title Section -->
        <div class="mb-3 mb-md-0">
            <h5 class="mb-0 text-primary fw-semibold">
                <i class="fas fa-map-marked-alt me-2"></i>Mapped Devices List
            </h5>
            <p class="text-muted small mb-0 mt-1">Showing all mapped devices in your network</p>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-outline-primary d-flex align-items-center gap-2 px-3 py-2 action-btn"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-file-pen"></i>
                <span>Edit</span>
            </button>

            <button type="button" class="btn btn-outline-info d-flex align-items-center gap-2 px-3 py-2 action-btn"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-eye"></i>
                <span>View</span>
            </button>

            <button type="button" class="btn btn-outline-success d-flex align-items-center gap-2 px-3 py-2 action-btn"
                data-bs-toggle="modal" data-bs-target="#certificates">
                <i class="fas fa-file-signature"></i>
                <span>Certificates</span>
            </button>

            <button type="button" class="btn btn-outline-secondary d-flex align-items-center gap-2 px-3 py-2 action-btn"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-file-lines"></i>
                <span>Documents</span>
            </button>
        </div>
    </div>

    <style>
        .action-btn {
            transition: all 0.2s ease;
            border-radius: 8px;
            border-width: 2px;
            font-weight: 500;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .action-btn i {
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .action-btn {
                padding: 0.5rem 1rem !important;
                font-size: 0.85rem;
            }

            .action-btn i {
                margin-right: 0.3rem;
            }
        }

        @media (max-width: 576px) {
            .d-flex.flex-wrap {
                gap: 0.5rem !important;
                width: 100%;
            }

            .action-btn {
                flex: 1 1 45%;
                min-width: 120px;
                justify-content: center;
            }
        }
    </style>
    <div class="row my-2">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Info</th>
                        <th>Device No</th>
                        <th>Sim Details</th>
                        <th>State/Division</th>
                        <th>Vehicle Detail</th>
                        <th>Dealer(Technician)</th>
                        <th>Customer Name</th>
                        <th>Customer Mobile</th>
                        <th>Customer Email
                        <th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mapDevices as $item)
                        <tr>
                            <td>
                                {{-- <div class="form-check"> --}}
                                    <!-- Checkbox inside table cell with proper class -->
                                    <input class="" type="checkbox" value="{{ $item->id }}"
                                        id="flexCheckDefault-{{ $loop->index }}" onchange="handleCheckboxSelection(this)">
                                    {{--
                                </div> --}}
                            </td>
                            <td><a href="" class="btn" style="background-color: #260950;color:#fff">Info</a></td>
                            <td><strong>{{ $item->barcodes->pluck('IMEINO')->first()}}
                                    {{ $item->barcodes->pluck('serialNumber')->first() }}</strong></td>
                            <td>
                                @php
                                    $sim = App\Models\Sim::where('barcode_id', $item->device_seriel_no)->get();
                                @endphp
                                @foreach ($sim as $simdata)
                                    {{ $simdata->simNo }}
                                @endforeach
                                {{-- {{$item->device_seriel_no}} --}}
                            </td>
                            <td>{{$item->cusmtomer->customer_state ?? 'N/A'}} /
                                {{$item->cusmtomer->customer_rto_division ?? 'N/A'}}
                            </td>
                            <td>{{ $item->vehicle_registration_number }}</td>
                            <td>{{$item->dealer->business_name}}</td>
                            <td>{{$item->cusmtomer->customer_name}}</td>
                            <td>{{$item->cusmtomer->customer_mobile}}</td>
                            <td>{{$item->cusmtomer->customer_email}}
                            <td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>



    {{-- modal map device --}}
    <div class="modal fade" id="mapDevice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Map Device
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('map.device.store') }}" method="post" enctype="multipart/form-data">
                        <!-- RFC Header -->
                        @csrf
                        <div class="border border-secondary rounded m-3">
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="text-center mb-0">RFC Info</h5>
                            </div>

                            <!-- Form Body -->
                            <div class="border rounded p-3">
                                <div class="row">
                                    @if (Auth::guard('manufacturer')->check())
                                        <!-- Country Dropdown -->
                                        <div class="form-group col-md-3">
                                            <label for="country">Country<span class="badge text-danger">*</span></label>
                                            <select name="country" class="form-select form-select-sm country">
                                                <option disabled @selected(true)>Choose Country
                                                </option>
                                                <option value="china" @selected(old('country') == 'china')>China
                                                </option>
                                                <option value="india" @selected(old('country') == 'india')>India
                                                </option>
                                            </select>
                                            @error('country')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- State Dropdown -->
                                        <div class="form-group col-md-3">
                                            <label for="state">State</label> <span class="badge text-danger">*</span>
                                            <select class="form-select form-select-sm state" name="state" id=""></select>
                                            @error('state')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Distributor Dropdown -->

                                        <div class="form-group col-md-3">
                                            <label for="distributor">Distributor</label><span class="badge text-danger">*</span>
                                            <Select class="form-select form-select-sm distributor" name="distributor">
                                                <option value="">Select Distributor</option>
                                            </Select>
                                            @error('distributor')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <!-- Dealer Dropdown -->
                                        <div class="form-group col-md-3">
                                            <label for="dealer">Dealer </label><span class="badge text-danger">*</span>
                                            <Select class="form-select form-select-sm dealer" name="dealer">
                                                <option value="">Select Dealer</option>
                                            </Select>
                                            @error('dealer')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @else
                                        <div class="form-group col-md-3">
                                            <label for="distributor">Dealer<span class="badge text-danger">*</span>
                                                <Select class="form-select form-select-sm dealer" name="dealer">
                                                    <option selected disabled>Select Dealer</option>
                                                    @foreach ($dealers as $item)
                                                        <option value="{{ $item->id }}" country="{{ $item->country }}"
                                                            state="{{ $item->state }}" dis="{{ $item->district }}"
                                                            rto='@json($item->rto_devision)'>
                                                            {{ $item->business_name }}
                                                        </option>
                                                    @endforeach
                                                </Select>
                                                @error('distributor')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="border border-secondary rounded m-3">
                            <!-- Device Info Header -->
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="text-center mb-0">Device Info</h5>
                            </div>

                            <!-- Form Body -->
                            <div class="border rounded p-2">
                                <div class="row">
                                    <!-- Device Type Dropdown -->
                                    <div class="form-group col-md-4">
                                        <label for="deviceType">Device Type </label><span class="text-danger badge">*</span>
                                        <select id="deviceType" name="deviceType" class="form-select form-select-sm">
                                            <option>Select Device Type</option>
                                            <option value="New">New</option>
                                            <option value="Renewal">Renewal</option>
                                            <!-- Add more device types here if needed -->
                                        </select>
                                        @error('deviceType')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Device No Dropdown -->
                                    <div class="form-group col-md-4">
                                        <label for="deviceNo">Device No</label><span class="text-danger badge">*</span>
                                        <select name="deviceNo" class="form-select form-select-sm deviceno">
                                            <option>Select Device Number</option>
                                            <!-- Add more device numbers here if needed -->
                                        </select>
                                        @error('deviceNo')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Voltage Input (disabled) -->
                                    <div class="form-group col-md-4">
                                        <label for="voltage">Voltage</label>
                                        <input type="text" class="form-control form-control-sm voltage" name="voltage"
                                            placeholder="" readonly>
                                        @error('voltage')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Element Type Input (disabled) -->
                                    <div class="form-group col-md-4">
                                        <label for="elementType">Element Type</label>
                                        <input type="text" class="form-control form-control-sm element_type"
                                            id="elementType" name="elementType" placeholder="" readonly>
                                    </div>

                                    <!-- Batch No Input (disabled) -->
                                    <div class="form-group col-md-4">
                                        <label for="batchNo">Batch No.</label>
                                        <input type="text" class="form-control form-control-sm batch_no" id="batchNo"
                                            name="batchNo" placeholder="" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border border-secondary rounded m-3">
                            <!-- Form Header -->
                            <div class="bg-light p-2 border rounded-top  simInfo">
                                <h5 class=" text-center mb-0">SIM Info</h5>
                            </div>
                        </div>

                        <div class="border border-secondary rounded m-3">
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="text-center mb-0">
                                    Vehicle Info
                                </h5>
                            </div>
                            <div class="border rounded p-3">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="vehicleBirth">Vehicle Birth<span
                                                class="text-danger badge">*</span></label>
                                        <select id="vehicleBirth" name="vehicleBirth" class="form-select form-select-sm">
                                            <option selected value="Old">Old</option>
                                            <option value="New">New</option>
                                        </select>
                                        @error('vehicleBirth')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4" id="vaicleregNumber">
                                        <label for="regNumber">Registration No.<span
                                                class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="regNumber"
                                            name="regNumber" placeholder="Enter Registration Number">
                                        @error('regNumber')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4" id="vaicledate">
                                        <label for="date">Date<span class="text-danger badge">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="date" name="regdate">
                                        @error('date')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="chassisNumber">Chassis Number<span
                                                class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="chassisNumber"
                                            name="chassisNumber" placeholder="Enter Chassis Number">
                                        @error('chassisNumber')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="engineNumber">Engine Number<span
                                                class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="engineNumber"
                                            name="engineNumber" placeholder="Enter Engine Number">
                                        @error('engineNumber')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="vehicleType">Vehicle Type<span
                                                class="text-danger badge">*</span></label>
                                        <select id="vehicleType" name="vehicleType" class="form-control form-control-sm">
                                            <option selected>Choose Vehicle Type</option>
                                            <option value="AUTO">AUTO</option>
                                            <option value="BUS">BUS</option>
                                            <option value="JCB">JCB</option>
                                            <option value="MAXI CAB">MAXI CAB</option>
                                            <option value="OIL TANK">OIL TANK</option>
                                            <option value="PICKUP">PICKUP</option>
                                            <option value="SCHOOL BUS">SCHOOL BUS</option>
                                            <option value="TANK TRUCK">TANK TRUCK</option>
                                            <option value="TAXI">TAXI</option>
                                            <option value="TEMPO">TEMPO</option>
                                            <option value="TRACTOR">TRACTOR</option>
                                            <option value="TRAILER TRUCK">TRAILER TRUCK</option>
                                            <option value="TRAVILER">TRAVILER</option>
                                            <option value="TRUCK">TRUCK</option>
                                        </select>
                                        @error('vehicleType')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="makeModel">Make & Model<span class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="vaiModel"
                                            name="vaiclemodel" placeholder="Enter Make & Model">
                                        @error('vaiclemodel')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="modelYear">Model Year<span class="text-danger badge">*</span></label>
                                        <input type="text" class="form-control" id="modelYear" name="vaimodelyear"
                                            placeholder="Enter Model Year">
                                        @error('vaimodelyear')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="insurance">Insu. Renew date</label>
                                        <input type="date" class="form-control" id="insurance" name="vaicleinsurance">
                                        @error('vaicleinsurance')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="panicButton">Pollution Renew date</label>
                                        <input type="date" class="form-control" id="panicButton" name="pollutiondate">
                                        @error('pollutiondate')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border border-secondary rounded m-3">
                            <div class="bg-light p-3 border rounded-top">
                                <h5 class="text-center mb-0">Customer Info</h5>
                            </div>
                            <div class="border rounded p-3">
                                <div class="row g-3 mb-4">
                                    <!-- Customer Name -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control shadow-sm" id="customerName"
                                                name="customerName" placeholder="Enter Name"
                                                value="{{ old('customerName') }}">
                                            <label for="customerName" class="text-muted small">Full Name <span
                                                    class="text-danger">*</span></label>
                                            @error('customerName')
                                                <div class="invalid-feedback d-block small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Customer Email -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="email" class="form-control shadow-sm" id="email"
                                                name="customerEmail" placeholder="Enter Email"
                                                value="{{ old('customerEmail') }}">
                                            <label for="email" class="text-muted small">Email Address</label>
                                            @error('customerEmail')
                                                <div class="invalid-feedback d-block small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Customer Mobile -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control shadow-sm" id="mobile"
                                                name="customerMobile" placeholder="Enter Mobile"
                                                value="{{ old('customerMobile') }}">
                                            <label for="mobile" class="text-muted small">Mobile Number <span
                                                    class="text-danger">*</span></label>
                                            @error('customerMobile')
                                                <div class="invalid-feedback d-block small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- GSTIN Number -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control shadow-sm" id="gstin"
                                                name="customergstin" placeholder="Enter GSTIN"
                                                value="{{ old('customergstin') }}">
                                            <label for="gstin" class="text-muted small">GSTIN Number</label>
                                            @error('customergstin')
                                                <div class="invalid-feedback d-block small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Country -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control shadow-sm bg-light" name="country"
                                                id="country" value="{{ old('country') }}" readonly>
                                            <label for="country" class="text-muted small">Country <span
                                                    class="text-danger">*</span></label>
                                            @error('country')
                                                <div class="invalid-feedback d-block small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- State -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control shadow-sm bg-light" name="state"
                                                id="state" value="{{ old('state') }}" readonly>
                                            <label for="state" class="text-muted small">State/Region <span
                                                    class="text-danger">*</span></label>
                                            @error('state')
                                                <div class="invalid-feedback d-block small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mb-4">
                                    <!-- District -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control shadow-sm bg-light"
                                                name="coustomerDistrict" id="district" readonly
                                                value="{{ old('coustomerDistrict') }}">
                                            <label for="district" class="text-muted small">District <span
                                                    class="text-danger">*</span></label>
                                            @error('coustomerDistrict')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- RTO Division -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select class="form-select shadow-sm" name="rto_devision" id="rto_division">
                                                <option value="" selected disabled hidden>Select RTO Division</option>
                                                <!-- Options will be populated dynamically -->
                                            </select>
                                            <label for="rto_division" class="text-muted small">RTO Division <span
                                                    class="text-danger">*</span></label>
                                            @error('rto_division')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>

                                    <!-- Pin Code -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control shadow-sm" name="coustomerPincode"
                                                id="pincode" value="{{ old('coustomerPincode') }}">
                                            <label for="pincode" class="text-muted small">Pin Code <span
                                                    class="text-danger">*</span></label>
                                            @error('coustomerPincode')
                                                <div class="invalid-feedback d-block small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-md-8">
                                        <div class="form-floating">
                                            <input type="text" class="form-control shadow-sm" id="address"
                                                name="coustomeraddress" placeholder=" "
                                                value="{{ old('coustomeraddress') }}">
                                            <label for="address" class="text-muted small">Complete Address <span
                                                    class="text-danger">*</span></label>
                                            @error('coustomeraddress')
                                                <div class="invalid-feedback d-block small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Aadhaar -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control shadow-sm" id="aadhaar"
                                                name="customeraadhar" placeholder=" " value="{{ old('customeraadhar') }}">
                                            <label for="aadhaar" class="text-muted small">Aadhaar Number <span
                                                    class="text-danger">*</span></label>
                                            @error('customeraadhar')
                                                <div class="invalid-feedback d-block small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- PAN Number -->
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control shadow-sm" id="panNo"
                                                name="customerpanno" placeholder=" " value="{{ old('customerpanno') }}">
                                            <label for="panNo" class="text-muted small">PAN Number <span
                                                    class="text-danger">*</span></label>
                                            @error('customerpanno')
                                                <div class="invalid-feedback d-block small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border border-secondary rounded m-3">
                            <div class="bg-light p-2 border rounded-top">
                                <h5 class="text-center mb-0">Packages</h5>
                            </div>
                            <div class="border rounded p-3">
                                <div class="row justify-content-center">
                                    @foreach ($subscriptions as $item)
                                        <div class="col-md-3 mb-2 Packages">
                                            <div class=" text-center shadow-sm h-100 select-subscription" data-id=""
                                                style="width: 100%; cursor: pointer;">
                                                <!-- Added cursor:pointer for click indication -->
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 class="card-title fw-bold">{{ $item->packageName }}</h5>
                                                        <span class="packageId" hidden>{{ $item->id }}</span>
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-clock me-1"></i>
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                    <h5 class="mt-2"><i class="fa-solid fa-indian-rupee-sign"></i>
                                                        {{ $item->price }}</h5>
                                                    <p class="text-white">{{ $item->billingCycle }}</p>
                                                    {{-- <p class="card-text">{{$item->description}}</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('subscriptionpackage')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <input type="hidden" name="subscriptionpackage" id="subscriptionpackage">
                            </div>

                        </div>
                        <div class="border border-secondary rounded m-3">
                            <div class="bg-light border rounded-top p-3">
                                <div class="row align-items-center">
                                    <!-- Technician Info Title -->
                                    <div class="col-md-6 text-center">
                                        <h5>Technician Info</h5>
                                    </div>

                                    <!-- Select Technician Dropdown -->
                                    <div class="col-md-3">
                                        <select class="form-select form-select-sm technician" name="technician">
                                            <option selected disabled>Select Technician</option>
                                        </select>
                                        @error('technician')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Add Technician Button -->
                                    <div class="col-md-3 text-end">
                                        {{-- <button type="button" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#addTechnician" style="background-color: #260950;color:#fff">
                                            Add Technician
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="form-group col-md-4">
                                    <label for="firstName" class="form-label">Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="technician_name" name="name"
                                        placeholder="First Name" require readonly>

                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror

                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="lastName" class="form-label">Last Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="lastName"
                                        name="techlastName" placeholder="Last Name" require>
                                </div> --}}
                                <div class="form-group col-md-4">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="technician_email"
                                        name="techemail" placeholder="Email" readonly>
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="Gender" name="techgender"
                                        placeholder="Gender">
                                </div> --}}
                                <div class="form-group col-md-4">
                                    <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="technician_mobile"
                                        name="techmobile" placeholder="Mobile" readonly>
                                </div>
                                {{-- <div class="form-group col-md-4">
                                    <label for="dob" class="form-label">Date Of Birth</label>
                                    <input type="date" class="form-control form-control-sm" id="dob" name="techdob"
                                        placeholder="Date Of Birth">
                                </div> --}}
                            </div>
                        </div>
                </div>


                <div class="border border-secondary rounded m-3">
                    <div class="bg-light p-2 border rounded-top">
                        <h5 class="text-center mb-0">Installation Detail</h5>
                    </div>
                    <div class="border rounded p-3">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="InvoiceNo" class="form-label">Invoice No<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="InvoiceNo" name="InvoiceNo">
                                @error('InvoiceNo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Vehicle KM Reading" class="form-label">Vehicle KM
                                    Reading<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="VehicleKMReading"
                                    name="VehicleKMReading">
                                @error('VehicleKMReading')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Driver License No" class="form-label">Driver License
                                    No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="DriverLicenseNo"
                                    name="DriverLicenseNo">
                                @error('DriverLicenseNo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Mapped Date" class="form-label">Mapped Date<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="MappedDate" name="MappedDate">
                                @error('MappedDate')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="No Of Panic Buttons" class="form-label">No Of Panic
                                    Buttons<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="NoOfPanicButtons"
                                    name="NoOfPanicButtons">
                                @error('NoOfPanicButtons')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border border-secondary rounded m-3">
                    <div class="bg-light p-2 border rounded-top">
                        <h5 class="text-center mb-0">Vehicle Document (* document)</h5>
                    </div>
                    <div class="border rounded p-3">
                        <p class="text-danger small mb-2 text-center">
                            * File types supported: PNG, JPG, JPEG, PDF only. File size should be up to 6MB.
                        </p>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="vehicle" class="form-label">Vehicle</label>
                                <input type="file" class="form-control form-control-sm preview-upload" id="vehicle"
                                    name="vehicleimg" accept=".png,.jpg,.jpeg,.pdf">
                                <div class="mt-2 text-center">
                                    <img id="preview-vehicle" class="img-fluid border rounded d-none" alt="Vehicle Preview"
                                        style="max-height: 150px;">
                                </div>
                                @error('vehicleimg')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="rc" class="form-label">RC</label>
                                <input type="file" class="form-control form-control-sm preview-upload" id="rc"
                                    name="vehiclerc" accept=".png,.jpg,.jpeg,.pdf">
                                <div class="mt-2 text-center">
                                    <img id="preview-rc" class="img-fluid border rounded d-none" alt="RC Preview"
                                        style="max-height: 150px;">
                                </div>
                                @error('vehiclerc')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="device" class="form-label">Device</label>
                                <input type="file" class="form-control form-control-sm preview-upload" id="device"
                                    name="vaicledeviceimg" accept=".png,.jpg,.jpeg,.pdf">
                                <div class="mt-2 text-center">
                                    <img id="preview-device" class="img-fluid border rounded d-none" alt="Device Preview"
                                        style="max-height: 150px;">
                                </div>
                                @error('vaicledeviceimg')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="pan" class="form-label">Pan Card</label>
                                <input type="file" class="form-control form-control-sm preview-upload" id="pan"
                                    name="pancardimg" accept=".png,.jpg,.jpeg,.pdf">
                                <div class="mt-2 text-center">
                                    <img id="preview-pan" class="img-fluid border rounded d-none" alt="Pan Card Preview"
                                        style="max-height: 150px;">
                                </div>
                                @error('pancardimg')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="aadhaar" class="form-label">Aadhaar Card</label>
                                <input type="file" class="form-control form-control-sm preview-upload" id="aadhaar"
                                    name="aadharcardimg" accept=".png,.jpg,.jpeg,.pdf">
                                <div class="mt-2 text-center">
                                    <img id="preview-aadhaar" class="img-fluid border rounded d-none"
                                        alt="Aadhaar Card Preview" style="max-height: 150px;">
                                </div>
                                @error('aadharcardimg')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="invoice" class="form-label">Invoice</label>
                                <input type="file" class="form-control form-control-sm preview-upload" id="invoice"
                                    name="invoiceimg" accept=".png,.jpg,.jpeg,.pdf">
                                <div class="mt-2 text-center">
                                    <img id="preview-invoice" class="img-fluid border rounded d-none" alt="Invoice Preview"
                                        style="max-height: 150px;">
                                </div>
                                @error('invoiceimg')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="signature" class="form-label">Signature</label>
                                <input type="file" class="form-control form-control-sm preview-upload" id="signature"
                                    name="signatureimg" accept=".png,.jpg,.jpeg,.pdf">
                                <div class="mt-2 text-center">
                                    <img id="preview-signature" class="img-fluid border rounded d-none"
                                        alt="Signature Preview" style="max-height: 150px;">
                                </div>
                                @error('signatureimg')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="panic" class="form-label">Panic Button with Sticker</label>
                                <input type="file" class="form-control form-control-sm preview-upload" id="panic"
                                    name="panicbuttonimg" accept=".png,.jpg,.jpeg,.pdf">
                                <div class="mt-2 text-center">
                                    <img id="preview-panic" class="img-fluid border rounded d-none"
                                        alt="Panic Button Preview" style="max-height: 150px;">
                                </div>
                                @error('panicbuttonimg')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center my-2">
                    <button type="submit" class="btn" style="background-color: #260950;color:#fff">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Certificates -->
    <div class="modal fade" id="certificates" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Certificates</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('download.PDF') }}" method="post">
                        @csrf
                        <div class="mb-2">
                            <select name="type" class="form-select form-select-sm">
                                <option value="customer_copy">Customer Copy</option>
                                <option value="department_copy">Department Copy</option>
                            </select>
                        </div>
                        <input type="text" name="deviceId" id="deviceId" style="display: none">
                        <div class="mb-2">
                            <label for="" class="form-label">Leatter Head</label>
                            <select name="letterHead" class="form-select form-select-sm">
                                <option value="allow">Allow</option>
                                <option value="deny">Deny</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Certificate</label>
                            <select name="certificate" class="form-select form-select-sm">
                                <option value="installation">Installation</option>
                                <option value="warranty">Warranty</option>
                                <option value="fitment">Fitment</option>
                            </select>
                        </div>
                        <div style="text-align: right">
                            <button class="btn" style="background-color: #260950;color:#fff">Download</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
    <style>
        .form-floating {
            position: relative;
        }

        .form-floating label {
            transition: all 0.2s ease;
        }

        .form-control {
            border-radius: 0.375rem;
            border: 1px solid #dee2e6;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .form-control.bg-light {
            background-color: #f8f9fa !important;
        }

        .invalid-feedback {
            margin-top: 0.25rem;
        }
    </style>
    <script>
        document.querySelectorAll('.preview-upload').forEach(input => {
            input.addEventListener('change', function () {
                const file = this.files[0];
                const previewId = `preview-${this.id}`;
                const previewElement = document.getElementById(previewId);

                if (file) {
                    const fileType = file.type;

                    if (fileType.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            previewElement.src = e.target.result;
                            previewElement.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    } else if (fileType === 'application/pdf') {
                        previewElement.src = 'path/to/pdf-icon.png'; // Use a placeholder PDF icon
                        previewElement.classList.remove('d-none');
                    } else {
                        alert('Unsupported file type!');
                        this.value = ''; // Clear invalid file
                        previewElement.classList.add('d-none');
                    }
                } else {
                    previewElement.classList.add('d-none');
                }
            });
        });

    </script>
    <script>
        $(document).ready(function () {
            $('.state').change(function () {
                $('.distributor').empty();
                $('.distributor').append('<option value="null">Select distributer</option>');
                const state = $(this).val();
                //alert(state);
                if (state) {
                    $.ajax({
                        url: `/manufacturer/fetch/distributer/${state}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            //alert(JSON.stringify(data));
                            data.forEach(distributer => {
                                $(`.distributor`).append(`
                                                                                                                                                                    <option value="${distributer.id}">${distributer.business_name}</option>
                                                                                                                                                                    `);
                            });
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.distributor').change(function () {
                $('.dealer').empty(); // Clear existing options in the dealer dropdown
                $('.dealer').append('<option disabled selected>Select dealer</option>');
                const distributer_id = $(this).val(); // Get the selected distributor ID
                if (distributer_id) { // Ensure a valid distributor ID is selected
                    $.ajax({
                        url: `/fetch/dealer/${distributer_id}`, // API endpoint
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Check if data is an array and populate dealer dropdown
                            if (Array.isArray(data) && data.length > 0) {
                                data.forEach(dealer => {
                                    $('.dealer').append(`
                                                                                                                                                                                        <option value="${dealer.id}" country="${dealer.country}" state="${dealer.state}" dis="${dealer.district}" rto="${dealer.rto_devision}" >${dealer.business_name}</option>
                                                                                                                                                                                    `);
                                });
                            } else {
                                alert('No dealers found for the selected distributor.');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX error:', status, error);
                            alert('Failed to fetch dealers. Please try again.');
                        }
                    });
                } else {
                    alert('Please select a valid distributor.');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(".Packages").click(function () {
                // Retrieve the package ID
                var packageId = $(this).find('.packageId').text();

                console.log("Package Id: " + packageId);

                // Update the hidden input field with the selected package ID
                $("#subscriptionpackage").val(packageId);

                // Reset the background styles for all packages
                $(".Packages .card-body").css('background-image', '');

                // Apply the highlight style to the selected package
                $(this).find('.card-body').css('background-image', 'linear-gradient(90deg, rgba(235, 225, 225, 1) 0%, rgba(87, 199, 133, 1) 50%)');
            });
        });

    </script>
    <script>
        $('.dealer').change(function () {
            alert('ok');
            const value = $(this).find("option:selected");
            const dealer = $(this).val();
            const state = value.attr("state");
            const country = value.attr("country");
            const capitalizedCountry = country.replace(/\b\w/g, (char) => char.toUpperCase()); // Capitalize
            const dis = value.attr('dis')
            const rto = value.attr("rto"); // Example: "MH12,MH13,MH14"
            const rtoArray = rto.split(","); // Split the string into an array

            // Append each RTO value to the dropdown
            rtoArray.forEach((rtoItem) => {
                // alert('rto' + rtoItem)
                $('#rto_division').append(`<option value="${rtoItem}">${rtoItem}</option>`);
            });

            $('#state').val(state);
            $('#country').val(capitalizedCountry);
            $('#district').val(dis);

            // alert(typeof ( ))
            // alert(state);
            // alert(dealer);
            // alert(rto);
            if (dealer) {
                $.ajax({
                    url: `/fetch/device-by-dealer/${dealer}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // alert(JSON.stringify(data))
                        //Validate response
                        if (Array.isArray(data) && data.length > 0) {
                            // Populate distributors
                            $('.deviceno').empty().append(
                                '<option value="null">Select Device No</option>');
                            data.forEach(device => {
                                $('.deviceno').append(`
                                                                                                                                                                                                <option value="${device.barcode.id}">${device.barcode.IMEINO}</option>
                                                                                                                                                                                            `);
                            });
                        } else {
                            // No distributors found
                            $('.deviceno').empty().append(
                                '<option value="null">No Device Found</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors
                        $('.deviceno').empty().append(
                            '<option value="null">Error Loading Device</option>');
                        console.error(`Error: ${error}, Status: ${status}`);
                    }
                });
                $.ajax({
                    url: `/manufacturer/fetch/technician/${dealer}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        // alert(JSON.stringify(data));
                        if (Array.isArray(data) && data.length > 0) {
                            // Populate distributors
                            $('.technician').empty().append(
                                '<option value="null">Select Technician No</option>');
                            data.forEach(technician => {
                                $('.technician').append(`
                                                                                                                                                                                                <option value="${technician.id}" name="${technician.name}" email="${technician.email}" mobile="${technician.mobile}">${technician.name}</option>
                                                                                                                                                                                            `);
                            });
                        } else {
                            // No distributors found
                            $('.deviceno').empty().append(
                                '<option value="null">No Device Found</option>');
                        }
                    }
                });


            }
        });
    </script>
    <script>
        $('.technician').change(function () {
            // Get the selected option element
            const selectedOption = $(this).find('option:selected');

            // Get the value of the selected option
            const technician = $(this).val();

            // Get the custom attribute (mobile) of the selected option
            const mobile = selectedOption.attr('mobile');
            const name = selectedOption.attr('name');
            const email = selectedOption.attr('email');

            // Show alerts

            $('#technician_name').val(name);
            $('#technician_mobile').val(mobile);
            $('#technician_email').val(mobile);

        });
    </script>
    <script>
        $('.deviceno').change(function () {
            const deviceNo = $(this).val();
            // alert(deviceNo);
            if (deviceNo) {
                $.ajax({
                    url: `/manufacturer/fetch/simInfoByBarcode/${deviceNo}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            alert(JSON.stringify(data))
                            data.forEach(sim_info => {
                                $('.simInfo').append(
                                    ` 
                                                                                                                                                                                                    <div class="row py-2">
                                                                                                                                                                                                      <div class="col-md-3">
                                                                                                                                                                                                        <label>Sim No.</label>
                                                                                                                                                                                                        <input class="form-control form-control-sm" value="${sim_info.simNo}">
                                                                                                                                                                                                        </div> 
                                                                                                                                                                                                         <div class="col-md-3">
                                                                                                                                                                                                             <label>ICCID No.</label>
                                                                                                                                                                                                             <input class="form-control form-control-sm" value="${sim_info.ICCIDNo}">
                                                                                                                                                                                                        </div> 
                                                                                                                                                                                                         <div class="col-md-3">
                                                                                                                                                                                                             <label>Validity</label>
                                                                                                                                                                                                             <input class="form-control form-control-sm" value="${sim_info.validity}">
                                                                                                                                                                                                        </div> 
                                                                                                                                                                                                        <div class="col-md-3">
                                                                                                                                                                                                            <label>Operator</label>
                                                                                                                                                                                                            <input class="form-control form-control-sm" value="${sim_info.operator}">
                                                                                                                                                                                                        </div>  
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    `
                                )
                            });
                            // Example: populate a select dropdown with the returned data
                            // var options = data.options.map(function(option) {
                            //     return `<option value="${option.value}">${option.label}</option>`;
                            // }).join('');
                            // $('.deviceno').html(options);
                        } else {
                            // Handle failure or empty data scenario
                            // $('.deviceno').empty().append(
                            //     '<option value="null">No data available</option>');
                            alert('No data available')
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle AJAX error
                        console.error('AJAX request failed:', status, error);
                        // $('.deviceno').empty().append(
                        //     '<option value="null">Error fetching data</option>');
                        alert('Error fetching data')
                    }
                });
            } else {
                $('.deviceno').empty().append('<option value="null">Please select a device first</option>');
            }

        });
    </script>

    <script>
        // Define the districts object globally, so both event handlers can access it
        let districts = {
            "Andhra Pradesh": ['Chittoor', 'East Godavari', 'Guntur', 'Krishna', 'Kurnool', 'Nellore', 'Prakasam',
                'Srikakulam'
            ],
            "Maharashtra": ['Mumbai', 'Pune', 'Nagpur', 'Thane', 'Nashik', 'Solapur', 'Satara'],
            "Tamil Nadu": ['Chennai', 'Coimbatore', 'Madurai', 'Salem', 'Trichy', 'Erode'],
            "Odisha": ["Angul", "Balangir", "Balasore", "Bargarh", "Bhadrak", "Boudh", "Cuttack", "Debagarh",
                "Dhenkanal", "Gajapati",
                "Ganjam", "Jagatsinghpur", "Jajpur", "Jharsuguda", "Kalahandi", "Kandhamal", "Kendrapara",
                "Kendujhar", "Khordha",
                "Koraput", "Malkangiri", "Mayurbhanj", "Nabarangpur", "Nayagarh", "Nuapada", "Puri", "Rayagada",
                "Sambalpur",
                "Subarnapur", "Sundargarh"
            ]
        };

        // Handle country selection
        $('.customer-country').on('change', function () {
            $('.customer-state').empty();
            $('.customer-district').empty(); // Clear the district dropdown when country changes
            let value = this.value;

            // Define states for different countries
            let china = ['Beijing'];
            let india = ['Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat',
                'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Maharashtra',
                'Madhya Pradesh', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab',
                'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Tripura', 'Telangana', 'Uttar Pradesh', 'Uttarakhand',
                'West Bengal', 'Andaman & Nicobar (UT)', 'Chandigarh (UT)',
                'Dadra & Nagar Haveli and Daman & Diu (UT)', 'Delhi [National Capital Territory (NCT)]',
                'Jammu & Kashmir (UT)', 'Ladakh (UT)', 'Lakshadweep (UT)', 'Puducherry (UT)'
            ];

            // Append states to the state dropdown based on the selected country
            switch (value) {
                case "china":
                    for (let state of china) {
                        $('.customer-state').append($('<option>', {
                            value: state,
                            text: state
                        }));
                    }
                    break;
                case "india":
                    for (let state of india) {
                        $('.customer-state').append($('<option>', {
                            value: state,
                            text: state
                        }));
                    }
                    break;
                default:
                    break;
            }
        });

        // Handle state selection to populate districts
        $('.customer-state').on('change', function () {
            $('.customer-district').empty(); // Clear existing districts
            let selectedState = this.value;

            // Check if the selected state has predefined districts
            let districtList = districts[selectedState] || [];

            if (districtList.length > 0) {
                for (let district of districtList) {
                    $('.customer-district').append($('<option>', {
                        value: district,
                        text: district
                    }));
                }
            } else {
                $('.customer-district').append($('<option>', {
                    value: "",
                    text: "No districts available"
                }));
            }
        });
    </script>

    <script>
        function handleCheckboxSelection(checkbox) {
            // Get all checkboxes in the table
            var checkboxes = document.querySelectorAll('.form-check-input');

            // Loop through all checkboxes
            checkboxes.forEach(function (item) {
                // If the current checkbox is not the one being clicked, uncheck it
                if (item !== checkbox) {
                    item.checked = false;
                }
            });

            // Get the value of the selected checkbox
            var selectedValue = checkbox.value;

            // Check if selectedValue is null or empty
            if (!selectedValue) {
                alert("Please select a device first.");
            } else {
                // If a value is selected, proceed with the action
                alert("Selected Device: " + selectedValue);
                $('#deviceId').val(selectedValue); // Assuming you have an element with ID "deviceId"
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            function fetchCustomerData(endpoint, value) {
                $.ajax({
                    url: endpoint, // URL of your API or route
                    method: 'GET',
                    data: { query: value }, // Send the value (email or mobile) to the server
                    success: function (response) {
                        if (response.success) {
                            // Populate the form fields with the returned customer data
                            $("#customerName").val(response.data.customer_name).prop('readonly', true);
                            $("#email").val(response.data.customer_email).prop('readonly', true);
                            $("#mobile").val(response.data.customer_mobile).prop('readonly', true);
                            $("#gstin").val(response.data.gstin).prop('readonly', true);
                            $("#country").val(response.data.country).prop('readonly', true);
                            $("#state").val(response.data.state).prop('readonly', true);
                            $("#district").val(response.data.district).prop('readonly', true);
                            // $("#rto_division").val(response.data.rtoDivision); // Uncomment if needed
                            $("#pincode").val(response.data.pincode).prop('readonly', true);
                            $("#address").val(response.data.address).prop('readonly', true);
                            $("#aadhaar").val(response.data.aadhaar).prop('readonly', true);
                            $("#panNo").val(response.data.pan).prop('readonly', true);
                        } else {
                            alert(response.message || "Customer not found! Please enter the details manually.");
                            // Allow manual input for all fields
                            enableManualEntry();
                        }
                    },
                    error: function () {
                        alert("Error fetching customer data. Please enter the details manually.");
                        // Allow manual input for all fields
                        enableManualEntry();
                    }
                });
            }

            function enableManualEntry() {
                // Make all fields editable
                $("#customerName").prop('readonly', false);
                $("#email").prop('readonly', false);
                $("#mobile").prop('readonly', false);
                $("#gstin").prop('readonly', false);
                $("#country").prop('readonly', false);
                $("#state").prop('readonly', false);
                $("#district").prop('readonly', false);
                // $("#rto_division").prop('readonly', false); // Uncomment if needed
                $("#pincode").prop('readonly', false);
                $("#address").prop('readonly', false);
                $("#aadhaar").prop('readonly', false);
                $("#panNo").prop('readonly', false);
            }

            // Trigger AJAX call when email input loses focus
            $("#email").blur(function () {
                const email = $(this).val();
                if (email) {
                    fetchCustomerData('/manufacturer/fetch-customer-by-email', email); // Replace with your API endpoint
                }
            });

            // Trigger AJAX call when mobile input loses focus
            $("#mobile").blur(function () {
                const mobile = $(this).val();
                if (mobile) {
                    fetchCustomerData('/manufacturer/fetch-customer-by-mobile', mobile); // Replace with your API endpoint
                }
            });
        });

    </script>
@endsection