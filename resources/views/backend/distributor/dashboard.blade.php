@extends('layouts.distributor')
@section('content')
     <!-- Bootstrap Icons CDN (add in your <head>) -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

     <div class="py-2 container-fluid">
           <h3 class="mb-4 fw-bold">Status Dashboard</h3>
           <div class="text-center row row-cols-1 row-cols-md-4 g-4">
                 <!-- Total Dealer -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-info bi bi-person-lines-fill display-5"></i>
                              <h6 class="text-info fw-bold">Total Dealer</h6>
                              {{ $dealerCount }}
                       </div>
                 </div>

                 <!-- Total Technician -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-success bi bi-tools display-5"></i>
                              <h6 class="text-success fw-bold">Total Technician</h6>
                              {{ $technicianCount }}
                       </div>
                 </div>
                 <!-- Total Device in Stock -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-secondary bi bi-box display-5"></i>
                              <h6 class="text-secondary fw-bold">Total Device in Stock</h6>
                              {{ $totalDevice }}
                       </div>
                 </div>

                 <!-- Total Allocated Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="bi-arrow-up-right-square mb-2 text-dark bi display-5"></i>
                              <h6 class="text-dark fw-bold">Total Allocated Devices</h6>
                              {{ $totalDeviceAllocated }}
                       </div>
                 </div>

                 <!-- Today Allocated Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-primary bi bi-calendar-event display-5"></i>
                              <h6 class="text-primary fw-bold">Today Allocated Devices</h6>
                              {{ $totalDeviceAllocatedToday }}
                       </div>
                 </div>

                 <!-- Current Month Allocated Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-info bi bi-calendar-range display-5"></i>
                              <h6 class="text-info fw-bold">This Month Allocated Devices</h6>
                              {{ $totalDeviceAllocatedThisMonth }}
                       </div>
                 </div>

                 <!-- Total Map Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-success bi bi-map display-5"></i>
                              <h6 class="text-success fw-bold">Total Map Devices</h6>
                              {{ count($mapDevices) }}
                       </div>
                 </div>

                 <!-- Today Map Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-warning bi bi-calendar-plus display-5"></i>
                              <h6 class="text-warning fw-bold">Today Map Devices</h6>
                              {{ count($mapDevicesToday) }}
                       </div>
                 </div>

                 <!-- Current Month Map Devices -->
                 <div class="col">
                       <div class="shadow-sm p-4 border-0 card">
                              <i class="mb-2 text-secondary bi bi-calendar-month display-5"></i>
                              <h6 class="text-secondary fw-bold">This Month Map Devices</h6>
                              N/A
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