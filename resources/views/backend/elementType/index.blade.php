@extends($layout)
@section('content')
    @include('subnav.element');

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

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0">
                    <i class="fas fa-cubes me-2 text-primary"></i>Element Type Management
                </h5>
                <p class="text-muted mb-0">
                    <i class="fas fa-info-circle me-1"></i>List of all elements and their details
                </p>
            </div>
            <table class="table table-bordered dataTable">
                <thead class="text-white" style="background-color: #260950">
                    <tr>
                        <th>Si. No.</th>
                        <th>Element</th>
                        <th>Type</th>
                        <th>SIM Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($elementType as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->elements->pluck('name')->first() }}</td>
                            <td>{{ $item->type }}</td>
                            <td>
                                @if ($item->sim_count == null)

                                    <span class="p-2" style="background-color: #260950;color:#fff;border-radius:50px"> {{"Not Required"}}</span>
                                @else
                                    {{$item->sim_count}}
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $loop->iteration }}">
                                    <i class="fa-pen-to-square fa-solid"></i>
                                </button>
                                <form action="{{ route('element.type.delete', $elementTypeId = $item->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this item?');"><i
                                            class="fa-solid fa-trash" style="color:#fff"></i></button>
                                </form>
                            </td>
                        </tr>
                        <!--edit element type  -->
                        <div class="modal fade" id="editModal{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Element Type</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('element.type.update', $item->id) }}" method="post">
                                            @csrf
                                            @method('PUT')

                                            <!-- Select Element -->
                                            <div class="my-2">
                                                <label for="element" class="form-label">Select Element</label>
                                                <input type="text" name="elements" id="elementSelect{{ $loop->iteration }}"
                                                    class="form-control form-control-sm"
                                                    value="{{ $item->elements->pluck('name')->first() }}" readonly>
                                                <input type="hidden" name="element" id="elementSelect{{ $loop->iteration }}"
                                                    class="form-control form-control-sm"
                                                    value="{{ $item->elements->pluck('id')->first() }}" readonly>
                                                @error('element')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- SIM Count (only show if it's required) -->
                                            <div class="my-2 sim-field{{ $loop->iteration }}" style="display: none;">
                                                <label for="no_of_sim" class="form-label">No. of SIM</label>
                                                <input type="number" id="noOfSim{{ $loop->iteration }}"
                                                    class="form-control form-control-sm" name="no_of_sim"
                                                    value="{{ $item->sim_count ?? '' }}">
                                            </div>

                                            <!-- Type Field -->
                                            <div class="mb-2">
                                                <label for="type" class="form-label">Type</label>
                                                <input type="text" class="form-control form-control-sm" name="type"
                                                    value="{{ $item->type }}" placeholder="Enter element type">
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <button type="submit" class="me-2 text-white btn btn-sm"
                                                style="background-color: #260950">Submit</button>
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

    <script>
        $(document).ready(function () {
            @foreach ($elementType as $item)
                let elementSelect{{ $loop->iteration }} = $("#elementSelect{{ $loop->iteration }}");
                let simField{{ $loop->iteration }} = $(".sim-field{{ $loop->iteration }}");
                let noOfSim{{ $loop->iteration }} = $("#noOfSim{{ $loop->iteration }}");

                // Show SIM field if a valid SIM count exists
                if (noOfSim{{ $loop->iteration }}.val() !== "") {
                    simField{{ $loop->iteration }}.show();
                }

                // Handle element change event
                elementSelect{{ $loop->iteration }}.on("change", function () {
                    let selectedOption = $(this).find(":selected");
                    let simCount = selectedOption.data("sim-count");

                    if (simCount && simCount !== 0) {
                        noOfSim{{ $loop->iteration }}.val(simCount);
                        simField{{ $loop->iteration }}.show();
                    } else {
                        noOfSim{{ $loop->iteration }}.val("");
                        simField{{ $loop->iteration }}.hide();
                    }
                });
            @endforeach
        });
    </script>
@endsection