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
                    <i class="fas fa-cubes me-2 text-primary"></i>Model No Management
                </h5>
                <p class="text-muted mb-0">
                    <i class="fas fa-info-circle me-1"></i>It shows the list of models number types and their details
                </p>
            </div>
            <table class="table table-bordered table-striped text-capitalize dataTable">
                <thead style="background-color: #260950;color:#fff">
                    <th>Si. no.</th>
                    <th>Element</th>
                    <th>Element type </th>
                    <th>Model no.</th>
                    <th>Voltage</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($modelNo as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->elements->plucK('name')->first() }}</td>
                            <td>{{ $item->type->pluck('type')->first()}}</td>
                            <td>{{ $item->model_no }}</td>
                            <td>{{ $item->voltage }}</td>
                            <td>
                                <form action="{{ route('model_no.delete', $id = $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0);" class="btn" style="color: red"
                                        onclick="if(confirm('Are you sure you want to delete this item?')) { this.closest('form').submit(); }">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </form>

                                <a type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#editmodelNoModal{{ $loop->iteration }}"><i
                                        class="fa-pen-to-square fa-solid"></i></a>
                            </td>
                        </tr>
                        <!--edit model type  Modal -->
                        <div class="modal fade" id="editmodelNoModal{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title fs-5" id="exampleModalLabel">Edit Device Model Number</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('model_no.update', $modelId = $item->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="element" value="{{ $item->element_id }}">
                                            <input type="hidden" name="element_type" value="{{ $item->element_id }}">

                                            <div class="mb-2">
                                                <label for="" class="form-label">Model No</label>
                                                <input type="text" class="form-control form-control-sm" name="model_no"
                                                    value="{{ $item->model_no }}">
                                                @error('model_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="form-label">Voltage</label>
                                                <input type="text" class="form-control form-control-sm" name="voltage"
                                                    value="{{ $item->voltage }}">
                                                @error('voltage')
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
@endsection
