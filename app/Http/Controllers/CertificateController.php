<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\Builder\Builder;
use App\Models\MapDeviceDetails;
use App\Models\Sim;

class CertificateController extends Controller
{
    public function downloadPDF(Request $request)
    {
        set_time_limit(300);
        $type = $request['type'];
        $barcode = $request['deviceId'];
        $letterHead = $request['letterHead'];
        $certificate = $request['certificate'];

        $mapDevice = MapDeviceDetails::with('barcodes','cusmtomer','dealer','package','barcodes.tacNo','barcodes.modelNo')->find($barcode);
        $sim = Sim::where('barcode_id',$mapDevice->device_seriel_no)->get();

        $data = [
            'customerName' => $mapDevice->cusmtomer->customer_name,
            'CustomerMobile' => $mapDevice->cusmtomer->customer_mobile,
            'customerAddress' => $mapDevice->cusmtomer->customer_address,
            'customerEmailId' => $mapDevice->cusmtomer->customer_email,
            'vehicalNo' => $mapDevice->vehicle_registration_number,
            'chesisNo' => $mapDevice->vehicle_chassis_no,
            'vehicalMake'=> $mapDevice->vehicle_make_model,
            'vehicalModel' => $mapDevice->vehicle_model_year,
            'engineNo' => $mapDevice->vehicle_engine_no,
            'state'=> $mapDevice->cusmtomer->customer_state,
            'rto'=> $mapDevice->cusmtomer->customer_rto_division,
            'deviceModel' => $mapDevice->barcodes->modelNo->pluck('model_no')->first(),
            'invoiceNo' => $mapDevice->invoice_no,
            'IMEINO'=>  $mapDevice->barcodes->IMEINO,
            'installationDate' => $mapDevice->date,
            'sim' => $sim,
            'no_of_panic_buttons' =>$mapDevice->no_of_panic_buttons,
            'vehicalImage'=> $mapDevice->vehicle,
            'rcImage'=> $mapDevice->rc,
            'deviceImage'=> $mapDevice->device,
            'panicButton'=> $mapDevice->panic_button,
            'tacNo' => $mapDevice->barcodes->tacNo->pluck('tacNo')->first(),
            'mapped_date'=>$mapDevice->mapped_date,
            'serialNo'=>$mapDevice->barcodes->serialNumber,
            'dealer' => $mapDevice->dealer,
            'model' => $mapDevice->barcodes->modelNo,
            'package'=> $mapDevice->package
        ];
       
        if ( $letterHead == 'allow' && $certificate == 'installation') {
            // Data to pass to the view
            $result = Builder::create()
                ->data(json_encode($data))
                ->size(150)
                ->margin(50)
                ->build();

            $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($result->getString());

            // Pass the QR code to the view
            $data['qrCode'] = $qrCodeBase64;
            $data['type'] = $type;
            $pdf = Pdf::loadView('pdf.certificate.installation', $data);
            $pdf->set_option('isRemoteEnabled', true);
            return $pdf->download('installation_certificate.pdf');
            // return view('pdf.certificate.installation');
        } elseif ( $letterHead == 'allow' && $certificate == 'warranty') {
            $data['type'] = $type;
            $pdf = Pdf::loadView('pdf.certificate.warranty', $data);
            $pdf->set_option('isRemoteEnabled', true);
            return $pdf->download('warranty.pdf');
        } elseif ( $letterHead == 'allow' && $certificate == 'fitment') {
           
            $result = Builder::create()
                ->data('This is a QR Code')
                ->size(100)
                ->margin(20)
                ->build();

            $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($result->getString());

            // Pass the QR code to the view
            $data['qrCode'] = $qrCodeBase64;
            $data['type'] = $type;

            // Generate PDF
            $pdf = Pdf::loadView('pdf.certificate.fitment', $data);
            $pdf->set_option('isRemoteEnabled', true);

            return $pdf->download('fitment.pdf');
        }

    }
}
