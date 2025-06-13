@extends($layout)

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #3b006c; /* Darker, richer primary */
            --primary-light: #5a009d;
            --secondary: #8c5de8; /* Slightly adjusted secondary */
            --success: #20b25d; /* Calmer success green */
            --info: #1aa6c0;
            --warning: #ffc107;
            --danger: #e74c3c;
            --light: #f8f9fa;
            --dark: #343a40;
            --gray: #6c757d;
        }

        body {
            background-color: #f5f7fb;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .dashboard-header {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-icon {
            width: 52px; /* Slightly larger icon */
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.7rem; /* Larger icon font size */
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2.2rem; /* Slightly larger value */
            font-weight: 700;
            margin: 0.5rem 0;
        }

        .stat-label {
            color: var(--gray);
            font-size: 0.95rem; /* Slightly larger label */
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .stat-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600; /* Bolder link */
            display: inline-flex;
            align-items: center;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .stat-link:hover {
            color: var(--secondary);
            transform: translateX(3px);
        }

        .stat-link i {
            transition: transform 0.2s ease;
        }

        .activity-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-striped-bg: rgba(0, 0, 0, 0.02);
        }

        .table thead {
            background-color: var(--primary); /* Apply primary color to header */
        }

        .table th {
            font-weight: 600;
            color: white; /* White text for header */
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom-width: 1px;
            padding: 1rem 0.75rem; /* Consistent padding */
        }

        .table td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
            border-color: rgba(0, 0, 0, 0.05);
        }

        .badge {
            font-weight: 600; /* Bolder badge text */
            padding: 6px 12px; /* Slightly larger padding */
            border-radius: 8px;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        .animate-delay-1 {
            animation-delay: 0.1s;
        }

        .animate-delay-2 {
            animation-delay: 0.2s;
        }

        .animate-delay-3 {
            animation-delay: 0.3s;
        }

        @media (max-width: 768px) {
            .stat-value {
                font-size: 1.8rem; /* Adjusted for smaller screens */
            }
        }
    </style>

    <div class="container-fluid py-3">
        <div class="dashboard-header animate__animated animate__fadeIn">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bold mb-1" style="color: var(--primary)">Dashboard Overview</h3>
                    <p class="text-muted mb-0">Welcome back! Here's what's happening with your system.</p>
                </div>
                {{-- <div class="d-flex">
                    <button class="btn btn-sm btn-outline-secondary me-2 d-flex align-items-center">
                        <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                    </button>
                    <button class="btn btn-sm btn-primary d-flex align-items-center">
                        <i class="bi bi-plus-circle me-1"></i> Add New
                    </button>
                </div> --}}
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-4 animate__animated animate__fadeInUp animate__faster animate-delay-1">
                <div class="stat-card card h-100">
                    <div class="card-body p-4">
                        <div class="stat-icon" style="background-color: rgba(108, 77, 218, 0.1); color: var(--primary)">
                            <i class="bi bi-person-fill-gear"></i>
                        </div>
                        <h5 class="stat-label">System Administrators</h5>
                        <h2 class="stat-value" style="color: var(--primary)">{{count($admins)}}</h2>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary bg-opacity-10 text-primary">+{{ $adminCountThisWeek }} this
                                week</span>
                            <a href="{{ route('admin.list') }}" class="stat-link">
                                View all <i class="bi bi-arrow-right-short ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 animate__animated animate__fadeInUp animate__faster animate-delay-2">
                <div class="stat-card card h-100">
                    <div class="card-body p-4">
                        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success)">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h5 class="stat-label">Total WLP/Reseller</h5>
                        <h2 class="stat-value" style="color: var(--success)">{{count($wlp)}}</h2>
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- <span class="badge bg-success bg-opacity-10 text-success">Active: 42</span> --}}
                            {{-- <a href="#" class="stat-link">
                                Manage <i class="bi bi-arrow-right-short ms-1"></i>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 animate__animated animate__fadeInUp animate__faster animate-delay-3">
                <div class="stat-card card h-100">
                    <div class="card-body p-4">
                        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning)">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h5 class="stat-label">Total Elements</h5>
                        <h2 class="stat-value" style="color: var(--warning)">{{count($elements)}}</h2>
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- <span class="badge bg-warning bg-opacity-10 text-warning">3 needs attention</span> --}}
                            <a href="{{ route('elements') }}" class="stat-link">
                                View details <i class="bi bi-arrow-right-short ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row animate__animated animate__fadeIn">
            <div class="col-md-12">
                <div class="activity-card card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0" style="color: var(--primary)">Recent Activity</h5>
                            {{-- <a href="#" class="text-primary small text-decoration-none">View all activity</a> --}}
                        </div>


                        <div class="table-responsive">
                            <table class="table dataTable align-middle">
                                <thead>
                                    <tr>
                                        <th>Event Type</th>
                                        <th>Description</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentActivities as $activity)
                                        <tr>
                                            <td class="d-flex align-items-center">{{ $activity->type }}
                                            </td>
                                            <td>{{ $activity->name }}
                                            </td>
                                            <td> {{ $activity->created_at->diffForHumans() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add animation class when page loads
        document.addEventListener('DOMContentLoaded', function () {
            // You can add any JavaScript interactions here if needed
        });
    </script>
@endsection