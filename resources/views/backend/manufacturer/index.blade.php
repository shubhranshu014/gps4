@extends('layouts.wlp')
@section('content')
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4 p-3" 
         style="background: linear-gradient(135deg, #260950 0%, #4a1b9d 100%); 
                border-radius: 10px; 
                box-shadow: 0 4px 20px rgba(38, 9, 80, 0.15);">
        <div class="d-flex align-items-center mb-3 mb-md-0">
            <div class="bg-white bg-opacity-10 me-3 p-2 rounded-circle">
                <i class="text-white fas fa-industry"></i>
            </div>
            <div>
                <h4 class="mb-0 text-white">Manufacturers Management</h4>
                <p class="mb-0 text-white-50 small">List of all manufacturers and their details</p>
            </div>
        </div>
        <button class="btn btn-light-purple" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="me-2 fas fa-plus-circle"></i> Create Manufacturer
        </button>
    </div>

    <!-- Alerts -->
    @if (Session::has('success'))
        <div class="d-flex align-items-center alert alert-success alert-dismissible fade show" role="alert">
            <i class="me-2 fas fa-check-circle"></i>
            <div>{{ Session::get('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('delete'))
        <div class="d-flex align-items-center alert alert-danger alert-dismissible fade show" role="alert">
            <i class="me-2 fas fa-check-circle"></i>
            <div>{{ Session::get('delete') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="d-flex align-items-center alert alert-danger alert-dismissible fade show" role="alert">
            <i class="me-2 fas fa-exclamation-circle"></i>
            <div>{{ Session::get('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Manufacturers Table -->
    <div class="shadow-sm border-0 card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover mb-0 dataTable">
                    <thead class="bg-light text-primary">
                        <tr>
                            <th width="50">#</th>
                            <th width="80">Logo</th>
                            <th>Name</th>
                            <th>Business</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mfg as $item)
                            <tr>
                                <td class="fw-bold">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="avatar avatar-md">
                                        <img src="{{ asset('storage/uploads/' . $item->logo) }}" 
                                             class="rounded-circle" 
                                             alt="Manufacturer Logo"
                                             onerror="this.onerror=null;this.src='{{ url('images/2265750.webp') }}'">
                                    </div>
                                </td>
                                <td class="fw-semibold">{{ $item->name }}</td>
                                <td>{{ $item->businees_name }}</td>
                                <td><a href="mailto:{{ $item->email }}" class="text-decoration-none">{{ $item->email }}</a></td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <input type="password" class="form-control" value="{{ $item->passwordText }}" readonly>
                                        <button class="btn-outline-secondary btn toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('manufacturer.edit',$id = $item->id) }}" class="btn-outline-primary btn btn-sm" >
                                            <i class="fas fa-edit"></i>
                                    </a>
                                        <form action="{{ route('manufacturer.delete',$item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-outline-danger btn btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this manufacturer?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Manufacturer Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="border-0 modal-content">
                <div class="bg-primary text-white modal-header">
                    <h5 class="modal-title" id="createModalLabel">
                        <i class="me-2 fas fa-industry"></i> Create New Manufacturer
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="p-4 modal-body">
                    <form action="{{ route('manufacturer.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Section 1: Basic Information -->
                        <div class="mb-4">
                            <h6 class="d-flex align-items-center mb-3 text-primary">
                                <span class="bg-primary bg-opacity-10 me-2 p-2 rounded-circle">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                Basic Information
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Country <span class="text-danger">*</span></label>
                                    <select name="country" class="form-select country">
                                        <option disabled selected>Choose Country</option>
                                        <option value="china" @selected(old('country') == 'china')>China</option>
                                        <option value="india" @selected(old('country') == 'india')>India</option>
                                    </select>
                                    @error('country')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">State <span class="text-danger">*</span></label>
                                    <select name="state" class="form-select state">
                                        <option disabled selected>Choose State</option>
                                    </select>
                                    @error('state')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Manufacturer Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="manufacturer_code" 
                                           value="{{ old('manufacturer_code') }}" placeholder="MFG-001">
                                    @error('manufacturer_code')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section 2: Business Details -->
                        <div class="mb-4">
                            <h6 class="d-flex align-items-center mb-3 text-primary">
                                <span class="bg-primary bg-opacity-10 me-2 p-2 rounded-circle">
                                    <i class="fas fa-building"></i>
                                </span>
                                Business Details
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Business Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="business_name" 
                                           value="{{ old('business_name') }}" placeholder="Enter business name">
                                    @error('business_name')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">GST Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="gst_number" 
                                           value="{{ old('gst_number') }}" placeholder="22AAAAA0000A1Z5">
                                    @error('gst_number')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Parent WLP</label>
                                    <input type="hidden" name="parent_name" value="{{ auth('wlp')->user()->id }}">
                                    <input type="text" class="bg-light form-control" 
                                           value="{{ auth('wlp')->user()->name }}" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section 3: Contact Information -->
                        <div class="mb-4">
                            <h6 class="d-flex align-items-center mb-3 text-primary">
                                <span class="bg-primary bg-opacity-10 me-2 p-2 rounded-circle">
                                    <i class="fas fa-address-card"></i>
                                </span>
                                Contact Information
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Manufacturer Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="manufacturer_name" 
                                           value="{{ old('manufacturer_name') }}" placeholder="Contact person name">
                                    @error('manufacturer_name')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Mobile Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mobile_no" 
                                           value="{{ old('mobile_no') }}" placeholder="+91">
                                    @error('mobile_no')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" 
                                           value="{{ old('email') }}" placeholder="contact@manufacturer.com">
                                    @error('email')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Toll Free Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="toll_free_no" 
                                           value="{{ old('toll_free_no') }}" placeholder="1800-XXX-XXXX">
                                           @error('toll_free_no')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Website <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">https://</span>
                                        <input type="text" class="form-control" name="website" 
                                               value="{{ old('website') }}" placeholder="www.example.com">
                                               @error('website  ')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Section 4: Address & Logo -->
                        <div class="mb-4">
                            <h6 class="d-flex align-items-center mb-3 text-primary">
                                <span class="bg-primary bg-opacity-10 me-2 p-2 rounded-circle">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                Address & Logo
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                                    <textarea name="address" rows="3" class="form-control" 
                                              placeholder="Plot No: 443/4516, ITI Chowk, Near RTO Office, Balasore, Odisha, 756001">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Logo <span class="text-danger">*</span></label>
                                    <div class="p-3 border rounded text-center">
                                        <img src="{{ url('images/2265750.webp') }}" 
                                             id="imagePreview" 
                                             class="mb-3 rounded img-fluid" 
                                             style="max-height: 150px;">
                                        <input type="file" name="logo" class="form-control" id="imageInput">
                                        <small class="d-block mt-2 text-muted">Recommended: Square image (300x300px)</small>
                                    </div>
                                    @error('logo')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="pt-0 border-top-0 modal-footer">
                            <button type="button" class="btn-outline-secondary btn" data-bs-dismiss="modal">
                                <i class="me-2 fas fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="me-2 fas fa-save"></i> Create Manufacturer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($mfg as $item)
            <!-- Modal -->
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Manufacturer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                          
      </div>
    </div>
  </div>
</div>

    @endforeach
    <script>
        $(document).ready(function() {
            // Image preview functionality
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
    
            // Toggle password visibility
            $('.toggle-password').click(function() {
                const input = $(this).parent().find('input');
                const icon = $(this).find('i');
                
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
@endsection
