@extends('layouts.wlp')
@section('content')
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 p-3" style="background: linear-gradient(135deg, #260950 0%, #4a1b9d 100%); 
                    border-radius: 10px; 
                    box-shadow: 0 4px 20px rgba(38, 9, 80, 0.15);">
        <div class="d-flex align-items-center mb-3 mb-md-0">
            <div class="bg-white bg-opacity-10 p-2 rounded-circle me-3">
                <i class="fas fa-industry text-white"></i>
            </div>
            <div>
                <h4 class="text-white mb-0">Edit Manufacturer</h4>
                {{-- <p class="text-white-50 mb-0 small">List of all manufacturers and their details</p> --}}
            </div>
        </div>
        {{-- <button class="btn btn-light-purple" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fas fa-plus-circle me-2"></i> Edit Manufacturer
        </button> --}}
    </div>

 <div class="card">
        <div class="card-body">
              <form action="{{ route('manufacturer.update',$id = $mfg->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @method('put')
                        
                        <!-- Section 1: Basic Information -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3 d-flex align-items-center">
                                <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                Basic Information
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Country <span class="text-danger">*</span></label>
                                    <select name="country" class="form-select country">
                                        <option disabled selected>Choose Country</option>
                                        <option value="china" @selected( $mfg->country == 'china')>China</option>
                                        <option value="india" @selected( $mfg->country == 'india')>India</option>
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">State <span class="text-danger">*</span></label>
                                    <select name="state" class="form-select state">
                                        <option disabled selected>Choose State</option>
                                    </select>
                                    @error('state')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Manufacturer Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="manufacturer_code" 
                                           value="{{ $mfg->code }}" placeholder="MFG-001">
                                    @error('manufacturer_code')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section 2: Business Details -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3 d-flex align-items-center">
                                <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                    <i class="fas fa-building"></i>
                                </span>
                                Business Details
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Business Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="business_name" 
                                           value="{{ $mfg->businees_name }}" placeholder="Enter business name">
                                    @error('business_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">GST Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="gst_number" 
                                           value="{{ $mfg->gst_no }}" placeholder="22AAAAA0000A1Z5">
                                    @error('gst_number')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Parent WLP</label>
                                    <input type="hidden" name="parent_name" value="{{ auth('wlp')->user()->id }}">
                                    <input type="text" class="form-control bg-light" 
                                           value="{{ auth('wlp')->user()->name }}" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section 3: Contact Information -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3 d-flex align-items-center">
                                <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                    <i class="fas fa-address-card"></i>
                                </span>
                                Contact Information
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Manufacturer Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="manufacturer_name" 
                                           value="{{$mfg->name }}" placeholder="Contact person name">
                                    @error('manufacturer_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Mobile Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mobile_no" 
                                           value="{{ $mfg->mobile_no }}" placeholder="+91">
                                    @error('mobile_no')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" 
                                           value="{{ $mfg->email }}" placeholder="contact@manufacturer.com">
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Toll Free Number</label>
                                    <input type="text" class="form-control" name="toll_free_no" 
                                           value="{{ $mfg->tollfreeNo }}" placeholder="1800-XXX-XXXX">
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Website</label>
                                    <div class="input-group">
                                        <span class="input-group-text">https://</span>
                                        <input type="text" class="form-control" name="website" 
                                               value="{{ $mfg->website }}" placeholder="www.example.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section 4: Address & Logo -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3 d-flex align-items-center">
                                <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                Address & Logo
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                                    <textarea name="address" rows="3" class="form-control" 
                                              placeholder="Plot No: 443/4516, ITI Chowk, Near RTO Office, Balasore, Odisha, 756001">{{ $mfg->address }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Logo <span class="text-danger">*</span></label>
                                    <div class="border rounded p-3 text-center">
                                        <img src="{{ url('storage/uploads/'.$mfg->logo) }}" 
                                             id="imagePreview" 
                                             class="img-fluid rounded mb-3" 
                                             style="max-height: 150px;">
                                        <input type="file" name="logo" class="form-control" id="imageInput">
                                        <small class="text-muted d-block mt-2">Recommended: Square image (300x300px)</small>
                                    </div>
                                    @error('logo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer border-top-0 pt-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Create Manufacturer
                            </button>
                        </div>
                    </form>
        </div>
    </div>
<script>
   $(document).ready(function(){
     $('#imageInput').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
    const selectedCountry = $('.country').val();
    const selectedState = "{{ $mfg->state }}"; // Get the old state value from backend

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