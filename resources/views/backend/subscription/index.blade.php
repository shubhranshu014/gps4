@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Subscriptions List</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2 gap-2">
                <!-- Edit Button - Secondary prominence -->
                <button id="editSubscriptionBtn" class="btn btn-outline-warning btn-sm px-3 d-flex align-items-center">
                    <i class="fas fa-edit me-2"></i>
                    Edit Subscription
                </button>

                <!-- Create Button - Primary CTA -->
                <a href="#" class="btn btn-theme btn-sm px-3 d-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    <i class="fas fa-plus-circle me-2"></i>
                    Create New
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
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header text-white" style="background-color: #260950">
                    <h5 class="mb-0">
                        <i class="fas fa-list-alt me-2"></i>
                        Subscription Packages
                    </h5>
                    <p class="mb-0"><em>Manage all subscription packages and their details</em></p>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover dataTable align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th width="40px" class="text-center">
                                        {{-- <input type="checkbox" id="selectAll"> --}}
                                    </th>
                                    <th width="60px">#</th>
                                    <th>Package Type</th>
                                    <th>Package Name</th>
                                    <th>Billing Cycle</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Renewal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $item)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="subscription-checkbox" value="{{ $item->id }}">
                                        </td>
                                        <td class="fw-semibold">{{ $loop->iteration }}</td>
                                        <td>
                                            <span style="color: #260950">{{ $item->packageType }}</span>
                                        </td>
                                        <td class="fw-semibold">{{ $item->packageName }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark">{{ $item->billingCycle }}</span>
                                        </td>
                                        <td class="text-truncate" style="max-width: 200px;" title="{{ $item->description }}">
                                            {{ $item->description }}
                                        </td>
                                        <td class="fw-bold text-success">${{ number_format($item->price, 2) }}</td>
                                        <td>
                                            @if ($item->isRenewal == 'on')
                                                <span class="badge bg-success rounded-pill">Yes</span>
                                            @else
                                                <span class="badge bg-secondary rounded-pill">No</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <div class="card-footer bg-light">
                    <div class="d-flex ">
                        <div class="text-muted small">
                            Showing {{ $subscriptions->count() }} entries
                        </div>
                        <!-- Pagination would go here -->
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModal">Create Subscription</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('subscription.store') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="card border-0 shadow-sm">
                            <div class="card-header text-white" style="background-color: #260950">
                                <h5 class="mb-0">
                                    <i class="fas fa-plus-circle me-2"></i>
                                    Create New Subscription Package
                                </h5>
                            </div>

                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Package Type -->
                                    <div class="col-md-6 mb-3">
                                        <label for="PackageType" class="form-label fw-semibold">
                                            Package Type <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select @error('packageType') is-invalid @enderror"
                                            name="packageType" id="PackageType" required
                                            aria-describedby="packageTypeFeedback">
                                            <option value="" disabled {{ old('packageType') ? '' : 'selected' }}>Select
                                                Package Type</option>
                                            <option value="TRACKER" @selected(old('packageType') == 'TRACKER')>TRACKER
                                            </option>
                                            <option value="OFFERED" @selected(old('packageType') == 'OFFERED')>OFFERED
                                            </option>
                                        </select>

                                        @error('packageType')
                                            <div id="packageTypeFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Package Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="PackageName" class="form-label fw-semibold">
                                            Package Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('packageName') is-invalid @enderror"
                                            name="packageName" id="PackageName" value="{{ old('packageName') }}" required
                                            aria-describedby="packageNameFeedback">
                                        @error('packageName')
                                            <div id="packageNameFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Billing Cycle -->
                                    <div class="col-md-6 mb-3">
                                        <label for="BillingCycle" class="form-label fw-semibold">
                                            Billing Cycle <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select @error('billingCycle') is-invalid @enderror"
                                            name="billingCycle" id="BillingCycle" required
                                            aria-describedby="billingCycleFeedback">
                                            <option value="" hidden {{ old('billingCycle') ? '' : 'selected' }}>Select
                                                Billing Cycle</option>
                                            @foreach([3, 7, 30, 60, 90, 120, 150, 180, 210, 240, 270, 300, 330, 365, 730] as $day)
                                                <option value="{{ $day }} days" @selected(old('billingCycle') == "$day days")>
                                                    {{ $day }} days
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('billingCycle')
                                            <div id="billingCycleFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <!-- Price -->
                                    <div class="col-md-6">
                                        <label for="Price" class="form-label fw-semibold">Price <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">₹</span>
                                            <input type="text" name="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price') }}">
                                        </div>
                                        @error('price')
                                            <em class="text-danger">{{ $message }}</em>
                                        @enderror
                                    </div>

                                    <!-- Description -->
                                    <div class="col-12 mb-3">
                                        <label for="Description" class="form-label fw-semibold">
                                            Description
                                        </label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                            name="description" id="Description" rows="3"
                                            aria-describedby="descriptionFeedback">{{ old('description') }}</textarea>

                                        @error('description')
                                            <div id="descriptionFeedback" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <!-- Renewal Switch -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Renewal</label>
                                        <div class="form-check form-switch px-5">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                name="renewalcheckbox" id="renewalSwitch">
                                            <label class="form-check-label" for="renewalSwitch">Enable automatic
                                                renewal</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-light border-0">
                                <div class="d-flex justify-content-between">
                                    <button type="reset" class="btn btn-outline-secondary px-4">
                                        <i class="fas fa-eraser me-2"></i> Reset
                                    </button>
                                    <button type="submit" class="btn px-4" style="background-color: #260950">
                                        <i class="fas fa-save me-2"></i> Save Package
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#editSubscriptionBtn').on('click', function () {
            // Get all selected checkboxes
            const selected = $('.subscription-checkbox:checked');

            if (selected.length === 0) {
                alert('Please select a subscription to edit.');
            } else if (selected.length > 1) {
                alert('Please select only one subscription to edit at a time.');
            } else {
                const subscriptionId = selected.val();
                // Redirect to edit route (you can open a modal instead if preferred)
                window.location.href = `/manufacturer/subscriptions/edit/${subscriptionId}`;
            }
        });
    </script>
@endsection