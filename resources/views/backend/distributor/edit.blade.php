@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Edit Distributor</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                {{-- <a href="{{ route('create.admin') }}" class="btn btn-sm btn-theme" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    Create Distributor
                </a> --}}
            </div>
        </div>
    </div>

    <form action="" method="post" class="needs-validation" novalidate>
        @csrf

        <!-- Business Details Section -->
        <div class="card mb-4 border-primary">
            <div class="card-header bg-light-primary">
                <h5 class="mb-0">
                    <i class="fas fa-building me-2"></i>Business Details
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- Row 1 -->
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="businessNameInput" class="form-label fw-semibold">
                                <i class="fas fa-building me-1"></i> Business Name
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group has-validation">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-industry"></i>
                                </span>
                                <input type="text" class="form-control @error('business_name') is-invalid @enderror"
                                    id="businessNameInput" name="business_name" value="{{ $distributor->business_name }}"
                                    placeholder="Enter business name" required aria-describedby="businessNameHelp">

                                @error('business_name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mb-3">
                        <div class="form-group">
                            <label for="contactPersonName" class="form-label fw-semibold d-flex align-items-center">
                                <i class="fas fa-user me-2 text-primary"></i>
                                Contact Person Name
                                <span class="text-danger ms-1">*</span>
                            </label>

                            <div class="input-group has-validation">
                                <span class="input-group-text bg-light">
                                    <i class="fas fa-id-card"></i>
                                </span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="contactPersonName" name="name" value="{{ $distributor->name }}"
                                    placeholder="Full name of contact person" required minlength="3" maxlength="100"
                                    aria-describedby="contactPersonHelp">

                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div id="contactPersonHelp" class="form-text text-muted mt-1">
                                The primary contact for this business account
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ $distributor->email }}" required>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Row 2 -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Gender <span class="text-danger">*</span></label>
                        <select name="gender" class="form-select" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male" @selected($distributor->gender == 'male')>Male</option>
                            <option value="female" @selected($distributor->gender == 'female')>Female</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Mobile <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">+91</span>
                            <input type="tel" class="form-control" name="mobile" value="{{ $distributor->mobile }}"
                                required>
                        </div>
                        @error('mobile')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="date_of_birth"
                            value="{{ $distributor->date_of_birth }}" required>
                        @error('date_of_birth')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Age</label>
                        <input type="text" class="form-control bg-light" name="age" readonly>
                    </div>

                    <!-- Row 3 -->
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Map Device Edit <span class="text-danger">*</span></label>
                        <select name="is_map_device_edit" class="form-select" required>
                            <option value="" disabled selected>Select Option</option>
                            <option value="yes" @selected($distributor->is_map_device_edit == 'yes')>Yes</option>
                            <option value="no" @selected($distributor->is_map_device_edit == 'no')>No</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">PAN Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pan_number" value="{{ $distributor->pan_number }}"
                            required>
                        @error('pan_number')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Occupation <span class="text-danger">*</span></label>
                        <select name="occupation" class="form-select" required>
                            <option value="" disabled selected>Select Occupation</option>
                            <option value="Business Man">Business Man</option>
                            <option value="Student">Student</option>
                            <option value="House Wife">House Wife</option>
                            <option value="VRS Employees">VRS Employees</option>
                            <option value="Retired Employees">Retired Employees</option>
                            <option value="Self Employed">Self Employed</option>
                            <option value="Private Employees">Private Employees</option>
                            <option value="Marketing Executives">Marketing Executives</option>
                        </select>
                        @error('occupation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Advance Payment <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="number" class="form-control" name="advance_payment"
                                value="{{ $distributor->advance_payment }}" required>
                        </div>
                        @error('advance_payment')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Row 4 -->
                    <div class="col-12">
                        <label class="form-label fw-semibold">Languages Known <span class="text-danger">*</span></label>
                        <select data-placeholder="Select languages" multiple class="form-control chosen-select"
                            name="language_known[]" required>
                            <option value="english" @selected(is_array(old('language_known')) && in_array('english', old('language_known')))>English</option>
                            <option value="hindi" @selected(is_array(old('language_known')) && in_array('hindi', old('language_known')))>Hindi</option>
                            <option value="odiya" @selected(is_array(old('language_known')) && in_array('odiya', old('language_known')))>Odiya</option>
                        </select>
                        @error('language_known')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Area Allocation Section -->
        <div class="card border-primary">
            <div class="card-header bg-light-primary">
                <h5 class="mb-0">
                    <i class="fas fa-map-marked-alt me-2"></i>Area Allocation
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Country <span class="text-danger">*</span></label>
                        <select name="country" class="form-select country" required>
                            <option value="" disabled selected>Choose Country</option>
                            <option value="china" @selected($distributor->country == 'china')>China</option>
                            <option value="india" @selected($distributor->country == 'india')>India</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">State <span class="text-danger">*</span></label>
                        <select class="form-select state" name="state" required>
                            <option value="" disabled selected>Select State</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">District <span class="text-danger">*</span></label>
                        <select name="districts[]" class="form-select district" multiple="multiple" required>
                            <option value="" disabled>Select District(s)</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="address" rows="2"
                            required>{{ $distributor->address }}</textarea>
                        @error('address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer mt-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                <i class="fas fa-times me-2"></i>Cancel
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Save Distributor
            </button>
        </div>
    </form>
    <script>
        $(document).ready(function () {

            const selectedCountry = $('.country').val();
            const selectedState = "{{ $distributor->state }}"; // Get the old state value from backend

            const states = {
                china: ['Beijing'],
                india: [
                    'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat',
                    'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 'Maharashtra',
                    'Madhya Pradesh', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Punjab',
                    'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Tripura', 'Telangana', 'Uttar Pradesh', 'Uttarakhand',
                    'West Bengal', 'Andaman & Nicobar (UT)', 'Chandigarh (UT)', 'Dadra & Nagar Haveli and Daman & Diu (UT)',
                    'Delhi [National Capital Territory (NCT)]', 'Jammu & Kashmir (UT)', 'Ladakh (UT)', 'Lakshadweep (UT)', 'Puducherry (UT)'
                ]
            };

            function populateDropdown(selector, items, placeholder = 'Select', selectedValue = '') {
                const dropdown = $(selector);
                dropdown.empty().append(`<option value="">${placeholder}</option>`);
                items.forEach(item => {
                    const option = $('<option>', {
                        value: item,
                        text: item
                    });
                    if (item === selectedValue) {
                        option.prop('selected', true);
                    }
                    dropdown.append(option);
                });
            }

            const stateList = states[selectedCountry] || [];
            populateDropdown('.state', stateList, 'Select State', selectedState);

            // Optional: if you want to trigger state change and populate districts too
            $('.state').trigger('change');
        });
    </script>
@endsection