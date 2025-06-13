@extends('layouts.wlp')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-2">Elements</h4>
        </div>
        <div class="col-md-8">
            {{-- <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
        <a href="{{ route('create.admin') }}" class="btn btn-sm text-white"
            style="border: 1px solid #fff;white-space: nowrap;">
            Create Admin
        </a>
    </div> --}}
        </div>
    </div>
    <div class="row">
        {{-- {{auth('wlp')->user()->id}} --}}
        <h5 class="text-capitalize"><em>It shows the list of assigned elements by the admin</em></h5>
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
@endsection
