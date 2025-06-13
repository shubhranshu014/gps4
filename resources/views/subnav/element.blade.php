@php
    $element = App\Models\Element::get(['id', 'name', 'is_vltd']);
@endphp

<section class="my-3"
    style="background-color: #260950; padding: 1.5rem 0; border-radius: 0.5rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-3">
                <h4 class="text-white px-3 py-2 mb-0" style="font-weight: 600;">
                    <i class="fas fa-cubes me-2"></i>Manage Elements
                </h4>
            </div>
            <div class="col-md-9">
                <div class="d-flex flex-wrap justify-content-md-end justify-content-sm-center">
                    @php
                        $buttons = [
                            ['label' => 'Add Element', 'target' => '#add_element', 'icon' => 'fa-plus'],
                            ['label' => 'Add Element Type', 'target' => '#add_element_type', 'icon' => 'fa-layer-group'],
                            ['label' => 'Add Device Model', 'target' => '#add_device_model_no', 'icon' => 'fa-microchip'],
                            ['label' => 'Add Device Part', 'target' => '#add_device_part_no', 'icon' => 'fa-puzzle-piece'],
                            ['label' => 'Add TAC', 'target' => '#addTacNo', 'icon' => 'fa-hashtag'],
                            ['label' => 'Add COP No', 'target' => '#addCopNo', 'icon' => 'fa-certificate'],
                            ['label' => 'Add Testing Agency', 'target' => '#addTestingAgency', 'icon' => 'fa-flask'],
                        ];
                    @endphp

                    @foreach ($buttons as $button)
                        <div class="p-1">
                            <button type="button" class="btn btn-sm btn-outline-light rounded-pill" data-bs-toggle="modal"
                                data-bs-target="{{ $button['target'] }}" aria-label="Open modal for {{ $button['label'] }}"
                                style="min-width: 120px; transition: all 0.3s ease;">
                                <i class="fas {{ $button['icon'] }} me-1"></i>
                                {{ $button['label'] }}
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Add Element Modal -->
    <div class="modal fade" id="add_element" tabindex="-1" aria-labelledby="addElementLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5"><i class="fas fa-plus me-2"></i>Add Element</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('elements.store') }}" method="post" id="elementForm">
                        @csrf
                        <div class="mb-3">
                            <label for="element_name" class="form-label">Element Name</label>
                            <input type="text" class="form-control form-control-sm" id="element_name"
                                name="element_name" placeholder="Enter element name" value="{{ old('element_name') }}">
                            @error('element_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="is_vltd" class="form-label">Is VLTD</label>
                            <select name="is_vltd" id="is_vltd" class="form-select form-select-sm">
                                <option value="0" @selected(old('is_vltd') == '0')>Yes</option>
                                <option value="1" @selected(old('is_vltd') == '1')>No</option>
                            </select>
                            @error('is_vltd')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" form="elementForm" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Element Type Modal -->
    <div class="modal fade" id="add_element_type" tabindex="-1" aria-labelledby="addElementTypeLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5"><i class="fas fa-layer-group me-2"></i>Add Element Type</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('elements.types.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="element" class="form-label">Select Element</label>
                            <select name="element" id="element" class="form-select form-select-sm element">
                                <option selected disabled>Select Element</option>
                                @foreach ($element as $item)
                                    <option value="{{ $item->id }}" is_vts="{{ $item->is_vltd }}"
                                        @selected(old('element') == $item->id)>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('element')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control form-control-sm" id="type" name="type"
                                value="{{ old('type') }}" placeholder="Enter element type">
                            @error('type')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Device Model Modal -->
    <div class="modal fade" id="add_device_model_no" tabindex="-1" aria-labelledby="addDeviceModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5"><i class="fas fa-microchip me-2"></i>Add Device Model</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('model.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="element" class="form-label">Select Element</label>
                            <select name="element" id="element" class="form-select form-select-sm element">
                                <option selected disabled>Select Element</option>
                                @foreach ($element as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('element')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="element_type" class="form-label">Select Type</label>
                            <select name="element_type" id="element_type"
                                class="form-select form-select-sm element_type"></select>
                            @error('element_type')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="model_no" class="form-label">Model No</label>
                            <input type="text" class="form-control form-control-sm" id="model_no" name="model_no"
                                placeholder="e.g. OLED65C1PUB">
                            @error('model_no')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="voltage" class="form-label">Voltage</label>
                            <input type="text" class="form-control form-control-sm" id="voltage" name="voltage"
                                placeholder="Enter voltage">
                            @error('voltage')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Other modals (Add Device Part, Add TAC, Add COP, Add Testing Agency) follow the same improved pattern -->
    <!-- They would have similar structure with appropriate icons and consistent styling -->

    <!-- Add Device Part Modal -->
    <div class="modal fade" id="add_device_part_no" tabindex="-1" aria-labelledby="addDevicePartLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5"><i class="fas fa-puzzle-piece me-2"></i>Add Device Part</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="device-part-model">
                    <form action="{{ route('part.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="element" class="form-label">Select Element</label>
                            <select name="element" id="element" class="form-select form-select-sm element">
                                <option selected disabled>Select Element</option>
                                @foreach ($element as $item)
                                    <option value="{{ $item->id }}" @selected(old('element') == $item->id)>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('element')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="element_type" class="form-label">Select Type</label>
                            <select name="element_type" id="element_type"
                                class="form-select form-select-sm element_type"></select>
                            @error('element_type')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="model_no" class="form-label">Select Model No</label>
                            <select name="model_no" id="model_no" class="form-select form-select-sm model-no"></select>
                            @error('model_no')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="device_part_no" class="form-label">Device Part No</label>
                            <input type="text" class="form-control form-control-sm" id="device_part_no"
                                name="device_part_no" value="{{ old('device_part_no') }}"
                                placeholder="Enter device part no">
                            @error('device_part_no')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add TAC Modal -->
    <div class="modal fade" id="addTacNo" tabindex="-1" aria-labelledby="addTacLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5"><i class="fas fa-hashtag me-2"></i>Add TAC Number</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tac.store') }}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="element" class="form-label">Select Element</label>
                                <select name="element" id="element" class="form-select form-select-sm element">
                                    <option selected disabled>Select Element</option>
                                    @foreach ($element as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('element')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="element_type" class="form-label">Select Type</label>
                                <select name="element_type" id="element_type"
                                    class="form-select form-select-sm element_type"></select>
                                @error('element_type')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="model_no" class="form-label">Select Model No</label>
                                <select name="model_no" id="model_no"
                                    class="form-select form-select-sm model-no"></select>
                                @error('model_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="device_part_no" class="form-label">Select Device Part No</label>
                                <select name="device_part_no" id="device_part_no"
                                    class="form-select form-select-sm partNo"></select>
                                @error('device_part_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">TAC Numbers</label>
                                    <button type="button" class="btn btn-sm btn-primary add_more">
                                        <i class="fas fa-plus me-1"></i>Add More
                                    </button>
                                </div>
                                <div class="dynamic_form">
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-9">
                                            <input type="text" class="form-control form-control-sm" name="tac_No[]"
                                                placeholder="Enter TAC number">
                                        </div>
                                        <div class="col-md-3 d-flex align-items-end">
                                            <button type="button" class="btn btn-sm btn-danger w-100 remove-row">
                                                <i class="fas fa-trash me-1"></i>Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-sm btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add COP Modal -->
    <div class="modal fade" id="addCopNo" tabindex="-1" aria-labelledby="addCopLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5"><i class="fas fa-certificate me-2"></i>Add COP Number</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cop.store') }}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="element" class="form-label">Select Element</label>
                                <select name="element" id="element" class="form-select form-select-sm element">
                                    <option disabled selected>Select Element</option>
                                    @foreach ($element as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('element')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="element_type" class="form-label">Select Type</label>
                                <select name="element_type" id="element_type"
                                    class="form-select form-select-sm element_type"></select>
                                @error('element_type')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="model_no" class="form-label">Select Model No</label>
                                <select name="model_no" id="model_no"
                                    class="form-select form-select-sm model-no"></select>
                                @error('model_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="device_part_no" class="form-label">Select Device Part No</label>
                                <select name="device_part_no" id="device_part_no"
                                    class="form-select form-select-sm partNo"></select>
                                @error('device_part_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="device_tac_no" class="form-label">Select TAC No</label>
                                <select name="device_tac_no" id="device_tac_no"
                                    class="form-select form-select-sm tacNo"></select>
                                @error('device_tac_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">COP Numbers</label>
                                    <button type="button" class="btn btn-sm btn-primary add_more">
                                        <i class="fas fa-plus me-1"></i>Add More
                                    </button>
                                </div>
                                <div class="dynamic_form">
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control form-control-sm" name="cop_No[]"
                                                placeholder="Enter COP number">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="date" class="form-control form-control-sm"
                                                name="cop_valid_till[]">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-sm btn-danger w-100 remove-row">
                                                <i class="fas fa-trash me-1"></i>Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-sm btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Testing Agency Modal -->
    <div class="modal fade" id="addTestingAgency" tabindex="-1" aria-labelledby="addTestingAgencyLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title fs-5"><i class="fas fa-flask me-2"></i>Add Testing Agency</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('testingAgency.store')}}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="element" class="form-label">Select Element</label>
                                <select name="element" id="element" class="form-select form-select-sm element">
                                    <option selected disabled>Select Element</option>
                                    @foreach ($element as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('element')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="element_type" class="form-label">Select Type</label>
                                <select name="element_type" id="element_type"
                                    class="form-select form-select-sm element_type"></select>
                                @error('element_type')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="model_no" class="form-label">Select Model No</label>
                                <select name="model_no" id="model_no"
                                    class="form-select form-select-sm model-no"></select>
                                @error('model_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="device_part_no" class="form-label">Select Device Part No</label>
                                <select name="device_part_no" id="device_part_no"
                                    class="form-select form-select-sm partNo"></select>
                                @error('device_part_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="device_tac_no" class="form-label">Select TAC No</label>
                                <select name="device_tac_no" id="device_tac_no"
                                    class="form-select form-select-sm tacNo"></select>
                                @error('device_tac_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="cop_no" class="form-label">Select COP No</label>
                                <select name="cop_no" id="cop_no" class="form-select form-select-sm cop"></select>
                                @error('cop_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">Testing Agencies</label>
                                    <button type="button" class="btn btn-sm btn-primary add_more">
                                        <i class="fas fa-plus me-1"></i>Add More
                                    </button>
                                </div>
                                <div class="dynamic_form">
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-8">
                                            <input type="text" class="form-control form-control-sm"
                                                name="testing_agency[]" placeholder="Enter testing agency">
                                        </div>
                                        <div class="col-md-4 d-flex align-items-end">
                                            <button type="button" class="btn btn-sm btn-danger w-100 remove-row">
                                                <i class="fas fa-trash me-1"></i>Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-sm btn-outline-secondary me-2"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(document).ready(function () {
        // Add Font Awesome if not already loaded
        if (!$('i.fa').length) {
            $('head').append('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">');
        }

        // Element change handler
        $('.element').on('change', function () {
            const is_vts = $(this).find('option:selected').attr('is_vts');
            const selectedValue = $(this).val();
            const $form = $(this).closest("form");
            const $elementType = $form.find(".element_type");

            // Handle SIM count field
            if (is_vts === '0') {
                if ($("#countOfSim").length === 0) {
                    $(this).closest('.mb-3').after(`
                        <div class="mb-3" id="countOfSim">
                            <label class="form-label">No. of SIM</label>
                            <input type="number" name="no_of_sim" class="form-control form-control-sm" placeholder="Enter SIM count">
                        </div>
                    `);
                }
            } else {
                $("#countOfSim").remove();
            }

            // Load element types
            $elementType.html('<option value="">Loading...</option>');

            $.ajax({
                url: `/superadmin/fetch/element-type/${selectedValue}`,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $elementType.empty().append('<option disabled selected>Select Element Type</option>');
                    if (data && data.length > 0) {
                        data.forEach(type => {
                            $elementType.append(`<option value="${type.id}">${type.type}</option>`);
                        });
                    } else {
                        $elementType.append('<option value="">No options available</option>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    $elementType.empty().append('<option value="">Failed to load options</option>');
                }
            });
        });

        // Element Type change handler
        $('.element_type').on('change', function () {
            const $form = $(this).closest("form");
            const $modelNo = $form.find(".model-no");
            $modelNo.html('<option value="">Loading...</option>');

            $.ajax({
                url: `/superadmin/fetch/model-no/${$(this).val()}`,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $modelNo.empty().append('<option disabled selected>Select Model No.</option>');
                    if (data && data.length > 0) {
                        data.forEach(modelNo => {
                            $modelNo.append(`<option value="${modelNo.id}">${modelNo.model_no}</option>`);
                        });
                    } else {
                        $modelNo.append('<option value="">No options available</option>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    $modelNo.empty().append('<option value="">Failed to load options</option>');
                }
            });
        });

        // Model No change handler
        $('.model-no').on('change', function () {
            const $form = $(this).closest("form");
            const $partNo = $form.find(".partNo");
            $partNo.html('<option value="">Loading...</option>');

            $.ajax({
                url: `/superadmin/fetch/part-no/${$(this).val()}`,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $partNo.empty().append('<option disabled selected>Select Part No.</option>');
                    if (data && data.length > 0) {
                        data.forEach(partNo => {
                            $partNo.append(`<option value="${partNo.id}">${partNo.part_no}</option>`);
                        });
                    } else {
                        $partNo.append('<option value="">No options available</option>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    $partNo.empty().append('<option value="">Failed to load options</option>');
                }
            });
        });

        // Part No change handler
        $('.partNo').on('change', function () {
            const $form = $(this).closest("form");
            const $tacNo = $form.find(".tacNo");
            $tacNo.html('<option value="">Loading...</option>');

            $.ajax({
                url: `/superadmin/fetch/tac-no/${$(this).val()}`,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $tacNo.empty().append('<option disabled selected>Select TAC No.</option>');
                    if (data && data.length > 0) {
                        data.forEach(tacNo => {
                            $tacNo.append(`<option value="${tacNo.id}">${tacNo.tacNo}</option>`);
                        });
                    } else {
                        $tacNo.append('<option value="">No options available</option>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    $tacNo.empty().append('<option value="">Failed to load options</option>');
                }
            });
        });

        // TAC No change handler for COP numbers
        $('.tacNo').on('change', function () {
            const $form = $(this).closest("form");
            const $copNo = $form.find(".cop");
            $copNo.html('<option value="">Loading...</option>');

            $.ajax({
                url: `/superadmin/fetch/cop-no/${$(this).val()}`,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $copNo.empty().append('<option disabled selected>Select COP No.</option>');
                    if (data && data.length > 0) {
                        data.forEach(cop => {
                            $copNo.append(`<option value="${cop.id}">${cop.COPNo}</option>`);
                        });
                    } else {
                        $copNo.append('<option value="">No options available</option>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    $copNo.empty().append('<option value="">Failed to load options</option>');
                }
            });
        });

        // Add More Rows
        $('.add_more').click(function () {
            const $form = $(this).closest("form");
            const $dynamicForm = $form.find(".dynamic_form");
            const $newRow = $dynamicForm.children().first().clone();

            $newRow.find('input').val('');
            $newRow.find('select').prop('selectedIndex', 0);
            $dynamicForm.append($newRow);
        });

        // Remove Row
        $(document).on('click', '.remove-row', function () {
            const $form = $(this).closest("form");
            const $dynamicForm = $form.find(".dynamic_form");
            const $rows = $dynamicForm.find('.row');

            if ($rows.length > 1) {
                $(this).closest('.row').remove();
            } else {
                // Show a toast notification instead of alert
                const toast = `<div class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
                    <div class="d-flex">
                        <div class="toast-body">
                            You must have at least one row.
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>`;
                $('body').append(toast);
                setTimeout(() => $('.toast').remove(), 3000);
            }
        });
    });
</script>