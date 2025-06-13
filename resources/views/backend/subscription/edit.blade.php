@extends('layouts.manufacturer')
@section('content')
    <div class="row align-items-center mb-3" style="background-color: #260950;">
        <!-- Use align-items-center here -->
        <div class="col-md-4">
            <h4 class="card-title text-white px-2 py-3">Subscriptions Edit</h4>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-md-end justify-content-sm-center pe-2">
                <div class="mx-2">
                    <a href="{{route('subscriptions')}}" id="editSubscriptionBtn" class="btn btn-warning btn-sm ms-2">
                        <i class="fas fa-list-alt"></i>
                        Subscription List
                    </a>
                </div>
            </div>
        </div>
    </div>


    <form method="post" action="{{ route('subscriptions.update',['id'=>$subscription->id]) }}">
        @csrf
        <div class="my-3 mx-3">
            <div class="row">
                {{-- <div class="col-md-6">
                    <label for="" class="form-label">Parent</label>
                    <input class="form-control" name="parent" value="{{ $data->businees_name }}" readonly>
                    <input type="hidden" name="parentId" value="{{ $data->id }}">

                    <Select class="form-select form-select-sm" name="Parentid" id="Parentid">
                        <option disabled selected>Select Parent</option>
                        <option value="">Mfg 1</option>
                        <option value="">Mfg 2</option>

                    </Select>
                </div> --}}
                <div class="col-md-6">
                    <label for="" class="form-label">Package Type</label>
                    <Select class="form-select form-select-sm" name="packageType" id="PackageType">
                        <option disabled selected>Select Package Type</option>
                        <option value="TRACKER" @selected($subscription->packageType == 'TRACKER')>TRACKER</option>
                        <option value="OFFERED" @selected($subscription->packageType == 'OFFERED')>OFFERED</option>
                    </Select>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Package Name</label>
                    <input type="text" class="form-control form-control-sm" name="packageName"
                        value="{{$subscription->packageName}}" id="PackageName">
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Billing Cycle</label>
                    <Select class="form-select form-select-sm" name="billingCycle" id="BillingCycle">
                        <option value="" hidden>Select Billing Cycle</option>
                        <option value="3 days" @selected($subscription->billingCycle == '3 days')>3 days</option>
                        <option value="7 days" @selected($subscription->billingCycle == '7 days')>7 days</option>
                        <option value="30 days" @selected($subscription->billingCycle == '30 days')>30 days</option>
                        <option value="60 days" @selected($subscription->billingCycle == '60 days')>60 days</option>
                        <option value="90 days" @selected($subscription->billingCycle == '90 days')>90 days</option>
                        <option value="120 days" @selected($subscription->billingCycle == '120 days')>120 days</option>
                        <option value="150 days" @selected($subscription->billingCycle == '150 days')>150 days</option>
                        <option value="180 days" @selected($subscription->billingCycle == '180 days')>180 days</option>
                        <option value="210 days" @selected($subscription->billingCycle == '210 days')>210 days</option>
                        <option value="240 days" @selected($subscription->billingCycle == '240 days')>240 days</option>
                        <option value="270 days" @selected($subscription->billingCycle == '270 days')>270 days</option>
                        <option value="300 days" @selected($subscription->billingCycle == '300 days')>300 days</option>
                        <option value="330 days" @selected($subscription->billingCycle == '330 days')>330 days</option>
                        <option value="365 days" @selected($subscription->billingCycle == '365 days')>365 days</option>
                        <option value="730 days" @selected($subscription->billingCycle == '730 days')>730 days</option>
                    </Select>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-6">
                    <label for="" class="form-label">Description</label>
                    <input type="text" class="form-control form-control-sm" name="description"
                        value="{{$subscription->description}}" id="Description">
                </div>
                <div class="col-md-6">
                    <label for="" class="form-label">Price</label>
                    <input type="text" class="form-control form-control-sm" name="price" value="{{$subscription->price}}"
                        id="Price">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label d-block">Renewal Status</label>
                    <div class="form-check form-switch d-flex align-items-center">
                        <input class="form-check" type="checkbox" role="switch" name="is_renewal" id="renewalSwitch"
                            value="1" {{ $subscription->isRenewal ? 'checked' : '' }}>
                        <span class="ms-2">Yes</span>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn" style="background-color: #260950;color:#fff">Save</button>
    </form>

@endsection