@extends($layout)

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .chosen-container-multi .chosen-choices {
        padding: 0.4rem 0.6rem;
        border-radius: 5px;
        border: 1px solid #ced4da;
        min-height: 38px;
        background-color: #f8f9fa;
    }
</style>

<div class="card shadow-sm border-0 mb-3">
    <div class="card-body">
        <div class="row align-items-center bg-primary text-white py-3 px-2 rounded shadow-sm">
            <div class="col-md-4">
                <h4 class="card-title mb-0">Assign Elements</h4>
            </div>
            <div class="col-md-8 text-end">
                <button type="button" class="btn btn-sm btn-outline-light text-dark border" data-bs-toggle="modal" data-bs-target="#assignModal">
                    <i class="fas fa-plus-circle me-1"></i> Assign Elements
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Alerts --}}
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle fa-lg me-3"></i>
        <div><strong>{{ Session::get('success') }}</strong></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
        <div><strong>{{ Session::get('error') }}</strong></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card my-3 shadow-sm">
    <div class="card-body">
        <h5 class="text-muted"><em>List of assigned elements to admins</em></h5>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-striped align-middle dataTable">
                <thead class="text-white" style="background-color: #260950;">
                    <tr>
                        <th>Si No</th>
                        <th>Element Name</th>
                        <th>Owner Name <small>(Admin)</small></th>
                        <th>Business Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assignElements as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->element->pluck('name')->first() }}</td>
                            <td>{{ $item->admin->pluck('name')->first() }}</td>
                            <td>{{ $item->admin->pluck('business_name')->first() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-sm">
            <div class="modal-header text-white">
                <h5 class="modal-title" id="assignModalLabel">Assign Elements</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('assignElement.admin.store') }}" method="post" id="AssignElementForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Select Elements:</label>
                            <select name="element[]" class="chosen-select form-select form-select-sm w-100" multiple data-placeholder="Choose elements...">
                                @foreach ($element as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('element')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Select Admin:</label>
                            <select name="admin" class="form-select form-select-sm">
                                <option selected disabled>Please select admin</option>
                                @foreach ($admin as $item)
                                    <option value="{{ $item->id }}">{{ $item->business_name }}</option>
                                @endforeach
                            </select>
                            @error('admin')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-outline-light">
                            <i class="fas fa-paper-plane me-1"></i> Assign
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.chosen-select').chosen({
            width: '100%',
            search_contains: true,
            placeholder_text_multiple: "Choose elements..."
        });
    });
</script>
@endsection
