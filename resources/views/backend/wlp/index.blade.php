@extends($layout)
@section('content')
    <div class="px-3">
        <!-- Header Section with Icon -->
        <div class="row align-items-center mb-4 py-3 gx-2"
            style="background: linear-gradient(135deg, #260950 0%, #4a1b9d 100%); border-radius: 10px; box-shadow: 0 4px 20px rgba(38, 9, 80, 0.15);">
            <div class="col-md-6 d-flex align-items-center">
                {{-- <div class="icon-shape bg-white rounded-3 ">
                    <i class="fas fa-puzzle-piece fa-lg text-purple" style="color: #260950;"></i>
                </div> --}}
                <div class="p-2 me-3">
                    <h4 class="text-white mb-0"> WLP/ReSeller List</h4>
                    <p class="text-white-50 mb-0 small">Manage WLP/Reseller</p>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('create.admin') }}" class="btn btn-outline-light mx-2" data-bs-toggle="modal"
                    data-bs-target="#wlpModal" style="border: 1px solid #fff;white-space: nowrap;">
                    Create WLP
                </a>
            </div>
        </div>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> {{ Session::get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> {{ Session::get('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-fluid px-3">
        <div class="card px-3">
            <div class="card-body">
                <div class="row">
                    <h5 class="text-capitalize"><em>It shows the list of WLP and their details</em></h5>
                    <div class="col-md-12">
                        <table class="table table-bordered dataTable">
                            <thead class="text-white" style="background-color: #260950">
                                <tr>
                                    <th scope="col">#</th>
                                    <td scope="col">Logo</td>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wlps as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item->logo != null)
                                                <img src="{{ asset('storage/uploads/' . $item->logo) }}" alt="Logo"
                                                    style="width:50px;height:50px;">
                                            @else
                                                N/A
                                            @endif

                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->mobile_no }}</td>
                                        <td>
                                            <div class="input-group input-group-sm">
                                                <input type="password" class="form-control form-control-sm"
                                                    value="{{ $item->passwordText }}" id="password_{{ $item->id }}" readonly
                                                    style="width: 100px;">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('password_{{ $item->id }}')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>

                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $loop->iteration }}">
                                                <i class="fa-pen-to-square fa-solid" style="color:#fff"></i>
                                            </button>
                                            <form action="{{ route('wlp.delete', $id = $item->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this item?');"><i
                                                        class="fa-solid fa-trash" style="color:#fff"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach ($wlps as $item)
        <!-- Edit Wlp Modal -->
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel{{ $item->id }}">Edit Wlp
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('wlp.update', $id = $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Select Country <span class="text-danger badge">*</span></label>
                                    <select name="country" class="form-select form-select-sm">
                                        <option disabled>Choose Country</option>
                                        <option value="china" @selected($item->country == 'china')>
                                            China
                                        </option>
                                        <option value="india" @selected($item->country == 'india')>
                                            India
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="">Select State <span class="text-danger badge">*</span></label>
                                    <select name="state" class="form-select form-select-sm">
                                        <option disabled>Choose State</option>
                                        <option value="odisha" @selected($item->state == 'odisha')>
                                            Odisha
                                        </option>
                                        <option value="maharashtra" @selected($item->state == 'maharashtra')>
                                            Maharashtra</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="">Default Language </label>
                                    <select name="language" class="form-select form-select-sm">
                                        <option value="english" @selected($item->language == 'english')>
                                            English
                                        </option>
                                        <option value="hindi" @selected($item->language == 'hindi')>
                                            Hindi
                                        </option>
                                        <option value="oriya" @selected($item->language == 'oriya')>
                                            Oriya
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="my-3 row">
                                <div class="col-md-8">
                                    <label for="">Name <span class="text-danger badge">*</span></label>
                                    <input type="text" name="name" class="form-control form-control-sm"
                                        value="{{ $item->name }}">
                                </div>

                                <div class="col-md-4">
                                    <label for="">Mobile No. <span class="text-danger badge">*</span></label>
                                    <input type="text" name="mobile_no" class="form-control form-control-sm"
                                        value="{{ $item->mobile_no }}">
                                </div>
                            </div>

                            <div class="my-2 row">
                                <div class="col-md-4">
                                    <label for="">Sales Mobile No. (+91) </label>
                                    <input type="text" name="sales_mobile_no" class="form-control form-control-sm"
                                        value="{{ $item->sales_mobile_no }}">
                                    @error('sales_mobile_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Sales LandLine No.</label>
                                    <input type="text" name="landline_no" class="form-control form-control-sm"
                                        value="{{ $item->sales_landline_no }}">
                                    @error('landline_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Email ID <span class="text-danger badge">*</span></label>
                                    <input type="email" name="email_id" class="form-control form-control-sm"
                                        value="{{ $item->email }}">
                                </div>
                            </div>
                            <div class="my-2 row">
                                <div class="col-md-4">
                                    <label for="">Smart Parent App Package <span class="text-danger badge">*</span></label>
                                    <input type="text" name="smart_parent_app_package" class="form-control form-control-sm"
                                        value="{{ $item->smart_parent_app_package }}">
                                    @error('smart_parent_app_package')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Show Powered By <span class="text-danger badge">*</span></label>
                                    <input type="text" name="show_powered_by" class="form-control form-control-sm"
                                        value="{{ $item->show_powered_by }}">
                                    @error('show_powered_by')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Powered By </label>
                                    <input type="text" name="power_by" class="form-control form-control-sm"
                                        value="{{ $item->power_by }}">
                                    @error('power_by')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="my-2 row">
                                <div class="col-md-4">
                                    <label for="">Account Limit <span class="text-danger badge">*</span></label>
                                    <input type="number" name="account_limit" class="form-control form-control-sm"
                                        value="{{ $item->account_limit }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Http Sms Gateway URL </label>
                                    <input type="text" name="http_sms_url" class="form-control form-control-sm"
                                        value="{{ $item->http_sms_url }}">
                                    @error('http_sms_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">http Sms Gateway Method</label>
                                    <input name="http_sms__gateway_method" class="form-control form-control-sm"
                                        value="{{ $item->http_sms__gateway_method }}">
                                    @error('http_sms__gateway_method')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="my-2 row">
                                <div class="col-md-4">
                                    <label for="">GSTN No.</label>
                                    <input type="text" name="gstn_no" class="form-control form-control-sm"
                                        value="{{ $item->gstn_no }}">
                                    @error('gstn_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="">Billing Email</label>
                                    <input type="email" name="billing_email" class="form-control form-control-sm"
                                        value="{{ $item->billing_email }}">
                                    @error('billing_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">IsAllowThirdPartyAPI</label>
                                    <input type="text" name="isallowthirdpartyapi" class="form-control form-control-sm"
                                        value="{{ $item->isallowthirdpartyapi }}">
                                    @error('isallowthirdpartyapi')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="my-2 row">
                                <div class="col-md-4">
                                    <label for="">Web URL </label>
                                    <input type="url" name="web_url" class="form-control form-control-sm"
                                        value="{{ old('web_url') }}">
                                    @error('web_url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="">Logo</label>
                                    <input type="file" name="profile_image" class="form-control form-control-sm">
                                    @if($item->profile_image)
                                        <img src="{{ asset('uploads/' . $item->profile_image) }}" alt="Profile Image" class="mt-2"
                                            width="80">
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label for="">Address </label>
                                    <input type="text" name="address" class="form-control form-control-sm"
                                        value="{{ $item->address }}">
                                </div>
                            </div>
                            <div class="my-3">
                                <button type="submit" class="btn btn-primary">Update WLP</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

    <!-- Enhanced Create WLP Modal -->
    <div class="modal fade" id="wlpModal" tabindex="-1" aria-labelledby="wlpModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0">
                <!-- Modal Header -->
                <div class="modal-header text-white rounded-top" style="background-color: #260950">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-building me-2"></i>
                        <h5 class="modal-title mb-0" id="wlpModalLabel">Create New WLP Account</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <form action="{{ route('wlp.store') }}" method="post" id="wlp_rgd_form" enctype="multipart/form-data">
                        @csrf

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
                                        <option value="china" @selected(old('country') == 'china')>China</option>
                                        <option value="india" @selected(old('country') == 'india')>India</option>
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
                                    <label class="form-label fw-semibold">Default Language</label>
                                    <select name="language" class="form-select">
                                        <option value="english" @selected(old('language') == 'english')>English</option>
                                        <option value="hindi" @selected(old('language') == 'hindi')>Hindi</option>
                                        <option value="oriya" @selected(old('language') == 'oriya')>Oriya</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Contact Details -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3 d-flex align-items-center">
                                <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                    <i class="fas fa-address-card"></i>
                                </span>
                                Contact Details
                            </h6>

                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label fw-semibold">Organization Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        placeholder="Enter organization name">
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Mobile Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="mobile_no" class="form-control" value="{{ old('mobile_no') }}"
                                        placeholder="+91">
                                    @error('mobile_no')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Sales Mobile (+91)</label>
                                    <input type="text" name="sales_mobile_no" class="form-control"
                                        value="{{ old('sales_mobile_no') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Landline Number</label>
                                    <input type="text" name="landline_no" class="form-control"
                                        value="{{ old('landline_no') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email_id" class="form-control" value="{{ old('email_id') }}"
                                        placeholder="example@domain.com">
                                    @error('email_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Technical Settings -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3 d-flex align-items-center">
                                <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                    <i class="fas fa-cog"></i>
                                </span>
                                Technical Settings
                            </h6>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">App Package <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="smart_parent_app_package" class="form-control"
                                        value="{{ old('smart_parent_app_package') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Show Powered By</label>
                                    <select name="show_powered_by" class="form-select">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Powered By Text</label>
                                    <input type="text" name="power_by" class="form-control" value="{{ old('power_by') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Account Limit <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="account_limit" class="form-control"
                                        value="{{ old('account_limit') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">SMS Gateway URL</label>
                                    <input type="url" name="http_sms_url" class="form-control"
                                        value="{{ old('http_sms_url') }}" placeholder="https://">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">SMS Gateway Method</label>
                                    <select name="http_sms__gateway_method" class="form-select">
                                        <option value="GET">GET</option>
                                        <option value="POST">POST</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Additional Information -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3 d-flex align-items-center">
                                <span class="bg-primary bg-opacity-10 p-2 rounded-circle me-2">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                                Additional Information
                            </h6>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">GSTIN Number</label>
                                    <input type="text" name="gstn_no" class="form-control" value="{{ old('gstn_no') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Billing Email</label>
                                    <input type="email" name="billing_email" class="form-control"
                                        value="{{ old('billing_email') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Allow Third Party API</label>
                                    <select name="isallowthirdpartyapi" class="form-select">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Website URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text">https://</span>
                                        <input type="text" name="web_url" class="form-control" value="{{ old('web_url') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Logo</label>
                                    <input type="file" name="logo" class="form-control">
                                    <small class="text-muted">Recommended size: 300x300px</small>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-semibold">Address <span class="text-danger">*</span></label>
                                    <textarea name="address" rows="3" class="form-control">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer border-top-0 pt-0">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-outline-light">
                                <i class="fas fa-save me-2"></i>Create WLP Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
@endsection