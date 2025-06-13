@extends($layout)

@section('content')
    <div class="container">
        <div class="mb-4 py-3 text-white" style="background-color: #260950;">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Admin</h4>
                    <a href="{{ route('admin.list') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-list"></i> Admin List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm px-3">
            <div class="card-body">
                <form action="{{ route('admin.update', ['id' => $admin->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-bold">Name Of The Business <span class="text-danger">*</span></label>
                        <input type="text" name="business_name" class="form-control"
                            value="{{ old('business_name', $admin->business_name) }}">
                        @error('business_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Registered Address <span class="text-danger">*</span></label>
                        <textarea name="regd_address" rows="3"
                            class="form-control">{{ old('regd_address', $admin->regd_address) }}</textarea>
                        @error('regd_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">GSTIN No. <span class="text-danger">*</span></label>
                            <input type="text" name="gstin_no" class="form-control"
                                value="{{ old('gstin_no', $admin->gstin_no) }}">
                            @error('gstin_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">PAN No. <span class="text-danger">*</span></label>
                            <input type="text" name="pan_no" class="form-control"
                                value="{{ old('pan_no', $admin->pan_no) }}">
                            @error('pan_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $admin->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Contact No. <span class="text-danger">*</span></label>
                            <input type="text" name="contact_no" class="form-control"
                                value="{{ old('contact_no', $admin->contact_no) }}">
                            @error('contact_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Upload GST Certificate <small>(PDF Only)</small></label>
                            <input type="file" name="gst_certificate" class="form-control">
                            @if ($admin->gst_certificate)
                                <p class="mt-2">Current File: <a
                                        href="{{ asset('storage/uploads/' . $admin->gst_certificate) }}"
                                        target="_blank">View</a></p>
                            @endif
                            @error('gst_certificate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Upload PAN Card <small>(PDF Only)</small></label>
                            <input type="file" name="pan_card" class="form-control">
                            @if ($admin->pan_card)
                                <p class="mt-2">Current File: <a href="{{ asset('storage/uploads/' . $admin->pan_card) }}"
                                        target="_blank">View</a></p>
                            @endif
                            @error('pan_card')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Upload Incorporation Certificate <small>(PDF
                                    Only)</small></label>
                            <input type="file" name="incorporation_certificate" class="form-control">
                            @if ($admin->incorporation_certificate)
                                <p class="mt-2">Current File: <a
                                        href="{{ asset('storage/uploads/' . $admin->incorporation_certificate) }}"
                                        target="_blank">View</a></p>
                            @endif
                            @error('incorporation_certificate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Company Logo <span class="text-danger">*</span></label>
                            <input type="file" name="logo" class="form-control">
                            @if ($admin->logo)
                                <p class="mt-2">Current Logo: <img src="{{ asset('storage/uploads/' . $admin->logo) }}"
                                        width="100"></p>
                            @endif
                            @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection