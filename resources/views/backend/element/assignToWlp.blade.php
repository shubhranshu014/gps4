@extends('layouts.admin')
@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section with Icon -->
        <div class="row align-items-center mb-4 py-3 gx-2"
            style="background: linear-gradient(135deg, #260950 0%, #4a1b9d 100%); border-radius: 10px; box-shadow: 0 4px 20px rgba(38, 9, 80, 0.15);">
            <div class="col-md-6 d-flex align-items-center">
                {{-- <div class="icon-shape bg-white rounded-3 ">
                    <i class="fas fa-puzzle-piece fa-lg text-purple" style="color: #260950;"></i>
                </div> --}}
                <div class="p-2 me-3">
                    <h4 class="text-white mb-0">Assign Elements</h4>
                    <p class="text-white-50 mb-0 small">Manage element assignments to administrators</p>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <button class="btn btn-light-purple" data-bs-toggle="modal" data-bs-target="#assignModal">
                    <i class="fas fa-plus-circle me-2"></i> Assign Elements
                </button>
            </div>
        </div>

        <!-- Alerts Section -->
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="fas fa-check-circle fa-lg me-3"></i>
                <div>
                    <strong>{{ Session::get('success') }}</strong>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                <div>
                    <strong>{{ Session::get('error') }}</strong>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Dashboard Cards -->
        <div class="row justify-content-center mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Elements</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($element) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cubes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col me-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Active WLP/ReSeller</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Wlp::where('admin_id', auth('admin')->user()->id)->count()}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Table Card -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-0 pt-3 pb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-list-alt me-2 text-primary"></i>
                                Assignment Records
                            </h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-cog"></i> Options
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-export me-2"></i>Export</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-filter me-2"></i>Filter</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-columns me-2"></i>Columns</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-muted small mb-0">Showing all assigned elements to administrators</p>
                    </div>
                    <div class="card-body pt-1">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable table-borderless" id="assignElementsTable"
                                style="width:100%">
                                <thead class="text-white"
                                    style="background: linear-gradient(135deg, #260950 0%, #4a1b9d 100%);">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="30%">
                                            <i class="fas fa-cube me-2"></i>Element
                                        </th>
                                        <th width="30%">
                                            <i class="fas fa-user-tie me-2"></i>WLP/Reseller
                                        </th>
                                        <th width="35%" class="text-start">
                                            <i class="fas fa-building me-2"></i>Mobile No
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assignElements as $item)
                                        <tr class="border-bottom">
                                            <td class="fw-bold">{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="d-flex align-items-center">
                                                    <i class="fas fa-cube text-primary me-2"></i>
                                                    <span class="badge bg-light text-dark border">
                                                        {{ $item->element->pluck('name')->first()}}
                                                    </span>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="d-flex align-items-center">
                                                    <i class="fas fa-user-circle text-info me-2"></i>
                                                    {{ $item->wlp->pluck('name')->first() }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="d-flex align-items-center">
                                                    <i class="fas fa-store text-success me-2"></i>
                                                    {{ $item->wlp->pluck('mobile_no')->first() }}
                                                </span>
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
    </div>

    <!-- Assign Modal -->
    <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #260950 0%, #4a1b9d 100%);">
                    <h5 class="modal-title d-flex align-items-center" id="assignModalLabel">
                        <i class="fas fa-puzzle-piece me-2"></i>
                        Assign New Elements
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('assigneElement.wlp.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="elements" class="form-label fw-bold d-flex align-items-center">
                                        <i class="fas fa-cubes me-2 text-primary"></i>Select Elements:
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                        <select id="elements" name="element[]" class="form-select select2-multi" multiple>
                                            <option disabled selected>Elements List:</option>
                                            @foreach ($element as $item)
                                                <option value="{{ $item->element_id }}">
                                                    {{ $item->element->pluck('name')->first()}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('element')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="admin" class="form-label fw-bold d-flex align-items-center">
                                        <i class="fas fa-user-tie me-2 text-primary"></i>Select WLP/ReSeller:
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-users text-muted"></i>
                                        </span>
                                        <select name="wlp" id="admin" class="form-select">
                                            <option value="" selected disabled>Select WLP/ReSeller</option>
                                            @foreach ($Wlp as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('admin')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-0 pt-4 px-0">
                            <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-light-purple px-4">
                                <i class="fas fa-save me-1"></i> Save Assignment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Initialize select2 for multi-select
            $('.select2-multi').select2({
                placeholder: "Search and select elements...",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#assignModal')
            });

            // Initialize DataTable with more options
            $('#assignElementsTable').DataTable({
                responsive: true,
                dom: '<"top"<"d-flex justify-content-between align-items-center"lf>>rt<"bottom"<"d-flex justify-content-between align-items-center"ip>><"clear">',
                language: {
                    search: "",
                    searchPlaceholder: "Search assignments...",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        previous: '<i class="fas fa-chevron-left"></i>',
                        next: '<i class="fas fa-chevron-right"></i>'
                    }
                },
                initComplete: function () {
                    $('.dataTables_filter input').addClass('form-control form-control-sm');
                    $('.dataTables_length select').addClass('form-select form-select-sm');
                }
            });
        });
    </script>


    <style>
        :root {
            --primary-color: #260950;
            --secondary-color: #4a1b9d;
            --light-purple: #f0e6ff;
        }

        body {
            background-color: #f8f9fa;
        }

        .btn-light-purple {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            transition: all 0.3s;
            background-image: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }

        .btn-light-purple:hover {
            background-image: linear-gradient(to right, var(--secondary-color), var(--primary-color));
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(74, 27, 157, 0.3);
            color: white;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            font-weight: 600;
            letter-spacing: 0.5px;
            vertical-align: middle;
            padding: 12px 16px;
        }

        .table tbody tr {
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(74, 27, 157, 0.05);
        }

        .badge {
            font-size: 0.85em;
            padding: 5px 10px;
            font-weight: 500;
        }

        .border-left-primary {
            border-left: 4px solid #4e73df;
        }

        .border-left-success {
            border-left: 4px solid #1cc88a;
        }

        .border-left-info {
            border-left: 4px solid #36b9cc;
        }

        .border-left-warning {
            border-left: 4px solid #f6c23e;
        }

        .icon-shape {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .text-purple {
            color: var(--primary-color);
        }

        .select2-container--default .select2-selection--multiple {
            min-height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: var(--light-purple);
            border: 1px solid var(--secondary-color);
            color: var(--primary-color);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .page-link {
            color: var(--primary-color);
        }
    </style>
@endsection