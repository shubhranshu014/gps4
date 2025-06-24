@extends('layouts.technician')
@section('content')
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="py-2 container-fluid">
           <h3 class="mb-4 fw-bold">Status Dashboard</h3>
           <div class="text-center row row-cols-1 row-cols-md-4 g-4">
                 <!-- Total Map Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-success bi bi-map display-5"></i>
                              <h6 class="text-success fw-bold">Total Map Devices</h6>
                              {{ $totalMappedCount }}
                       </div>
                 </div>

                 <!-- Today Map Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-warning bi bi-calendar-plus display-5"></i>
                              <h6 class="text-warning fw-bold">Today Map Devices</h6>
                              {{ $todayMappedCount }}
                       </div>
                 </div>

                 <!-- Current Month Map Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-secondary bi bi-calendar-month display-5"></i>
                              <h6 class="text-secondary fw-bold">This Month Map Devices</h6>
                              {{ $monthMappedCount }}
                       </div>
                 </div>

                 <!-- Total Renewals Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-dark bi bi-arrow-repeat display-5"></i>
                              <h6 class="text-dark fw-bold">Total Renewal Devices</h6>
                              N/A
                       </div>
                 </div>

                 <!-- Total Renew Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-success bi bi-check-circle display-5"></i>
                              <h6 class="text-success fw-bold">Total Renewed Devices</h6>
                              N/A
                       </div>
                 </div>

                 <!-- Upcoming Renew Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-warning bi bi-clock-history display-5"></i>
                              <h6 class="text-warning fw-bold">Upcoming Renew Devices</h6>
                              N/A
                       </div>
                 </div>
           </div>
     </div>
@endsection