@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Distributors List</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="{{ route('create.admin') }}" class="btn btn-sm btn-theme" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    Create Distributor
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
    @if (Session::has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> {{ Session::get('delete') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong> {{ Session::get('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <h5 class="text-capitalize"><em>It shows the list of Distributors and their details</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered dataTable">
                <thead class="text-white" style="background-color: #260950">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Business Name </th>
                        <th scope="col">Owner Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact No</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($distributors as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->business_name}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->mobile}}</td>
                            <td>{{$item->passwordText}}</td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="{{ route('distributor.edit',$id = $item->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-pen" style="color:#fff"></i>
                                    </a>
                                    <form action="{{ route('distributor.delete', $item->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                            <i class="fa-solid fa-trash" style="color:#fff"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#detailsModal{{ $loop->iteration }}">
                                        <i class="fa fa-eye" style="color:#fff"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        {{-- Details Modal --}}
                        <div class="modal fade" id="detailsModal{{$loop->iteration}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Distributor Details</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card p-2">
                                            <div class="row text-capitalize">
                                                <div class="col-md-6">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><em>Business Name:
                                                                {{$item->business_name}}</em></li>
                                                        <li class="list-group-item">
                                                            State: {{$item->state}}
                                                        </li>
                                                        <li class="list-group-item">Language: {{$item->language_known}}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><em>Name: {{$item->name}}</em> </li>
                                                        <li class="list-group-item"><em>Districts:
                                                                <ul class="list-group">
                                                                    @foreach ($item->districts as $item)
                                                                        <li class="list-group-item">{{$item}}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </em>
                                                        </li>
                                                        <ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        {{-- Details Modal End--}}


                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #260950">
                    <h1 class="modal-title fs-5" id="createModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Create New Distributor
                    </h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('distributor.store') }}" method="post" class="needs-validation" novalidate>
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
                                                <input type="text"
                                                    class="form-control @error('business_name') is-invalid @enderror"
                                                    id="businessNameInput" name="business_name"
                                                    value="{{ old('business_name') }}" placeholder="Enter business name"
                                                    required aria-describedby="businessNameHelp">

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
                                            <label for="contactPersonName"
                                                class="form-label fw-semibold d-flex align-items-center">
                                                <i class="fas fa-user me-2 text-primary"></i>
                                                Contact Person Name
                                                <span class="text-danger ms-1">*</span>
                                            </label>

                                            <div class="input-group has-validation">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-id-card"></i>
                                                </span>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                    id="contactPersonName" name="name" value="{{ old('name') }}"
                                                    placeholder="Full name of contact person" required minlength="3"
                                                    maxlength="100" aria-describedby="contactPersonHelp">

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
                                        <label class="form-label fw-semibold">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                            required>
                                        @error('email')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Row 2 -->
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Gender <span
                                                class="text-danger">*</span></label>
                                        <select name="gender" class="form-select" required>
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="male" @selected(old('gender') == 'male')>Male</option>
                                            <option value="female" @selected(old('gender') == 'female')>Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Mobile <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">+91</span>
                                            <input type="tel" class="form-control" name="mobile" value="{{ old('mobile') }}"
                                                required>
                                        </div>
                                        @error('mobile')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Date of Birth <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="date_of_birth"
                                            value="{{ old('date_of_birth') }}" required>
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
                                        <label class="form-label fw-semibold">Map Device Edit <span
                                                class="text-danger">*</span></label>
                                        <select name="is_map_device_edit" class="form-select" required>
                                            <option value="" disabled selected>Select Option</option>
                                            <option value="yes" @selected(old('is_map_device_edit') == 'yes')>Yes</option>
                                            <option value="no" @selected(old('is_map_device_edit') == 'no')>No</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">PAN Number <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="pan_number"
                                            value="{{ old('pan_number') }}" required>
                                        @error('pan_number')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold">Occupation <span
                                                class="text-danger">*</span></label>
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
                                        <label class="form-label fw-semibold">Advance Payment <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">₹</span>
                                            <input type="number" class="form-control" name="advance_payment"
                                                value="{{ old('advance_payment') }}" required>
                                        </div>
                                        @error('advance_payment')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Row 4 -->
                                    <div class="col-12">
                                        <label class="form-label fw-semibold">Languages Known <span
                                                class="text-danger">*</span></label>
                                        <select data-placeholder="Select languages" multiple
                                            class="form-control chosen-select" name="language_known[]" required>
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
                                        <label class="form-label fw-semibold">Country <span
                                                class="text-danger">*</span></label>
                                        <select name="country" class="form-select country" required>
                                            <option value="" disabled selected>Choose Country</option>
                                            <option value="china" @selected(old('country') == 'china')>China</option>
                                            <option value="india" @selected(old('country') == 'india')>India</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">State <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select state" name="state" required>
                                            <option value="" disabled selected>Select State</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">District <span
                                                class="text-danger">*</span></label>
                                        <select name="districts[]" class="form-select district" multiple="multiple"
                                            required>
                                            <option value="" disabled>Select District(s)</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Address <span
                                                class="text-danger">*</span></label>
                                        <textarea class="form-control" name="address" rows="2"
                                            required>{{ old('address') }}</textarea>
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
                </div>
            </div>
        </div>
    </div>
@endsection