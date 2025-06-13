@extends('layouts.wlp')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-2">Assign Elements</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <a href="" class="btn btn-sm btn-theme" data-bs-toggle="modal" data-bs-target="#assignModal">
                    Assign Elements
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
        {{-- {{auth('wlp')->user()->id}} --}}
        <h5 class="text-capitalize"><em>It shows the list of assigned elements by the Admin</em></h5>
        <div class="col-md-12">
            <table class="table table-bordered table-striped dataTable">
                <thead class="text-white" style="background-color: #260950">

                    <tr>
                        <th>Si. No.</th>
                        <th>Logo</th>
                        <th>Element Name</th>
                        <th>Name <small>(Manufacturer)</small> </th>
                        <th>Businees Name <small>(Manufacturer)</small></th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($assignedEleement as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/uploads/' . $item->mfg->pluck('logo')->first()) }}" alt="Logo"
                                style="width:50px;height:50px;"></td>
                            <td>{{ $item->element->pluck('name')->first() }}</td>
                            <td>
                               {{$item->mfg->pluck('name')->first()}} 
                            </td>
                            <td>{{$item->mfg->pluck('businees_name')->first()}} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="assignModal">Assign Elements</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('assigneElements.mfg.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label for="">Select Elements:</label>
                                    <select id="second" name="element[]"
                                        class="chosen-select form-control form-control-sm" multiple>

                                        @foreach ($element as $item)
                                            <option value="{{ $item->element_id }}">
                                                {{ $item->element->pluck('name')->first() }}
                                               
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('element')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="">Select Manufacturer:</label>
                                    <select name="manufacturer" class="form-select form-control-sm">
                                        <option selected @disabled(true)>Please select manufacturer</option>
                                        @foreach ($mfg as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('admin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn text-white" style="background-color:#260950">
                            Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
