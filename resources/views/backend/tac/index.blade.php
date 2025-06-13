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
                    <i class="fas fa-cubes me-2 text-primary"></i>TAC No Management
                </h5>
                <p class="text-muted mb-0">
                    <i class="fas fa-info-circle me-1"></i>It shows the list of TAC number types and their details
                </p>
            </div>

            <table class="table table-bordered table-striped text-capitalize dataTable" id="partList">
                <thead style="background-color: #260950;color:#fff">
                    <th>Si. no.</th>
                    <th>Element</th>
                    <th>Element type </th>
                    <th>Model no.</th>
                    <th>Part no.</th>
                    <th>TAC no.</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($tac as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->elements->pluck('name')->first() }}</td>
                            <td>{{ $item->type->pluck('type')->first() }}</td>
                            <td>{{ $item->model->pluck('model_no')->first() }}</td>
                            <td>{{ $item->part->pluck('part_no')->first() }}</td>
                            <td>{{ $item->tacNo }}</td>
                            <td>
                                <form action="{{ route('tacNo.delete', $id = $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0);" class="btn" style="color: red"
                                        onclick="if(confirm('Are you sure you want to delete this item?')) { this.closest('form').submit(); }">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </form>
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#editTac{{$loop->iteration}}">
                                    <i class="fa-pen-to-square fa-solid"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="editTac{{$loop->iteration}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit TAC No</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('tacNo.update', $tacId = $item->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-2">
                                                <label for="" class="form-label">TAC NO</label>
                                                <input type="text" name="tacNo" class="form-control" value="{{$item->tacNo}}">
                                            </div>
                                            <button class="btn" type="submit"
                                                style="background-color: #260950;color:#fff">Submit</button>
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