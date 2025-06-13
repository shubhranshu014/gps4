@extends($layout)

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-4 border-0" style="border-radius: 12px;">
            <div class="card-header py-3 d-flex justify-content-between align-items-center"
                style="background: linear-gradient(135deg, #260950 0%, #4a1f96 100%);">
                <h4 class="mb-0 text-white">
                    <i class="fas fa-user-plus me-2"></i>Onboard Admin
                </h4>
                <a href="{{ route('admin.list') }}" class="btn btn-outline-light btn-sm" style="white-space: nowrap;">
                    <i class="fas fa-list me-1"></i> Admin List
                </a>
            </div>

            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>{{ Session::get('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('store.admin') }}" method="post" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
                    @csrf

                    <div class="row g-3">
                        <!-- Business Information Section -->
                        <div class="col-12">
                            <h5 class="mb-3 text-primary">
                                <i class="fas fa-building me-2"></i>Business Information
                            </h5>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="name_of_the_business" class="form-control" id="businessName"
                                    placeholder="Name of the business" value="{{ old('name_of_the_business') }}" required>
                                <label for="businessName">Name Of The Business <span class="text-danger">*</span></label>
                                @error('name_of_the_business')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea name="regd_address" class="form-control" placeholder="Registered address"
                                    id="regdAddress" style="height: 100px" required>{{ old('regd_address') }}</textarea>
                                <label for="regdAddress">Regd. Address <span class="text-danger">*</span></label>
                                @error('regd_address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="gstin_no" class="form-control" id="gstinNo" placeholder="GSTIN No."
                                    value="{{ old('gstin_no') }}" required>
                                <label for="gstinNo">GSTIN No. <span class="text-danger">*</span></label>
                                @error('gstin_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="pan_no" class="form-control" id="panNo" placeholder="PAN No."
                                    value="{{ old('pan_no') }}" required>
                                <label for="panNo">Pan No. <span class="text-danger">*</span></label>
                                @error('pan_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Owner Information Section -->
                        <div class="col-12 mt-4">
                            <h5 class="mb-3 text-primary">
                                <i class="fas fa-user-tie me-2"></i>Owner Information
                            </h5>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" name="name_of_the_business_owner" class="form-control" id="ownerName"
                                    placeholder="Name of the business owner" value="{{ old('name_of_the_business_owner') }}"
                                    required>
                                <label for="ownerName">Name Of The Business Owner <span class="text-danger">*</span></label>
                                @error('name_of_the_business_owner')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                                    value="{{ old('email') }}" required>
                                <label for="email">Email <span class="text-danger">*</span></label>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" name="contact_no" class="form-control" id="contactNo"
                                    placeholder="Contact No." value="{{ old('contact_no') }}" required>
                                <label for="contactNo">Contact No. <span class="text-danger">*</span></label>
                                @error('contact_no')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Documents Section -->
                        <div class="col-12 mt-4">
                            <h5 class="mb-3 text-primary">
                                <i class="fas fa-file-upload me-2"></i>Documents Upload
                            </h5>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <label for="gstCertificate" class="form-label">
                                        <i class="fas fa-file-pdf me-2 text-danger"></i>Upload GST Certificate
                                        {{-- <span class="text-danger"></span> --}}
                                        <small class="text-muted">(PDF Only, max 5MB)</small>
                                    </label>
                                    <input type="file" name="gst_certificate" class="form-control" id="gstCertificate"
                                        accept=".pdf">
                                    @error('gst_certificate')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <label for="panCard" class="form-label">
                                        <i class="fas fa-file-pdf me-2 text-danger"></i>Upload Pan Card
                                        {{-- <span class="text-danger"></span> --}}
                                        <small class="text-muted">(PDF Only, max 5MB)</small>
                                    </label>
                                    <input type="file" name="pan_card" class="form-control" id="panCard" accept=".pdf">
                                    @error('pan_card')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <label for="incorporationCertificate" class="form-label">
                                        <i class="fas fa-file-pdf me-2 text-danger"></i>Upload Incorporation Certificate
                                        <small class="text-muted">(PDF Only, max 5MB)</small>
                                    </label>
                                    <input type="file" name="incorporation_certificate" class="form-control"
                                        id="incorporationCertificate" accept=".pdf">
                                    @error('incorporation_certificate')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body">
                                    <label for="companyLogo" class="form-label">
                                        <i class="fas fa-image me-2 text-primary"></i>Company Logo
                                        <span class="text-danger">*</span>
                                        <small class="text-muted">(JPG, JPEG, PNG Only, max 2MB)</small>
                                    </label>
                                    <input type="file" name="company_logo" class="form-control" id="companyLogo"
                                        accept=".jpg,.jpeg,.png" required>
                                    @error('company_logo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-outline-light btn-lg px-4 py-2 shadow-sm">
                                <i class="fas fa-user-plus me-2"></i>Onboard Admin
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection