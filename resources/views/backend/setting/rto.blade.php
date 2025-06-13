@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center py-3" style="background-color: #260950;"> <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3 mb-0">Manage RTO</h4>
            <!-- Remove the margin bottom -->
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <button type="button" class="btn btn-sm btn-theme border-white" data-bs-toggle="modal"
                    data-bs-target="#addRto" style="white-space: nowrap;">
                    Add RTO
                </button>
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

    <div class="row my-4">
        <h5 class="text-capitalize"><em>It shows the list of RTO</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered table-striped dataTable">
                <thead class="text-white" style="background-color: #260950">

                    <tr>
                        <th>Si. No.</th>
                        <th>State</th>
                        <th>District</th>
                        <th>RTO</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($rto as $item)
                        <tr>
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$item->state}}
                            </td>
                            <td>{{$item->district}}</td>
                            <td>
                                {{$item->rto}}
                            </td>
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

    <!-- Modal -->
    <div class="modal fade" id="addRto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add RTO</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('mgf.setting.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Select State</label>
                            <select type="text" class="form-select state" name="state">
                                <option disabled selected>Select State</option>
                                <option>Andhra Pradesh</option>
                                <option>Arunachal Pradesh</option>
                                <option>Assam</option>
                                <option>Bihar</option>
                                <option>Chhattisgarh</option>
                                <option>Goa</option>
                                <option>Gujarat</option>
                                <option>Haryana</option>
                                <option>Himachal Pradesh</option>
                                <option>Jharkhand</option>
                                <option>Karnataka</option>
                                <option>Kerala</option>
                                <option>Maharashtra</option>
                                <option>Madhya Pradesh</option>
                                <option>Manipur</option>
                                <option>Meghalaya</option>
                                <option>Mizoram</option>
                                <option>Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option>Punjab</option>
                                <option>Rajasthan</option>
                                <option>Sikkim</option>
                                <option>Tamil Nadu</option>
                                <option>Tripura</option>
                                <option>Telangana</option>
                                <option>Uttar Pradesh</option>
                                <option>Uttarakhand</option>
                                <option>West Bengal</option>
                                <option>Andaman & Nicobar (UT)</option>
                                <option>Chandigarh (UT)</option>
                                <option>Dadra & Nagar Haveli and Daman & Diu (UT)</option>
                                <option>Delhi [National Capital Territory (NCT)]</option>
                                <option>Jammu & Kashmir (UT)</option>
                                <option>Ladakh (UT)</option>
                                <option>Lakshadweep (UT)</option>
                                <option>Puducherry (UT)</option>
                            </select>
                            @error('state')
                                <em class="text-danger">{{$message}}</em>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Select District</label>
                            <select name="district" class="form-select district"></select>
                            @error('district')
                                <em class="text-danger">{{$message}}</em>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Enter RTO</label>
                            <input type="text" class="form-control" name="rto">
                            @error('rto')
                                <em class="text-danger">{{$message}}</em>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-theme">Submit</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection