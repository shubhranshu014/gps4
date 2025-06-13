@extends($layouts)
@section('content')
    <div class="align-items-center mb-3 row" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="px-2 py-3 text-white card-title">Technician List</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="" class="btn btn-sm btn-theme" data-bs-toggle="modal" data-bs-target="#createModal">
                    Create Technician
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
    <div class="row">
        <h5 class="text-capitalize"><em>It shows the list of Technician and their details</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered dataTable">
                <thead class="text-white" style="background-color: #260950">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Dealer</th>
                        <th scope="col"> Name </th>
                        <th scope="col">Contact No</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($technician as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->dealer->pluck('business_name')->first()}}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen" style="color:#fff"></i></a>
                                <form action="" method="POST" style="display:inline-block;">
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

    <!-- Show Modal on Validation Error -->
    @if ($errors->any())
        <script>
            $(document).ready(function () {
                $('#createModal').modal('show');
            });
        </script>
    @endif

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Create Technician</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('technician.store') }}" method="post" novalidate>
                        @csrf

                        <!-- Distributer -->
                        <div class="mb-3 row">
                            @if (Auth::guard('manufacturer')->check())
                                <div class="col-md-6">
                                    <label class="form-label">Select Distributer</label>
                                    <select name="distributer"
                                        class="form-select-sm form-select @error('distributer') is-invalid @enderror"
                                        id="distributer">
                                        <option selected disabled>Select Distributer</option>
                                        @foreach ($distributor as $item)
                                            <option value="{{ $item->id }}" {{ old('distributer') == $item->id ? 'selected' : '' }}>
                                                {{ $item->business_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Select Dealer</label>
                                    <select name="dealer"
                                        class="form-select-sm form-select @error('dealer') is-invalid @enderror" id="dealer">
                                        <option selected disabled>Select Distributer First</option>
                                    </select>
                                    @error('dealer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif (Auth::guard('distributor')->check())
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <label class="form-label">Select Dealer</label>
                                    <select name="dealer"
                                        class="form-select-sm form-select @error('dealer') is-invalid @enderror" id="dealer">
                                        <option selected disabled>Select Dealer</option>
                                        @foreach ($dealer as $item)
                                            <option value="{{ $item->id }}" {{ old('dealer') == $item->id ? 'selected' : '' }}>
                                                {{ $item->business_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('dealer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @endif
                        <!-- Name, Gender, Email -->
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label>Gender <span class="text-danger">*</span></label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                    <option>Select Option</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label>Email Id <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Mobile, Aadhar, DOB -->
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control @error('mobile_no') is-invalid @enderror"
                                    name="mobile_no" value="{{ old('mobile_no') }}">
                                @error('mobile_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>Aadhar</label>
                                <input type="text" class="form-control @error('aadhar') is-invalid @enderror" name="aadhar"
                                    value="{{ old('aadhar') }}">
                                @error('aadhar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label>DOB</label>
                                <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob"
                                    value="{{ old('dob') }}">
                                @error('dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Qualification -->
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label>Qualification <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('qulification') is-invalid @enderror"
                                    name="qulification" value="{{ old('qulification') }}">
                                @error('qulification')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#distributer').on('change', function () {
            var distributer = $(this).val();
            alert(distributer);
            if (distributer) {
                // Make an AJAX request to fetch distributors
                $.ajax({
                    url: '/manufacturer/fetch-dealer',
                    type: 'GET',
                    data: {
                        distributer: distributer
                    },
                    success: function (response) {
                        alert(JSON.stringify(response))
                        $('#dealer').empty();
                        $('#dealer').append('<option value="">Select Dealer</option>');

                        // Loop through distributors and append them to the select
                        $.each(response, function (index, dealer) {
                            $('#dealer').append('<option value="' + dealer.id +
                                '">' + dealer.name + '</option>');
                        });
                    }
                });
            } else {
                // If no region selected, clear the distributor select
                $('#dealer').empty();
                $('#dealer').append('<option value="">Select Distributor</option>');
            }
        });
    </script>
@endsection