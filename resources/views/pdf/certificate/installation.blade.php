
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Certificate - Department Copy</title>
    <style>
        @page {
            size: A4;
            margin: 5mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10px;
            /* Reduced font size */
        }

        .container {
            width: 100%;
            display: table;
            table-layout: fixed;
        }

        .column {
            display: table-cell;
            width: 48%;
            padding: 5px;
            vertical-align: top;
        }

        .column h2 {
            font-size: 16px;
            /* Reduced font size */
            margin-bottom: 5px;
        }

        .column p {
            margin: 5px 0;
        }

        .bordered {
            border: 1px solid black;
            border-radius: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .vehicle-details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .signature {
            width: 100%;
            border-collapse: collapse;
            margin-top: 200px;
            text-align: center;
        }

        .signature th,
        .vehicle-details td {
            padding: 6px;
        }

        /* Prevent content from breaking between pages */
        .container,
        .bordered,
        .vehicle-details,
        .signature {
            page-break-inside: avoid;
        }
        table,th,td,thead{
                    border:none;
        }
        
    </style>
</head>

<body>
    <div class="container">
        <div class="column">
            <h1><strong style="border-bottom: 1px solid black">Installation Certificate</strong></h1>
            <h2>{{ ucfirst($type) == 'Customer_copy' ? 'Customer Copy' : 'Department Copy'}}</h2>
        </div>
        <div class="column" style="text-align:right">
            @php
                $mfg = auth('manufacturer')->user();
            @endphp
            <!-- Use the full URL path for the image -->
            <img src="{{ public_path('storage/uploads/' . $mfg->logo) }}" class="img-fluid"
                style="max-width: 300px;max-height:auto">
            <h4 style="color:gray">An ISO 9001:2015 & NABCB Certified Company</h4>
        </div>
    </div>
    <div style="text-align: right">
        <p>{{ date('d-m-Y') }}</p>
    </div>
    <div>
        <p>
            To, <br>
            The R.T.O / J.R.T.O <br>
            <strong>{{$rto}}</strong>
            Odisha
        </p>
        <p>
            This is to certify that the VLTD (Vehicle Location Tracking System) fitted on the below detailed vehicle,
            is approved by the ICAT vide TAC No. {{$tacNo}} dated: {{ date('d-m-Y', strtotime($mapped_date)) }}
            . During installation, it was
            thoroughly
            tested with all functionality as per AIS140 standard, and the VLTD device is working properly. Unless the
            VLTD device is not receiving proper GSM/GPS signals or is tampered with by unauthorized
            individuals/technicians.
        </p>
    </div>

    <div class="bordered">
        {{-- <h4 style="text-align: center">Vehicle Details</h4> --}}
        <table class="vehicle-details" cellspacing="0" cellpadding="8">
            <thead>
                <tr>
                    <th><span style="border-bottom:1px solid black">Vehical Owner Details</span></th>
                    <th><span style="border-bottom:1px solid black">Vehicle Details</span><th>
                </tr>
            <tbody>
                <tr>
                    <td>Name <br><strong>{{ $customerName }}</strong></td>
                    <td>Vehicle No <br><strong>{{ $vehicalNo }}</strong></td>
                    <td>Manufacture Year <br><strong>{{ $vehicalModel }}</strong></td>
                    <td rowspan="4" style="text-align: center; vertical-align: middle;">
                        <img src="{{ $qrCode }}" alt="QR Code" style="width: 100px; height: auto;">
                    </td>
                </tr>
                <tr>
                    <td>Mobile No. <br><strong>{{ $CustomerMobile }}</strong></td>
                    <td>Chassis No. <br><strong>{{ $chesisNo }}</strong></td>
                    <td>Engine No. <br><strong>{{ $engineNo }}</strong></td>
                </tr>
                <tr>
                    <td style="width: 250px; word-wrap: break-word;padding-left:3px;padding-right:3px">Address <br><strong">{{ $customerAddress }}</strong></td>
                    <td>Vehicle Make & Model <br><strong>{{ $vehicalMake }}</strong></td>
                    <td>State <br><strong>{{ $state }}</strong></td>
                </tr>
                <tr>
                    <td>Email ID <br><strong>{{ $customerEmailId }}</strong></td>
                    <td></td>
                    <td>RTO Code <br><strong>{{ $rto }}</strong></td>
                </tr>
            </tbody>
        </table>
        
    </div>

    <div class="bordered">
        <h4><span style="border-bottom:1px solid black;margin-left:3px">VLTD details: Manufactured by : {{ $mfg->businees_name }}</h4>
        <table class="vehicle-details">
            <tr>
                <td><span>Model <br><strong>{{$deviceModel}}</strong></span></td>
                <td><span>Type / Tac No <br> <strong>{{$tacNo}}</strong></span></td>
                <td><span>Invoice No <br> <strong>{{$invoiceNo}}</strong></span></td>
            </tr>
            <tr>
                <td><span>IMEI No <br><strong>{{$IMEINO}}</strong></span></td>
                <td><span>Installation Date <br><strong>{{$installationDate}}</strong> </span></td>
                <td><span>Invoice Date <br><strong>{{$installationDate}}</strong></span></td>
            </tr>
            @foreach ($sim as $simData)
                @if ($loop->iteration == 1)
                    <tr>
                        <td>ICCID No <br> <strong>{{$simData->ICCIDNo}}</strong></td>
                        <td>Recalibration Date <br> <strong>{{$simData->validity}}</strong> </td>
                        <td>Primary SIM NO <br> <strong>{{$simData->simNo}}</strong> </td>
                    </tr>
                @else
                    <tr>
                        <td>NO. Of SOS/Panic Button <br> <strong>{{$no_of_panic_buttons}}</strong></td>
                        <td></td>
                        <td>Secondary SIM NO <br><strong>{{$simData->simNo}}</strong></td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>

    <h2> VALID FOR THE STATE OF ODISHA </h2>
    <table class="vehicle-details">
        <tbody >
            <tr >
                <td><strong>{{$mfg->businees_name}}</strong> </td>
                <td>Vehicle Location Tracker (VLT) Serial No : <strong>{{$serialNo}}<strong></td>
            </tr>
            <tr>
            <td>Installation Date : <strong>{{ date('d-m-Y', strtotime($installationDate)) }}</strong></td>
            <td>Renewal Due Date : <strong>{{ date('d-m-Y', strtotime($installationDate . ' +' . $package->billingCycle)) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <table class="signature">
        <tr>
            <td> Dealers seal & Signature </td>
            <td> Customer Signature </td>
            <td> Authorised Signature </td>
        </tr>
    </table>

    <div class="bordered" style="text-align: center; background-color:#f0a207; color:#fff; text-transform: capitalize;padding-bottom:10px;padding-left:5px;padding-right:5px">
        <h2>{{ $mfg->businees_name }}</h2>
        <p>{{ $mfg->address }}, Toll Free 18008911545</p>
        <table width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="width: 50%;">Email: {{ $mfg->email }}</td>
                <td style="width: 50%; text-align: right;">Website: www.traxoindia.in</td>
            </tr>
        </table>
    </div>
</body>
</html>
