<?php
// Fungsi untuk mengecek status ping
function cek($ipAddress)
{
    // Menjalankan perintah ping
    $pingResult = exec('ping -n 1 ' . escapeshellarg($ipAddress), $output, $status);

    // Memeriksa status ping, 0 berarti sukses
    return $status === 0;
}

// Mengecek apakah ada request ping
if (isset($_GET['request_ping'])) {
    $ipAddress = $_GET['ip_address'] ?? '192.168.217.104';
    $pingSuccess = cek($ipAddress);

    // Mengembalikan hasil dalam format JSON
    echo json_encode(['ping_success' => $pingSuccess]);
    exit();
}
?>

<div>
    <style>
        .main-table {
            width: 100%;
            margin: 0;
            padding: 0px;
            margin-bottom: 1em;
            border-collapse: collapse;
            height: 120px;
        }

        .header {
            font-weight: 300;
            color: white;
            padding: 24px;
            background-color: #25160f;
        }

        .items-row {
            height: 60px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.25);
            transition: background-color 0.2s ease, transform 0.3s ease;
        }

        .items-row:hover {
            background-color: rgba(0, 0, 0, 0.115);
        }


        .status-online {
            background-color: #34c7590e;
            border: 1px solid #34c759;
            color: #34c759;
            width: max-content;
            padding-inline: 20px;
            padding-top: 2px;
            padding-bottom: 2px;
            border-radius: 15px;
        }

        .status-offline {
            background-color: #ff3b300e;
            border: 1px solid #ff3b30;
            color: #ff3b30;
            width: max-content;
            padding-inline: 20px;
            padding-top: 2px;
            padding-bottom: 2px;
            border-radius: 15px;
        }

        input[type="checkbox"] {
            width: 20px;
            height: 20px;
        }

        /* Scrollbar styling */
        table::-webkit-scrollbar {
            width: 10px;
        }

        table::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.134);
            border-radius: 5px;
        }

        table::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        table::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .inactive-row {
            color: rgba(0, 0, 0, 0.5)
        }
    </style>

    {{-- Main Table --}}
    <table class="main-table" id="itemTable">
        {{-- Header --}}
        <thead>
            <tr>
                <td style="text-align: center; border-top-left-radius:10px;" class="header">
                </td>
                <td class="header" style="padding-left: 0">
                    Devices Name
                </td>
                <td class="header" style="text-align: center">
                    IP Address
                </td>
                <td class="header" style="text-align: center">
                    Status
                </td>
                <td class="header" style="text-align: center">
                    MAC Address
                </td>
                <td class="header" style="text-align: center; border-top-right-radius:10px;">
                    Disable/Enable
                </td>
            </tr>
        </thead>


        <tbody>
            @foreach ($device as $devices)
                <tr class="items-row">
                    <td style="text-align: center">
                        <input type="checkbox" class="checkBox" name="ids[]" value="{{ $devices->ID_device }}">
                    </td>
                    <td class="device-name">
                        <div>
                            <p style="max-width:
                            287px; word-wrap: break-word;">
                                {{ $devices->nama }}
                            </p>
                        </div>
                    </td>
                    <td style="text-align: center">
                        <p>{{ $devices->IP_address }}</p>
                    </td>
                    <td style="text-align: center">
                        <center>
                            <p id="status-{{ $devices->ID_device }}"
                                class="{{ $devices->status == 1 ? 'status-online' : 'status-offline' }}">
                                @if ($devices->status == 1)
                                    Online
                                @else
                                    Offline
                                @endif
                            </p>
                        </center>
                    </td>

                    <td style="text-align: center">
                        <p>{{ $devices->MAC_address }}</p>
                    </td>
                    <td style="text-align: center">
                        <center>
                            <x-toggle :id="'toggle' . $devices->ID_device" :isActive="$devices->toggle == 1" class="device-toggle" :deviceId="$devices->ID_device" />

                        </center>
                    </td>
                </tr>
            @endforeach

        </tbody>



    </table>

    <script>
        function staticToggle(element) {
            element.classList.toggle('active'); // Toggle status aktif

            // Temukan parent row dari toggle
            var row = element.closest('.items-row');

            // Tambah atau hapus kelas inactive-row
            if (!element.classList.contains('active')) {
                row.classList.add('inactive-row');
            } else {
                row.classList.remove('inactive-row');
            }
        }

        // Inisialisasi: Set opacity pada semua row dengan toggle tidak aktif
        document.querySelectorAll('.toggle').forEach(function(toggle) {
            var row = toggle.closest('.items-row');
            if (!toggle.classList.contains('active')) {
                row.classList.add('inactive-row');
            }
        });


        const pingIntervals = {}; // Object untuk menyimpan interval per device

        // Fungsi untuk memperbarui status perangkat di tampilan tabel
        function updateDeviceStatusInView(deviceId, status) {
            const statusElement = document.getElementById(`status-${deviceId}`);

            if (status === 1) {
                statusElement.textContent = 'Online';
                statusElement.classList.remove('status-offline');
                statusElement.classList.add('status-online');
            } else {
                statusElement.textContent = 'Offline';
                statusElement.classList.remove('status-online');
                statusElement.classList.add('status-offline');
            }
        }

        // Fungsi untuk mengubah status perangkat di server dan tampilan
        function updateDeviceStatus(deviceId, status) {
            fetch(`/update-device-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        device_id: deviceId,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Device status updated:', data);
                    updateDeviceStatusInView(deviceId, status);
                })
                .catch(error => console.error('Update status error:', error));
        }

        // Fungsi untuk melakukan ping perangkat
        function pingDevice(ipAddress, deviceId) {
            fetch(`/ping?request_ping=true&ip_address=${ipAddress}`)
                .then(response => response.json())
                .then(data => {
                    const pingResult = data.ping_success;
                    console.log(`Ping result for device ${deviceId}: ${pingResult ? 'Online' : 'Offline'}`);

                    if (pingResult) {
                        updateDeviceStatus(deviceId, 1); // Update status ke online
                    } else {
                        updateDeviceStatus(deviceId, 0); // Update status ke offline
                    }
                })
                .catch(error => console.error('Ping Error:', error));
        }

        // Fungsi untuk mengatur ping berdasarkan status toggle
        function handleToggleChange(deviceId, ipAddress) {
            const toggleElement = document.getElementById(`toggle${deviceId}`);
            const statusElement = document.getElementById(`status-${deviceId}`);

            // Jika toggle aktif, mulai ping setiap 3 detik
            if (toggleElement && toggleElement.classList.contains('active')) {
                // Cek apakah interval sudah ada, jika sudah, jangan mulai interval baru
                if (!pingIntervals[deviceId]) {
                    // Mulai ping setiap 3 detik jika interval belum ada
                    pingIntervals[deviceId] = setInterval(function() {
                        pingDevice(ipAddress, deviceId);
                    }, 3000);
                }

                // Update status perangkat secara langsung
                updateDeviceStatus(deviceId, 1); // Status Online
            } else {
                // Jika toggle non-aktif, hentikan ping dan ubah status ke Offline
                if (pingIntervals[deviceId]) {
                    clearInterval(pingIntervals[deviceId]);
                    pingIntervals[deviceId] = null; // Menghapus interval dari object
                    updateDeviceStatus(deviceId, 0); // Status Offline
                }
            }
        }


        // Event listener untuk toggle (saat toggle berubah)
        @foreach ($device as $devices)
            document.getElementById(`toggle{{ $devices->ID_device }}`).addEventListener('change', function() {
                handleToggleChange({{ $devices->ID_device }}, '{{ $devices->IP_address }}');
            });
        @endforeach

        // Inisialisasi status awal ping untuk setiap perangkat (cek status toggle saat ini)
        @foreach ($device as $devices)
            handleToggleChange({{ $devices->ID_device }}, '{{ $devices->IP_address }}');
        @endforeach
    </script>

</div>
