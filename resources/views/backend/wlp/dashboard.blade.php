@extends('layouts.wlp')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --primary: #260950;
            --primary-light: #3a1b8a;
            --secondary: #6c4dda;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
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
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin: 0.5rem 0;
        }

        .stat-label {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .stat-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            transition: color 0.2s ease;
        }

        .stat-link:hover {
            color: var(--secondary);
        }

        .stat-link i {
            transition: transform 0.2s ease;
        }

        .stat-link:hover i {
            transform: translateX(3px);
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

        .table th {
            font-weight: 600;
            color: var(--gray);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom-width: 1px;
        }

        .table td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
            border-color: rgba(0, 0, 0, 0.05);
        }

        .badge {
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 0.75rem;
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
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="container-fluid py-3">
        <!-- Header -->
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

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <!-- Total Admin -->
            <div class="col-md-4 animate__animated animate__fadeInUp animate__faster animate-delay-1">
                <div class="stat-card card h-100">
                    <div class="card-body p-4">
                        <div class="stat-icon" style="background-color: rgba(108, 77, 218, 0.1); color: var(--primary)">
                            <i class="bi bi-person-fill-gear"></i>
                        </div>
                        <h5 class="stat-label">System Manufacturer</h5>
                        <h2 class="stat-value" style="color: var(--primary)">{{$mfg}}</h2>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary bg-opacity-10 text-primary">+ {{ $mfgCountThisWeek }} this
                                week</span>
                            <a href="{{ route('manufacturers') }}" class="stat-link">
                                View all <i class="bi bi-arrow-right-short ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total WLP -->
            <div class="col-md-4 animate__animated animate__fadeInUp animate__faster animate-delay-2">
                <div class="stat-card card h-100">
                    <div class="card-body p-4">
                        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success)">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h5 class="stat-label">Assign Elements</h5>
                        <h2 class="stat-value" style="color: var(--success)"></h2>
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- <span class="badge bg-success bg-opacity-10 text-success">Active: 42</span> --}}
                            {{-- <a href="#" class="stat-link">
                                Manage <i class="bi bi-arrow-right-short ms-1"></i>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Elements -->
            <div class="col-md-4 animate__animated animate__fadeInUp animate__faster animate-delay-3">
                <div class="stat-card card h-100">
                    <div class="card-body p-4">
                        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning)">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h5 class="stat-label">Total Elements</h5>
                        <h2 class="stat-value" style="color: var(--warning)">{{$elements}}</h2>
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- <span class="badge bg-warning bg-opacity-10 text-warning">3 needs attention</span> --}}
                            <a href="{{ route('assignedElements.Wlp') }}" class="stat-link">
                                View details <i class="bi bi-arrow-right-short ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="card shadow-sm mb-4">
            <div class="card-header text-white" style="background-color: #260950">
                <strong>Recent Activity</strong>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="text-white" style="background-color: #260950;">
                            <tr>
                                <th>Type</th>
                                <th>Details</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentActivity as $activity)
                                <tr>
                                    <td>
                                        @if ($activity->type === 'manufacturer')
                                            <span class="badge bg-info">Manufacturer</span>
                                        @elseif ($activity->type === 'wlpelement')
                                            <span class="badge bg-success">WLP Element</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($activity->type === 'manufacturer')
                                            Name: <strong>{{ $activity->name ?? 'N/A' }}</strong>
                                        @elseif ($activity->type === 'wlpelement')
                                            Element ID: <strong>{{ $activity->element_id }}</strong>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $activity->created_at->format('d M Y, h:i A') }}
                                        <br>
                                        <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No recent activity found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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