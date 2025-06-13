@extends('layouts.dealer')
@section('content')
    <div class="container-fluid px-4">

        <!-- Header Section -->
        <div class="row align-items-center py-3 mb-4"
            style="background: linear-gradient(135deg, #260950 0%, #260950 100%); border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <h4 class="text-white mb-0 px-3 py-2 fw-bold">
                        <i class="fas fa-barcode me-2"></i>
                        Barcodes
                    </h4>
                    <span class="badge bg-light text-dark ms-2">Total: {{ count($barcode) }}</span>
                </div>
            </div>
            <div class="col-md-4">
                {{-- <div class="d-flex justify-content-end pe-3">
                    <a class="btn btn-theme t d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        <i class="fas fa-plus-circle me-2"></i>
                        Add Barcode
                    </a>
                </div> --}}
            </div>
        </div>
    </div>


    <!-- Data Table Section -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-list-alt me-2 text-primary"></i>
                    Barcode Records
                </h5>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
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
                        @foreach ($barcode as $item)
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
                                        $sim = DB::table('sims')->where('barcode_id', $item->barcode_id)->get();
                                    @endphp
                                    {{-- {{ $item->barcode_id }} --}}
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
                                <td>{{ $item->barcode->elementType->pluck('type')->first()}}</td>
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
    </div>
@endsection