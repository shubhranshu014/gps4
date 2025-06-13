@extends($layout)

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm mb-4 border-0" style="border-radius: 12px;">
            <div class="card-header py-3 d-flex justify-content-between align-items-center"
                style="background: linear-gradient(135deg, #260950 0%, #4a1f96 100%);">
                <h4 class="mb-0 text-white">
                    <i class="fas fa-users-cog me-2"></i>Admin Management
                </h4>
                <a href="{{ route('create.admin') }}" class="btn btn-outline-light btn-sm" style="white-space: nowrap;">
                    <i class="fas fa-user-plus me-1"></i> Create Admin
                </a>
            </div>

            <div class="card-body">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>{{ Session::get('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="mb-4">
                    <p class="text-muted mb-0">
                        <i class="fas fa-info-circle me-2"></i>This table shows the list of all registered admins and their
                        details
                    </p>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle dataTable">
                        <thead class="text-white" style="background: linear-gradient(135deg, #260950 0%, #4a1f96 100%);">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Logo</th>
                                <th scope="col">Business Name</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Password</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <div class="avatar avatar-md">
                                            <img src="{{ asset('storage/uploads/' . $item->logo) }}" alt="Logo"
                                                style="width:50px;height:50px;">
                                        </div>
                                    </td>
                                    <td>{{ $item->business_name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="mailto:{{ $item->email }}" class="text-primary">
                                            {{ $item->email }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $item->contact_no }}" class="text-primary">
                                            {{ $item->contact_no }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="password" class="form-control form-control-sm"
                                                value="{{ $item->password_text }}" id="password_{{ $item->id }}" readonly
                                                style="width: 100px;">
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="togglePassword('password_{{ $item->id }}')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{route('admin.edit', $id = $item->id)}}"
                                                class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('admin.delete', $id = $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this admin?');">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <style>
        .avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 20px;
            padding: 5px 15px;
            border: 1px solid #ddd;
        }

        .btn-circle {
            width: 32px;
            height: 32px;
            padding: 0;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(38, 9, 80, 0.05);
        }
    </style>

    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>

@endsection