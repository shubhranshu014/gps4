<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warranty Certificate - Department Copy</title>
    <style>
        @page {
            size: A4;
            margin: 1mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 9px;
            /* Reduced font size */
        }

        .container {
            width: 100%;
            display: table;
            table-layout: fixed;
            padding-bottom: 2mm;
        }

        .column {
            display: table-cell;
            width: 48%;
            padding: 5px;
            vertical-align: top;
        }

        .column h2 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .column p {
            margin: 3px 0;
        }

        .bordered {
            border: 1px solid black;
            border-radius: 5px;
            margin-top: 3px;
            margin-bottom: 3px;
            padding: 5px;
        }

        .vehicle-details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .vehicle-details td,
        .vehicle-details th {
            padding: 3px;
            border: none;
        }

        .vehicle-details th {
            background-color: #f2f2f2;
        }

        /* Prevent content from breaking between pages */
        .container,
        .bordered,
        .vehicle-details {
            page-break-inside: avoid;
        }

        .container p {
            font-size: 8px;
        }

        .terms,
        .claims,
        .conditions,
        .repairs {
            font-size: 8px;
            line-height: 1.3;
        }

        h5,
        h4 {
            font-size: 10px;
            margin-bottom: 5px;
        }

        ul {
            font-size: 8px;
            margin-left: 15px;
        }

        /* Ensure image fits within the page */
        .img-fluid {
            width: 80px;
            height: 80px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="column">
            <h1><strong style="border-bottom: 1px solid">Warranty Certificate</strong></h1>
            <h2>{{ ucfirst($type) == 'Customer_copy' ? 'Customer Copy' : 'Department Copy'}}</h2>
        </div>
        <div class="column" style="text-align:right">
            @php
                $mfg = auth('manufacturer')->user();
            @endphp
            <!-- Use the full URL path for the image -->
            <img src="{{ public_path('storage/uploads/' . $mfg->logo) }}" class="img-fluid"
                style="width: auto;auto">
            <h4 style="color:gray">An ISO 9001:2015 & NABCB Certified Company</h4>
        </div>
    </div>
    <div class="container">
        <div class="column">
            <h4>Fitment Certificate No: <strong>TIA/000{{$invoiceNo}}<strong></h4>
        </div>
        <div class="column">
            <div style="text-align: right">
                <p>{{ date('d-m-Y',strtotime($installationDate)) }}</p>
            </div>
        </div>
    </div>
    <div class="bordered">
        <table class="vehicle-details">
            <tr>
                <th>Vehicle Owner Details</th>
                <th>Vehicle Details</th>
                <th>Vehical Manufacturing  Details</th>
            </tr>
            <tr>
                <td>Name <br>{{$customerName}}</td>
                <td>Vehicle No <br>{{$vehicalNo}}</td>
                <td>Manufacture Year <br>{{$vehicalModel}}</td>
            </tr>
            <tr>
                <td>Mobile No.<br>{{$CustomerMobile}}</td>
                <td>Chassis No. <br>{{$chesisNo}}</td>
                <td>Engine No. <br>{{$engineNo}}</td>
            </tr>
            <tr>
                <td style="width:300px;word-wrap: break-word">Address <br>{{$customerAddress}}</td>
                <td>Vehicle Make & Model<br>{{$vehicalMake}}</td>
                <td>State <br>{{$state}}</td>
            </tr>
            <tr>
                <td>Email Id <br>{{$customerEmailId}}</td>
                <td></td>
                <td>RTO Code <br>{{$rto}}</td>
            </tr>
        </table>
    </div>
    <div class="bordered">
        <h4 style="text-align: center;">VLTD details: Manufactured by: {{ $mfg->businees_name }}</h4>
        <table class="vehicle-details">
            <tr>
                <td>Model <br>{{$deviceModel}}</td>
                <td>Type / Tac No <br>{{$tacNo}}</td>
                <td>Invoice No <br>{{$invoiceNo}}</td>
            </tr>
            <tr>
                <td>IMEI No <br>{{$IMEINO}}</td>
                <td>Installation Date <br>{{$installationDate}}</td>
                <td>Invoice Date <br>{{$installationDate}}</td>
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
    <div class="bordered terms">
        <h5>TERMS for Warranty</h5>
        <p>{{ $mfg->businees_name }} guarantees the {{$model->pluck('model_no')->first()}} (applicable to all {{ $mfg->businees_name }} trackers unless stated
            separately) to conform to specifications at the time of manufacture. Warranty is valid for 24 months for the
            Tracker and accessories. You must inform {{ $mfg->businees_name }} immediately if the Tracker is defective.</p>
    </div>
    <div class="bordered claims">
        <h5>CLAIMS</h5>
        <p>For warranty claims, the device must be sent to {{$mfg->businees_name}} Office at {{$mfg->address}}, with customer details and proof of purchase. For devices fitted to vehicles, first drive to
            an authorized service center for analysis.</p>
    </div>
    <div class="bordered">
        <h5>WHAT IS NOT COVERED BY THE WARRANTY</h5>
        <p>Warranty is not covered for defects due to misuse, tampering, or unauthorized repairs. The following points
            are not covered:</p>
        <ul>
            <li>Defects due to abnormal usage or non-standard environments.</li>
            <li>Defects from misuse, accidents, or intentional damage.</li>
            <li>Improper testing or unauthorized modifications.</li>
            <li>Tamper seals broken by unauthorized persons.</li>
            <li>Excessive force or alterations to the device.</li>
            <li>Unauthorized disassembly or repairs.</li>
            <li>Exposure to unapproved environments or conditions.</li>
            <li>Accessories not manufactured by {{$mfg->businees_name}}.</li>
        </ul>
    </div>
    <div class="bordered conditions">
        <h5>CONDITIONS</h5>
        <p>The warranty does not apply if serial numbers are altered. {{$mfg->businees_name}} reserves the right to refuse warranty
            service if documentation is missing or incompatible. Repair may involve software flashing or part
            replacements. Replaced parts are warranted for the remainder of the original warranty period.</p>
    </div>
    <div class="bordered repairs">
        <h5>REPAIR and SERVICES for Out of Warranty</h5>
        <p>After warranty expiration, {{$mfg->business_name}} may offer repairs at a cost borne by the customer as specified by {{$mfg->businees_name}}.</p>
    </div>
    <div class="container">
        <div class="column">
            <p>Customer Sign</p>
        </div>
        <div class="column">
            <p>Dealer / RFC / Installer Sign</p>
        </div>
        <div class="column" style="background-color:#f0a207;color:#fff;text-transform:capitalize;text-align:center">
            <h3>{{ $mfg->businees_name }}</h3>
            <p>{{ $mfg->address }}, {{ $mfg->state }}, {{ $mfg->country }}</p>
        </div>
    </div>
</body>

</html>
