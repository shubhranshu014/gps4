@extends('layouts.manufacturer')
@section('content')
    <div class="px-0 container-fluid">
        <!-- Header Section -->
        <div class="align-items-center mb-4 row" style="background: linear-gradient(135deg, #260950 0%, #3a1b7a 100%);">
            <div class="col-md-8">
                <h4 class="mb-0 px-3 py-3 text-white">
                    <i class="me-2 fas fa-barcode"></i>
                    Allocated Barcode Management
                </h4>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-end pe-3">
                    <a href="{{ route('create.admin') }}" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        <i class="me-2 fas fa-share-nodes"></i> Allocate Barcode
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="mb-4 row">
            <div class="mb-3 col-md-3">
                <div class="shadow-sm border-0 h-100 card"
                    style="background: linear-gradient(135deg, #260950 0%, #3a1b7a 100%);">
                    <div class="py-3 text-center card-body">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="me-2 text-white fas fa-microchip fs-4"></i>
                            <h3 class="mb-0 text-white card-title">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->count() }}
                            </h3>
                        </div>
                        <p class="mb-0 text-white card-text">TOTAL DEVICES</p>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-3">
                <div class="shadow-sm border-0 h-100 card"
                    style="background: linear-gradient(135deg, #086c57 0%, #0d9d7f 100%);">
                    <div class="py-3 text-center card-body">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="me-2 text-white fas fa-check-circle fs-4"></i>
                            <h3 class="mb-0 text-white card-title">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', '0')->count() }}
                            </h3>
                        </div>
                        <p class="mb-0 text-white card-text">AVAILABLE DEVICES</p>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-3">
                <div class="shadow-sm border-0 h-100 card"
                    style="background: linear-gradient(135deg, #e9b517 0%, #f5c542 100%);">
                    <div class="py-3 text-center card-body">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="me-2 text-white fas fa-user-clock fs-4"></i>
                            <h3 class="mb-0 text-white card-title">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', '1')->count() }}
                            </h3>
                        </div>
                        <p class="mb-0 text-white card-text">ALLOCATED DEVICES</p>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-3">
                <div class="shadow-sm border-0 h-100 card"
                    style="background: linear-gradient(135deg, #dc3545 0%, #e4606d 100%);">
                    <div class="py-3 text-center card-body">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="me-2 text-white fas fa-bolt fs-4"></i>
                            <h3 class="mb-0 text-white card-title">
                                {{ App\Models\BarCode::where('mfg_id', auth('manufacturer')->user()->id)->where('status', '2')->count() }}
                            </h3>
                        </div>
                        <p class="mb-0 text-white card-text">INSTALLED DEVICES</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if (Session::has('success'))
            <div class="shadow-sm alert alert-success alert-dismissible fade show" role="alert">
                <i class="me-2 fas fa-check-circle"></i>
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="shadow-sm alert alert-danger alert-dismissible fade show" role="alert">
                <i class="me-2 fas fa-exclamation-circle"></i>
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Table Section -->
        <div class="shadow-sm border-0 card">
            <div class="bg-white py-3 border-bottom card-header">
                <h5 class="mb-0">
                    <i class="me-2 text-primary fa-list-ol fas"></i>
                    Allocated Barcode List
                </h5>
            </div>
            <div class="p-0 card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle dataTable">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Distributor</th>
                                <th>Dealer</th>
                                <th>Barcode No</th>
                                <th>Allocated At</th>
                                <th class="pe-4 text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allocatedBarcode as $barcode)
                                <tr>
                                    <td class="ps-4">{{ $loop->iteration }}</td>
                                    <td>{{ $barcode->distributor->pluck('business_name')->first() ?? 'N/A' }}</td>
                                    <td>{{ $barcode->dealer->business_name }}</td>
                                    <td>
                                       <span
                                            class="bg-primary badge">{{ $barcode->barcode->barcodeNo ?? 'N/A' }}</span>
                                    </td>
                                    <td>{{ $barcode->created_at->format('d M Y H:i') }}</td>
                                    <td class="pe-4 text-end">
                                        <button class="btn-outline-primary btn btn-sm" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn-outline-danger btn btn-sm" title="Revoke Allocation">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          
    <!-- Allocation Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="shadow-lg border-0 modal-content">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #260950 0%, #3a1b7a 100%); color: white;">
                    <h5 class="modal-title">
                        <i class="me-2 fas fa-share-nodes"></i>
                        Allocate Barcode
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('barcode.allocate.store') }}" method="post">
                        @csrf
                        <div class="mb-4 row g-3">
                            <!-- Location Details -->
                            <div class="col-md-3">
                                <label class="form-label">Country</label>
                                <select name="country" class="form-select country @error('country') is-invalid @enderror">
                                    <option value="" disabled selected>Choose Country</option>
                                    <option value="china" @selected(old('country') == 'china')>China</option>
                                    <option value="india" @selected(old('country') == 'india')>India</option>
                                </select>
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">State</label>
                                <select class="form-select state @error('state') is-invalid @enderror" name="state">
                                    <option value="" selected disabled>Select State</option>
                                </select>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Distributor</label>
                                <select class="form-select distributor @error('distributor') is-invalid @enderror"
                                    name="distributor">
                                    <option value="" selected disabled>Select Distributor</option>
                                </select>
                                @error('distributor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Dealer</label>
                                <select class="form-select dealer @error('dealer') is-invalid @enderror" name="dealer">
                                    <option value="" selected disabled>Select Dealer</option>
                                </select>
                                @error('dealer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row g-3">
                            <!-- Device Details -->
                            <div class="col-md-3">
                                <label class="form-label">Element <span class="text-danger">*</span></label>
                                <select class="form-select element @error('element') is-invalid @enderror" name="element">
                                    <option value="" selected disabled>Select Element</option>
                                    @foreach ($element as $data)
                                        <option value="{{ $data->element_id }}" @selected(old('element') == $data->id)>
                                            {{ $data->element->pluck('name')->first() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('element')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Element Type <span class="text-danger">*</span></label>
                                <select class="form-select element_type @error('element_type') is-invalid @enderror"
                                    name="element_type">
                                    <option value="" selected disabled>Select Element Type</option>
                                </select>
                                @error('element_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Model No <span class="text-danger">*</span></label>
                                <select name="model_no"
                                    class="form-select model-no @error('model_no') is-invalid @enderror">
                                    <option value="" selected disabled>Select Model</option>
                                </select>
                                @error('model_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Voltage <span class="text-danger">*</span></label>
                                <select class="form-select voltage @error('voltage') is-invalid @enderror" name="voltage">
                                    <option value="" selected disabled>Select Voltage</option>
                                </select>
                                @error('voltage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Part No <span class="text-danger">*</span></label>
                                <select class="form-select partNo @error('DevicePartNumber') is-invalid @enderror"
                                    name="DevicePartNumber">
                                    <option value="" selected disabled>Select Part Number</option>
                                </select>
                                @error('DevicePartNumber')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Type <span class="text-danger">*</span></label>
                                <select class="form-select @error('type') is-invalid @enderror" name="type">
                                    <option value="NEW" selected>NEW</option>
                                    <option value="RENEW">RENEW</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Barcode Allocation Section -->
                        <div class="shadow-sm mb-4 border-0 card">
                            <div class="bg-light card-header">
                                <h6 class="mb-0">
                                    <i class="me-2 fas fa-barcode"></i>
                                    Barcode Allocation
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="form-label">Available Barcodes</label>
                                        <select class="form-select" multiple size="8" id="available_barcodes">
                                            <!-- Options will be populated via JavaScript -->
                                        </select>
                                    </div>
                                    <div class="d-flex flex-column align-items-center justify-content-center col-md-2">
                                        <button type="button" id="btn-add" class="mb-2 btn btn-primary">
                                            <i class="fa-arrow-right fas"></i>
                                        </button>
                                        <button type="button" id="btn-remove" class="btn btn-danger">
                                            <i class="fa-arrow-left fas"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-label">
                                            Allocated Barcodes (<span id="allocated_count">0</span>)
                                        </label>
                                        <select id="allocated_barcodes" class="form-select" multiple size="8"
                                            name="allocated_barcodes[]">
                                            <!-- Allocated barcodes will be added here -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="me-3 btn-outline-secondary btn" data-bs-dismiss="modal">
                                <i class="me-2 fas fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn"
                                style="background: linear-gradient(135deg, #260950 0%, #3a1b7a 100%); color: white;">
                                <i class="me-2 fas fa-share-nodes"></i> Allocate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <style>
        thead {
            background-color: #260950;
            color: #fff;
        }

        th {
            border-right: 1px solid #fff;
        }
    </style>

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
                                    <option value="${dealer.id}">${dealer.business_name}</option>
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
            const $element = $('.element');
            $element.on('change', function () {
                const selectedValue = $(this).val();
                console.log('Selected Value:', selectedValue); // Log the selected value for debugging
                const $form = $(this).closest('form'); // Cache the form for reuse
                const $elementType = $form.find(
                    ".element_type"); // Target the dropdown within the same form

                $elementType.empty().append(
                    '<option value="">Loading...</option>'); // Temporary loading indicator

                $.ajax({
                    url: `/manufacturer/fetch/element-type/${selectedValue}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $elementType.empty().append(
                            '<option value="">Please Select Type</option>'); // Clear options
                        if (data && data.length > 0) {
                            data.forEach(type => {
                                $elementType.append(
                                    `<option value="${type.id}">${type.type}</option>`
                                );
                            });
                            if (data.length === 1) {
                                $elementType.val(data[0].id).trigger('change');
                            }
                        } else {
                            $elementType.append(
                                '<option value="">No options available</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $elementType.empty().append(
                            '<option value="">Failed to load options</option>');
                    }
                });
            });

            const $element_type = $('.element_type');
            $element_type.on('change', function () {
                const $form = $(this).closest('form');
                const $model_no = $form.find(".model-no");
                const $voltage = $form.find(".voltage");

                $model_no.empty().append('<option value="">Loading...</option>');
                $voltage.empty().append('<option value="">Loading...</option>');

                $.ajax({
                    url: `/manufacturer/fetch/model-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data && data.length > 0) {
                            $model_no.empty().append(
                                '<option value="">Select Model No</option>');
                            $voltage.empty().append('<option value="">Select Voltage</option>');
                            data.forEach(modelNo => {
                                $model_no.append(
                                    `<option value="${modelNo.id}">${modelNo.model_no}</option>`
                                );
                                $voltage.append(
                                    `<option value="${modelNo.id}">${modelNo.voltage}</option>`
                                );
                            });
                            if (data.length === 1) {
                                $model_no.val(data[0].id).trigger('change');
                            }
                        } else {
                            $model_no.append('<option value="">No options available</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error); // Log the error for debugging
                        $model_no.empty().append(
                            '<option value="">Failed to load options</option>');
                        $voltage.empty().append(
                            '<option value="">Failed to load options</option>');
                    }
                });
            });

            const $modelNo = $('.model-no');
            $modelNo.on('change', function () {
                const $form = $(this).closest('form');
                const $partNo = $form.find(".partNo");

                $.ajax({
                    url: `/manufacturer/fetch/part-no/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data && data.length > 0) {
                            data.forEach(partNo => {
                                $partNo.append(
                                    `<option value="${partNo.id}">${partNo.part_no}</option>`
                                );
                            });
                            if (data.length === 1) {
                                $partNo.val(data[0].id).trigger('change');
                            }
                        } else {
                            $partNo.append('<option value="">No options available</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        $partNo.empty().append(
                            '<option value="">Failed to load options</option>');
                    }
                });
            });

            const $partNo = $('.partNo');
            $partNo.on('change', function () {
                const $form = $(this).closest('form');
                const $available_barcodes = $form.find("#available_barcodes");

                $.ajax({
                    url: `/manufacturer/fetch/barcode/${$(this).val()}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        $available_barcodes.empty();
                        if (response.barcodes && response.barcodes.length > 0) {
                            response.barcodes.forEach(function (barcode) {
                                const option =
                                    `<option value="${barcode.id}">${barcode.barcodeNo}</option>`;
                                $available_barcodes.append(option);
                            });
                            if (response.barcodes.length === 1) {
                                $available_barcodes.val(response.barcodes[0].id).trigger(
                                    'change');
                            }
                        } else {
                            $available_barcodes.append(
                                '<option disabled>No barcodes available</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching barcodes:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#btn-add').click(function () {
                $('#available_barcodes option:selected').each(function () {
                    const option = $(this);
                    option.remove();
                    $('#allocated_barcodes').append(option);
                });
                updateAllocatedCount();
            });

            $('#btn-remove').click(function () {
                $('#allocated_barcodes option:selected').each(function () {
                    const option = $(this);
                    option.remove();
                    $('#available_barcodes').append(option);
                });
                updateAllocatedCount();
            });

            function updateAllocatedCount() {
                const count = $('#allocated_barcodes option').length;
                $('#allocated_count').text(count);
            }
        });
    </script>
@endsection
