@extends('layouts.manufacturer')
@section('content')
    <!-- Bootstrap Icons CDN (add in your <head>) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <div class="container-fluid py-2">
        <h3 class="mb-4 fw-bold">Status Dashboard</h3>
        <div class="row row-cols-1 row-cols-md-4 g-4 text-center">

            <!-- Total Distributor -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-people-fill text-primary display-5 mb-2"></i>
                    <h6 class="fw-bold text-primary">Total Distributor</h6>
                    {{ count($distributors) }}
                </div>
            </div>

            <!-- Total Dealer -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-person-lines-fill text-info display-5 mb-2"></i>
                    <h6 class="fw-bold text-info">Total Dealer</h6>
                    @php
                        foreach ($distributors as $distributor) {
                            echo  count($distributor->dealers);
                            
                        }
                    @endphp
                </div>
            </div>

            <!-- Total Technician -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-tools text-success display-5 mb-2"></i>
                    <h6 class="fw-bold text-success">Total Technician</h6>
                    {{ count($allTechnicians) }}
                </div>
            </div>

            <!-- Total Device -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-cpu text-warning display-5 mb-2"></i>
                    <h6 class="fw-bold text-warning">Total Device</h6>
                    {{ $totalDevice }}
                    
                </div>
            </div>

            <!-- Total Device in Stock -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-box text-secondary display-5 mb-2"></i>
                    <h6 class="fw-bold text-secondary">Total Device in Stock</h6>
                    {{ $totalDeviceActive }}
                </div>
            </div>

            <!-- Total Allocated Devices -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-arrow-up-right-square text-dark display-5 mb-2"></i>
                    <h6 class="fw-bold text-dark">Total Allocated Devices</h6>
                    {{ $totalDeviceAllocated }}
                </div>
            </div>

            <!-- Today Allocated Devices -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-calendar-event text-primary display-5 mb-2"></i>
                    <h6 class="fw-bold text-primary">Today Allocated Devices</h6>
                    {{ $totalDeviceAllocatedToday }}
                </div>
            </div>

            <!-- Current Month Allocated Devices -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-calendar-range text-info display-5 mb-2"></i>
                    <h6 class="fw-bold text-info">This Month Allocated Devices</h6>
                    {{ $totalDeviceAllocatedThisMonth }}
                </div>
            </div>

            <!-- Total Map Devices -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-map text-success display-5 mb-2"></i>
                    <h6 class="fw-bold text-success">Total Map Devices</h6>
                    {{ $totalMapDevice }}
                </div>
            </div>

            <!-- Today Map Devices -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-calendar-plus text-warning display-5 mb-2"></i>
                    <h6 class="fw-bold text-warning">Today Map Devices</h6>
                    {{ $totalDeviceMapToday }}
                </div>
            </div>

            <!-- Current Month Map Devices -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-calendar-month text-secondary display-5 mb-2"></i>
                    <h6 class="fw-bold text-secondary">This Month Map Devices</h6>
                    {{ $totalDeviceMapThisMonth }}
                </div>
            </div>

            <!-- Total Renewals Devices -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-arrow-repeat text-dark display-5 mb-2"></i>
                    <h6 class="fw-bold text-dark">Total Renewal Devices</h6>
                    N/A
                </div>
            </div>

            <!-- Total Renew Devices -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-check-circle text-success display-5 mb-2"></i>
                    <h6 class="fw-bold text-success">Total Renewed Devices</h6>
                     N/A
                </div>
            </div>

            <!-- Upcoming Renew Devices -->
            <div class="col">
                <div class="card p-4 shadow-sm border-0">
                    <i class="bi bi-clock-history text-warning display-5 mb-2"></i>
                    <h6 class="fw-bold text-warning">Upcoming Renew Devices</h6>
                     N/A
                </div>
            </div>
        </div>
    </div>

@endsection