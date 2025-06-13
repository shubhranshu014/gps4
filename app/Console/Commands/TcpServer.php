<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GpsData;
class TcpServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tcpserver:start';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the TCP Server to receive GPS data';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        // TCP server setup
        $host = '0.0.0.0'; // Listen on all interfaces
        $port = 5000; // Port number

        // Create a TCP/IP socket server
        $server = stream_socket_server("tcp://$host:$port", $errno, $errstr);

        if (!$server) {
            // If the server creation failed, show an error message
            $this->error("Error: $errstr ($errno)");
            return;
        }

        // Log that the server has started
        $this->info("Server started. Waiting for GPS data on $host:$port...");

        // Keep track of all client connections
        $clients = [];
        $clients[] = $server;  // Add the server socket to the clients list

        // Set the server socket to non-blocking mode
        stream_set_blocking($server, 0);

        // Keep the server running to listen for incoming connections
        while (true) {
            // Monitor all client sockets and the server socket for incoming data
            $readSockets = $clients;
            $writeSockets = $exceptSockets = null;

            // Use stream_select to check which sockets have data available to read
            $numChanged = stream_select($readSockets, $writeSockets, $exceptSockets, null);

            if ($numChanged === false) {
                $this->error("Error in stream_select()");
                break;
            }

            // Loop through the sockets that are ready to read
            foreach ($readSockets as $socket) {
                if ($socket === $server) {
                    // New client connection
                    $client = stream_socket_accept($server);
                    if ($client) {
                        $this->info("New client connected.");
                        // Add the new client to the list
                        $clients[] = $client;

                        // Set the client socket to non-blocking mode
                        stream_set_blocking($client, 0);
                    }
                } else {
                    // Existing client sending data
                    $data = fgets($socket);

                    if ($data === false) {
                        // If no data or connection is closed
                        if (feof($socket)) {
                            $this->info("Client disconnected.");
                        }

                        // Remove client from the list and close connection
                        $clients = array_filter($clients, fn($client) => $client !== $socket);
                        fclose($socket);
                    } else {
                        // Data is available, display it
                        $this->info("Received GPS data: $data");
                        $dataString = trim($data, '$*');
 
                        // Split the string by commas
                        $dataArray = explode(',', $dataString);
                        
                        $packetHeader = $dataArray[1] ?? 'N/A';
                        $vendorID = $dataArray[1] ?? 'N/A';
                        $firmwareVersion  = $dataArray[2] ?? 'N/A';
                        $packetType  = $dataArray[3] ?? 'N/A';
                        $alertID  = $dataArray[4] ?? 'N/A';
                        $packetstatus  = $dataArray[5] ?? 'N/A';
                        $IMEINumber  = $dataArray[6] ?? 'N/A';
                        $vehicleNo  = $dataArray[7] ?? 'N/A';
                        $GPSFix  = $dataArray[8] ?? 'N/A';
                        $currentDate  = $dataArray[9] ?? 'N/A';
                        $currentTime  = $dataArray[10] ?? 'N/A';
                        $latitude = $dataArray[11] ?? 'N/A'; // 31.589618
                        $latitudeDirection = $dataArray[12] ?? 'N/A';
                        $longitude = $dataArray[13] ?? 'N/A'; // 75.875231
                        $longitudeDirection  = $dataArray[14] ?? 'N/A';
                        $speed = $dataArray[15] ?? 'N/A';
                        $headDegree  = $dataArray[16] ?? 'N/A';
                        $numberofSatellites  = $dataArray[17] ?? 'N/A';
                        $altitude  = $dataArray[18] ?? 'N/A';
                        $PDOP  = $dataArray[19] ?? 'N/A';
                        $HDOP  = $dataArray[20] ?? 'N/A';
                        $networkOperator  = $dataArray[21] ?? 'N/A';
                        $ignitionStatus = $dataArray[22] ?? 'N/A';
                        $mainsPowerStatus = $dataArray[23] ?? 'N/A';
                        $mainsInputVoltage = $dataArray[24] ?? 'N/A';
                        $internalBatteryVoltage = $dataArray[25] ?? 'N/A';
                        $sosStatus = $dataArray[26] ?? 'N/A';
                        $tamperAlert  = $dataArray[27] ?? 'N/A';
                        $GSMSignal  = $dataArray[28] ?? 'N/A';
                        $MCC = $dataArray[29] ?? 'N/A';
                        $MNC = $dataArray[30] ?? 'N/A';
                        $LAC = $dataArray[31] ?? 'N/A';
                        $cellID = $dataArray[32] ?? 'N/A';
                        $NMR1 = $dataArray[33] ?? 'N/A';
                        $NMR2 = $dataArray[34] ?? 'N/A';
                        $NMR3 = $dataArray[35] ?? 'N/A';
                        $NMR4 = $dataArray[36] ?? 'N/A';
                        $NMR5 = $dataArray[37] ?? 'N/A';
                        $NMR6 = $dataArray[38] ?? 'N/A';
                        $NMR7 = $dataArray[39] ?? 'N/A';
                        $NMR8 = $dataArray[40] ?? 'N/A';
                        $NMR9 = $dataArray[41] ?? 'N/A';
                        $NMR10 = $dataArray[42] ?? 'N/A';
                        $NMR11 = $dataArray[43] ?? 'N/A';
                        $NMR12 = $dataArray[44] ?? 'N/A';
                        $digitalInputs = $dataArray[45] ?? 'N/A';
                        $digitalOutput = $dataArray[46] ?? 'N/A';
                        $analogInput1 = $dataArray[47] ?? 'N/A';
                        $frameNo = $dataArray[48] ?? 'N/A';
                        $checksumandEnd = $dataArray[49] ?? 'N/A';
                        $gpsdata = new GpsData ;
                        $gpsdata->packetHeader = $packetHeader;
                        $gpsdata->vendorID = $vendorID;
                        $gpsdata->firmwareVersion = $firmwareVersion;
                        $gpsdata->packetType = $packetType;
                        $gpsdata->alertID = $alertID;
                        $gpsdata->packetStatus = $packetstatus;
                        $gpsdata->IMEINumber = $IMEINumber;
                        $gpsdata->vehicleNo = $vehicleNo;
                        $gpsdata->GPSFix = $GPSFix;
                        $gpsdata->currentDate = $currentDate;
                        $gpsdata->currentTime = $currentTime;
                        $gpsdata->latitude = $latitude;
                        $gpsdata->latitudeDirection = $latitudeDirection;
                        $gpsdata->longitude = $longitude;
                        $gpsdata->longitudeDirection = $longitudeDirection;
                        $gpsdata->speed = $speed;
                        $gpsdata->headDegree = $headDegree;
                        $gpsdata->numberofSatellites = $numberofSatellites;
                        $gpsdata->altitude = $altitude;
                        $gpsdata->PDOP = $PDOP;
                        $gpsdata->HDOP = $HDOP;
                        $gpsdata->networkOperator = $networkOperator;
                        $gpsdata->ignitionStatus = $ignitionStatus;
                        $gpsdata->mainsPowerStatus = $mainsPowerStatus;
                        $gpsdata->mainsInputVoltage = $mainsInputVoltage;
                        $gpsdata->internalBatteryVoltage = $internalBatteryVoltage;
                        $gpsdata->SOSstatus = $sosStatus;
                        $gpsdata->tamperAlert = $tamperAlert;
                        $gpsdata->GSMSignal = $GSMSignal;
                        $gpsdata->MCC = $MCC;
                        $gpsdata->MNC = $MNC;
                        $gpsdata->LAC = $LAC;
                        $gpsdata->cellID = $cellID;
                        $gpsdata->NMR1 = $NMR1;
                        $gpsdata->NMR2 = $NMR2;
                        $gpsdata->NMR3 = $NMR3;
                        $gpsdata->NMR4 = $NMR4;
                        $gpsdata->NMR5 = $NMR5;
                        $gpsdata->NMR6 = $NMR6;
                        $gpsdata->NMR7 = $NMR7;
                        $gpsdata->NMR8 = $NMR8;
                        $gpsdata->NMR9 = $NMR9;
                        $gpsdata->NMR10 = $NMR10;
                        $gpsdata->NMR11 = $NMR11;
                        $gpsdata->NMR12 = $NMR12;
                        $gpsdata->digitalInputs = $digitalInputs;
                        $gpsdata->digitalOutput = $digitalOutput;
                        $gpsdata->analogInput1 = $analogInput1;
                        $gpsdata->frameNo = $frameNo;
                        $gpsdata->checksumandEnd = $checksumandEnd;
                        $gpsdata->save();
                        // You can process the GPS data here (e.g., parsing NMEA format)
                    }
                }
            }

            // Sleep briefly to avoid 100% CPU usage (can adjust or remove)
            usleep(100000); // Sleep for 0.1 seconds to avoid maxing out the CPU
        }

        // Close the server when done (this won't be reached unless the script is terminated)
        fclose($server);
    }

}
