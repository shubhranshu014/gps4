<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitment Certificate - Department Copy</title>
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
            margin-top: 30px;
            text-align: center;
        }

        .signature,
        .vehicle-details {
            padding: 6px;
            /* Reduced padding */
            border: none;
        }

        tr,
        td {
            border: none;
            padding: 5px
        }

        .vehicle-details th {
            background-color: #f2f2f2;
        }

        /* Prevent content from breaking between pages */
        .container,
        .bordered,
        .vehicle-details,
        .signature {
            page-break-inside: avoid;
        }
        .header {
            background-color: #FFD700;
            padding: 5px;
            text-align: center;
            border-radius: 8px;
            border: 1px solid #ccc;
            position: relative;
        }
        .header h1 {
            margin: 0;
        }
        .header p {
            margin: 5px 0;
        }
        .contact-info {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }
        .contact-info a {
            color: #000;
            text-decoration: none;
            font-weight: bold;
        }
        .logos {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 10px;
        }
        .logos img {
            width: 60px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="column">
            <h1><strong style="border-bottom: 1px solid ">Fitment Certificate</strong></h1>
            <h2>{{ ucfirst($type) == 'Customer_copy' ? 'Customer Copy' : 'Department Copy'}}</h2>
        </div>
        <div class="column" style="text-align:right">
            @php
                $mfg = auth('manufacturer')->user();
            @endphp
            <!-- Use the full URL path for the image -->
            <img src="{{ public_path('storage/uploads/' . $mfg->logo) }}" class="img-fluid"
                style="width: auto;height:auto">
            <h4 style="color:gray">An ISO 9001:2015 & NABCB Certified Company</h4>
        </div>
    </div>
    <div class="container">
        <div class="column">
            <p>Fitment Certificate No: TRAXOVLTD111100000</p>
        </div>
        <div class="column">
            <div style="text-align: right">
                <p>{{ date('d-m-Y',strtotime($installationDate)) }}</p>
            </div>
        </div>
    </div>


    <div class="bordered">
        <div class="container">
            <div class="column">
                <h2 style="padding:5px">Vehicle Details</h2>
                <table class="vehicle-details">

                    <tr>
                        <td>Name <br> <strong>{{$customerName}}</strong></td>
                        <td>Vehicle No <br> <strong>{{$vehicalNo}}</strong></td>
                        <td>Manufacture Year <br><strong>{{$vehicalMake}}</strong></td>
                    </tr>
                    <tr>
                        <td>MObile No. <br><strong>{{$CustomerMobile}}</strong></td>
                        <td>Chassis No. <br><strong>{{$chesisNo}}</strong></td>
                        <td>Engine No. <br><strong>{{$engineNo}}</strong></td>
                    </tr>
                    <tr>
                        <td>Address <br><strong>{{$customerAddress}}</strong></td>
                        <td>Vehical Model <br><strong>{{$vehicalMake}}</strong></td>
                    </tr>
                    <tr>
                        <td>Email Id <br><strong>{{$customerEmailId}}</strong></td>
                        <td>Vehical Make <br><strong>{{$vehicalModel}}</strong></td>
                        <td>RTO Code <br><strong>{{$rto}}</strong></td>
                    </tr>
                </table>
            </div>
            <div class="column" style="width: 20%!important">
                <div class="qr-code" style="padding-top: 50px">
                    <img src="{{ $qrCode }}" alt="QR Code">
                </div>
            </div>
        </div>
    </div>

    <div class="bordered">
        <h2 style="padding:5px">Vehical Owner Details</h2>
        <table class="vehicle-details">
            <tr>
                <td><span>Name</span></td>
                <td><span>Mobile</span></td>
                <td><span>Address</span></td>
                <td><span>Email Id</span></td>
            </tr>
            <tr>
                <td><span>{{$customerName}}</span></td>
                <td><span>{{$CustomerMobile}}</span></td>
                <td><span>{{$customerAddress}}</span></td>
                <td><span>{{$customerEmailId}}</span></td>
            </tr>
        </table>
    </div>
    <div class="bordered">
        <h4 style="text-align: center;text-tranform: capitalize">VLTD details: Manufactured by : {{$mfg->businees_name}}
        </h4>
        <table class="vehicle-details">
            <tr>
                <td><span>Model <br>{{$deviceModel}}</span></td>
                <td><span>Type / Tac No <br>{{$tacNo}}</span></td>
                <td><span>Invoice No <br>{{$invoiceNo}}</span></td>
            </tr>
            <tr>
                <td><span>IMEI No <br>{{$IMEINO}}</span></td>
                <td><span>Installation Date <br>{{date('d-m-Y',strtotime($installationDate))}}</span></td>
                <td><span>Invoice Date <br>{{date('d-m-Y',strtotime($installationDate))}}</span></td>
            </tr>
            @foreach ($sim as $simData)
                @if ($loop->iteration == 1)
                    <tr>
                        <td>ICCID No <br> <strong>{{$simData->ICCIDNo}}</strong></td>
                        <td>Recalibration Date <br> <strong>{{date('m-d-Y',strtotime($simData->validity))}}</strong> </td>
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
    {{-- <div class="bordered"> --}}
        <table class="vehicle-details">
            <tr>
                <td><span>Dealer /Rfc / Installer </span></td>
                <td><span>Mobile Number</span></td>
                <td><span>Address</span></td>
                <td>Stamp & Sign </td>
            </tr>
            <tr>
                <td><span>{{$dealer->pluck('business_name')->first()}}</span></td>
                <td><span>{{$dealer->pluck('mobile')->first()}}</span></td>
                <td><span>{{$dealer->pluck('address')->first()}}</span></td>
                <td> </td>
            </tr>
        </table>
        {{--
    </div> --}}
    <p>This is to acknowledge confirm that we have got our vehicle bearing registration no {{$vehicalNo}} . VLT Device
        manufactured by {{$mfg->businees_name}} bearing Sr. No. {{$serialNo}}. We have checked the performance of the vehicle after
        fitment of the said VLT device the unit is sealed and functioning as per norms laid out in AIS-140.We have
        satisfied with the performance of the unit in all respects. We undertake not to raise any dispute or any legal
        claims against {{$mfg->businees_name}} in the event that the above mentioned seals at found broken/tampered. </p>
    <h2 style="text-align: center">VLTD INSTALLATION IMAGES</h2>
    <div class="container">
        
        <div class="column">
            <div class="" style="margin:2px;text-align:center">
                <img src="{{ public_path('storage/uploads/' . $vehicalImage) }}" class="img-fluid"
                    style="height:100px;width:176px;border-radius:15px">
                    <strong>Vehical Image</strong>
            </div>
        </div>
        <div class="column">
            <div class="" style="margin:2px;text-align:center">
                <img src="{{ public_path('storage/uploads/' . $rcImage) }}" class="img-fluid"
                    style="height:100px;width:176px;border-radius:15px">
                    <strong>RC Image</strong>
            </div>
        </div>
        <div class="column">
            <div class="" style="margin:2px;text-align:center">
                <img src="{{ public_path('storage/uploads/' . $deviceImage) }}" class="img-fluid"
                    style="height:100px;width:176px;border-radius:15px">
                    <strong>Device Image</strong>
            </div>
        </div>
        <div class="column">
            <div class="" style="margin:2px;text-align:center">
                <img src="{{ public_path('storage/uploads/' . $panicButton) }}" class="img-fluid"
                    style="height:100px;width:176px;border-radius:15px">
                    <strong>SOS Button Image</strong>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="logos">
            <img src="{{ public_path('storage/Picture1.jpg') }}">
        </div>
        <h2>{{ $mfg->businees_name }}</h2>
        <p>{{ $mfg->address }}, Toll Free {{$mfg->tollfreeNo}}</p>
        <div class="contact-info">
            <a href="mailto:info@traxo.in">Email: {{$mfg->email}}</a>
            <a href="http://www.traxoindia.in">Website: www.traxoindia.in</a>
        </div>
    </div>
    
</body>

</html>
