@extends($layout)

@section('content')
    <div class="container-fluid">
        @include('subnav.element')

        <!-- Alerts Section -->
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>{{ Session::get('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cubes me-2 text-primary"></i>Elements Management
                    </h5>
                    <p class="text-muted mb-0">
                        <i class="fas fa-info-circle me-1"></i>List of all elements and their details
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table dataTable table-hover align-middle">
                        <thead class="text-white" style="background: linear-gradient(135deg, #260950 0%, #4a1f96 100%);">
                            <tr>
                                <th width="10%" class="text-center">#</th>
                                <th width="45%">Element Name</th>
                                <th width="20%" class="text-center">VLTD Status</th>
                                <th width="25%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($element as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">
                                        @if ($item->is_vltd == 0)
                                            <span class="badge bg-success rounded-pill px-3 py-2">
                                                <i class="fas fa-check-circle me-1"></i> Active
                                            </span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill px-3 py-2">
                                                <i class="fas fa-times-circle me-1"></i> Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"
                                                data-bs-tooltip="tooltip" data-bs-placement="top" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>

                                            <!-- Delete Button -->
                                            <form action="{{ route('element.delete', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    data-bs-tooltip="tooltip" data-bs-placement="top" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this element?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header" style="background-color: #260950;">
                                                <h5 class="modal-title text-white" id="editModalLabel{{ $item->id }}">
                                                    <i class="fas fa-edit me-2"></i>Edit Element
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('element.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3">
                                                        <label for="elementName{{ $item->id }}" class="form-label">
                                                            Element Name
                                                        </label>
                                                        <input type="text" id="elementName{{ $item->id }}" class="form-control"
                                                            name="element_name" value="{{ $item->name }}" required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="isVltd{{ $item->id }}" class="form-label">VLTD
                                                            Status</label>
                                                        <select id="isVltd{{ $item->id }}" name="is_vltd" class="form-select"
                                                            required>
                                                            <option value="0" @selected($item->is_vltd == '0')>Active</option>
                                                            <option value="1" @selected($item->is_vltd == '1')>Inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-save me-2"></i>Update Element
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        .card {
            border-radius: 12px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(38, 9, 80, 0.05);
        }

        .badge {
            font-weight: 500;
        }

        .btn-rounded {
            border-radius: 50px;
        }

        .modal-header {
            border-radius: 12px 12px 0 0;
        }
    </style>
@endsection