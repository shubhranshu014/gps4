@extends($layout)
@section('content')
    <!-- Header Section with Icon -->
    <div class="row align-items-center mb-4 py-3 gx-2"
        style="background: linear-gradient(135deg, #260950 0%, #4a1b9d 100%); border-radius: 10px; box-shadow: 0 4px 20px rgba(38, 9, 80, 0.15);">
        <div class="col-md-6 d-flex align-items-center">
            {{-- <div class="icon-shape bg-white rounded-3 ">
                <i class="fas fa-puzzle-piece fa-lg text-purple" style="color: #260950;"></i>
            </div> --}}
            <div class="p-2 me-3">
                <h4 class="text-white mb-0"> Elements</h4>
                <p class="text-white-50 mb-0 small">Manage element assignments to WLP/Reseller</p>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <button class="btn btn-light-purple" data-bs-toggle="modal" data-bs-target="#assignModal">
                <i class="fas fa-plus-circle me-2"></i> Assign Elements
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="text-capitalize"><em>It shows the list of assigned elements by the super admin</em></h5>
            <div class="col-md-12">
                <table class="table table-bordered table-striped dataTable">
                    <thead class="text-white" style="background-color: #260950">

                        <tr>
                            <th>Si. No.</th>
                            <th>Element Name</th>
                            <th>VLTD</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($element as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->element->pluck('name')->first()}}</td>
                                <td>
                                    @if ($item->element->pluck('is_vltd')->first() == 0)
                                        <i class="fa-solid fa-square-check" style="color: green;font-size:25px"></i>
                                    @else
                                        <i class="fa-solid fa-square-xmark" style="color: #260950;font-size:25px"></i>
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