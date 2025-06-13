@extends('layouts.distributor')
@section('content')
    <div class="container-fluid px-4">
        <div class="row align-items-center mb-4" style="background: linear-gradient(135deg, #260950 0%, #3a1b7a 100%);">
            <div class="col-md-8">
                <h4 class="text-white px-3 py-3 mb-0">
                    <i class="fas fa-barcode me-2"></i>
                    Allocated Barcode Management
                </h4>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-end pe-3">
                    <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        <i class="fas fa-share-nodes me-2"></i> Allocate Barcode
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

        <div class="card">
            <div class="card-body">
                <table class="table table-hover dataTable align-middle mb-0" id="barcodeTable">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Device Serial No</th>
                            <th>SIM Details</th>
                            <th>ICCID No / SIM Manufacture</th>
                            <th>Type</th>
                            <th>Model No</th>
                            <th>Part No</th>
                            <th>Barcode Type</th>
                            <th>Created At</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barcodes as $item)
                            <tr>
                                <td class="ps-4">
                                    <a href="#" class="text-primary fw-semibold" data-bs-toggle="modal"
                                        data-bs-target="#deviceModal{{ $loop->iteration }}" title="Device Info">
                                        <div>{{ $item->barcode->serialNumber }}</div>
                                        <small class="text-muted">{{ $item->barcode->barcodeNo }}</small>
                                    </a>
                                </td>
                                <td>
                                    @php
                                        $sim = DB::table('sims')->where('barcode_id', $item->barcode->id)->get();
                                        
                                    @endphp
                                    
                                    @foreach ($sim as $simdata)
                                        <a href="#" class="d-block text-primary" data-bs-toggle="modal"
                                            data-bs-target="#SimModal{{ $simdata->simNo }}" title="Sim Info">
                                            {{ $simdata->simNo }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($sim as $simdata)
                                        <div>{{ $simdata->ICCIDNo }}</div>
                                        <small class="text-primary">{{ $simdata->manufacture }}</small>
                                    @endforeach
                                </td>
                                <td>{{ $item->barcode->elementType->pluck('type')->first() }}</td>
                                <td>{{ $item->barcode->modelNo->pluck('model_no')->first() }}</td>
                                <td>{{ $item->barcode->partNo->pluck('part_no')->first() }}</td>
                                <td>
                                    @if ($item->is_renew == 0)
                                        <span class="badge bg-success bg-opacity-10 text-success">NEW</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">RENEWED</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                <td class="text-center">
                                    @if ($item->status == 0)
                                        <span class="badge bg-success">ACTIVE</span>
                                    @elseif($item->status == 1)
                                        <span class="badge bg-warning">ALLOCATED</span>
                                    @else
                                        <span class="badge bg-danger">USED</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Allocate BarCode</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('distributor.allocate.barcode.store') }}" method="post" id="allocateform">
                            @csrf

                            <div class="mb-3">
                                <label for="" class="form-label">Select District</label>
                                <select name="district" class="form-select @error('district')
                                      is-invalid  
                                @enderror" id="districtSelect">
                                    <option selected disabled>Allocated District List:</option>
                                    @foreach (auth('distributor')->user()->districts as $item)
                                        <option value="{{ $item }}">{{$item}}</option>
                                    @endforeach
                                </select>
                                @error('district')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Select Dealer</label>
                                <select name="dealer" class="form-select @error('dealer')
                                       is-invalid 
                                @enderror" id="dealerlist">


                                </select>
                                @error('dealer')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-control">Select Barcode</label>
                                <select name="barcode[]" class="form-select @error('barcode')
                                    is-invalid
                                @enderror" multiple>
                                    @foreach ($barcodes as $item)
                                        <option value="{{$item->id}}">{{ $item->barcode->serialNumber }}</option>
                                    @endforeach
                                </select>
                                @error('barcode')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        <button type="submit" form="allocateform" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function () {
            $('#districtSelect').on('change', function () {
                var selectedDistrict = $(this).val();

                $.ajax({
                    url: '/distributor/fetch/dealerByDistrict', // Update this to your actual route
                    type: 'GET',
                    data: {
                        district: selectedDistrict
                    },
                    success: function (response) {
                        // Assuming response is an array of dealer objects like: [{id: 1, name: "Dealer A"}, ...]
                        $('#dealerlist').empty(); // Clear previous options
                        $('#dealerlist').append('<option disabled selected>Select Dealer:</option>');

                        if (response.length > 0) {
                            response.forEach(function (dealer) {
                                $('#dealerlist').append(
                                    `<option value="${dealer.id}">${dealer.name}</option>`
                                );
                            });
                        } else {
                            $('#dealerlist').append('<option disabled>No dealers found.</option>');
                        }
                    },
                    error: function (xhr) {
                        console.error('AJAX Error:', xhr.responseText);
                    }
                });
            });
        });

    </script>
@endsection