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

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .log-modal-content {
            background-color: #fff;
            padding-block: 20px;
            padding-inline: 80px;
            margin: 1% auto;
            width: 70%;
            border-radius: 15px;
            max-height: 90%;
            overflow-y: auto;
        }

        .close-btn {
            all: unset;
            color: #F56E02;
            float: right;
            font-size: 42px;
            cursor: pointer;
        }

        .modal-header-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-bottom: 0px;
        }

        .modal-header-table td table {
            border-collapse: collapse;
            table-layout: fixed;
            color: black;
            display: flex;
            justify-content: stretch;
            flex-direction: column-reverse;
        }

        .modal-header-table td table td {
            padding-block: 6px;
        }

        .time-button button {
            width: 90px;
            height: 43px;
            background-color: transparent;
            border: 1px solid rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .time-button button:hover {
            background-color: rgba(0, 0, 0, 0.2);
        }

        .content-table {
            width: 100%;
            border-collapse: inherit;
            table-layout: fixed;
            padding: 24px 24px 0px 24px;
            margin-bottom: 0px;
            margin-top: 0px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 12px;
        }

        .table-head {
            padding: 8px;
            background-color: #512508;
            color: white
        }

        /* Set a fixed height for the tbody */
        #log-content {
            height: 200px;
            /* Adjust this height based on your design */
            overflow-y: auto;
            /* Enable vertical scrollbar if content overflows */
            display: block;
            /* Make tbody block-level to allow scrolling */
        }

        /* Scrollbar styling */
        #log-content::-webkit-scrollbar,
        .log-modal-content::-webkit-scrollbar {
            width: 3px;
        }

        #log-content::-webkit-scrollbar-track,
        .log-modal-content::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.134);
            border-radius: 5px;
        }

        #log-content::-webkit-scrollbar-thumb,
        .log-modal-content::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        #log-content::-webkit-scrollbar-thumb:hover,
        :.log-modal-content::-webkit-scrollbar-thumb:hover {
            background: #555;
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
                <tr class="items-row" data-id="{{ $devices->ID_device }}">
                    <td style="text-align: center">
                        <input type="checkbox" class="checkBox" name="ids[]" value="{{ $devices->ID_device }}">
                    </td>
                    <td class="device-name">
                        <div>
                            <p style="max-width: 287px; word-wrap: break-word;">
                                {{ $devices->nama }}
                            </p>
                        </div>
                    </td>
                    <td style="text-align: center">
                        <p id="ip">{{ $devices->IP_address }}</p>
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

    {{-- Modal --}}
    <div class="modal" id="log-modal" style="display: none;">
        <div class="log-modal-content">
            {{-- Close Button --}}
            <button class="close-btn" onclick="closeModal()">&times;</button>
            {{-- Modal Header --}}
            <table class="modal-header-table" id="modal-header">
                <tr>
                    {{-- Kolom kiri --}}
                    <td>
                        <table>
                            {{-- Baris 1 --}}
                            <tr>
                                <td>
                                    Device Name
                                </td>
                                <td style="width:20px;" class="unused">
                                    <center>
                                        :
                                    </center>
                                </td>
                                <td class="device-name"></td>
                            </tr>
                            {{-- Baris 2 --}}
                            <tr>
                                <td>
                                    IP Address
                                </td>
                                <td style="width:20px;" class="unused">
                                    <center>
                                        :
                                    </center>
                                </td>
                                <td class="ip-address"></td>
                            </tr>
                            {{-- Baris 3 --}}
                            <tr>
                                <td>
                                    MAC Address
                                </td>
                                <td style="width:20px;" class="unused">
                                    <center>
                                        :
                                    </center>
                                </td>
                                <td class="mac-address"></td>
                            </tr>
                        </table>
                    </td>
                    {{-- Kolom Tengah --}}
                    <td>
                        <table>
                            {{-- Baris 1 --}}
                            <tr>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                </td>
                            </tr>
                            {{-- Baris 2 --}}
                            <tr>
                                <td>
                                    Created at
                                </td>
                                <td style="width:20px;" class="unused">
                                    <center>
                                        :
                                    </center>
                                </td>
                                <td class="created-at"></td>
                            </tr>
                            {{-- Baris 3 --}}
                            <tr>
                                <td>
                                    Last modified
                                </td>
                                <td style="width:20px;" class="unused">
                                    <center>
                                        :
                                    </center>
                                </td>
                                <td class="last-modified"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <hr style="border: 1px solid black;">

            {{-- Title --}}
            <div style="display: flex; justify-content:space-between;align-items:center">
                <div>
                    <p style="font-size: 22px; font-weight:bold; margin-bottom:0px">Device's Record</p>
                    <p style="margin-top:0px">See summary result from this device</p>
                </div>
                <div style="display: flex; justify-items:stretch" class="time-button">
                    <button style="border-radius: 5px 0px 0px 5px ">
                        7 days
                    </button>
                    <button>
                        Month
                    </button>
                    <button style="border-radius: 0px 5px 5px 0px ">
                        Year
                    </button>
                </div>
            </div>

            {{-- Log Device Status & Stats Summary --}}
            <table class="content-table">
                <tr>
                    {{-- Log Device Status --}}
                    <td style="width:652px; border-right:1px solid rgba(0, 0, 0, 0.3);">
                        <center id="logTable">
                            <p><strong>Log Device Status</strong></p>
                            <div
                                style="border-radius: 12px; overflow: hidden; border: 1px solid rgba(0, 0, 0, 0.3); width:90%;">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead class="table-head" style="display: table;width: 100%;table-layout: fixed;">
                                        <tr>
                                            <td>Event Time</td>
                                            <td>
                                                <center>Status</center>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody id="log-content">
                                    </tbody>
                                </table>

                            </div>
                        </center>
                        <div style="padding:8px 24px 8px 32px;;width:100%;display: flex; justify-content:space-between">
                            <p><strong>Export Log Device Status to</strong></p>
                            <div style="width:60%;display: flex; justify-content:space-evenly">
                                <button class="inverted-primary-button" style="font-size:13px;" type="button"
                                    onclick="exportToExcel()">
                                    <img src="{{ asset('img/icons/xls-icon.png') }}" width="18px"
                                        style="margin-right: 1em">
                                    XLS Report</button>
                                <p>or</p>
                                <button class="inverted-primary-button" style="margin-right: 4.3em; font-size:13px; "
                                    type="button" onclick="exportToPDF()">
                                    <img src="{{ asset('img/icons/pdf-icon.png') }}" width="18px"
                                        style="margin-right: 1em">
                                    PDF Report</button>
                            </div>
                        </div>
                    </td>
                    {{-- Stats Summary --}}
                    <td style="padding-left: 24px; display:block; align-items:start">
                        <p style="text-align: center"><strong>Stats Summary</strong></p>
                        {{-- Total log --}}
                        <div style="display: flex; margin-bottom:1em">
                            <div
                                style="width:64px;  color:#34C759;border-radius:5px;background-color: transparent; display:flex;align-items:center; justify-content:center; border: 1px solid #34C759">
                                100%
                            </div>
                            <div style="height 44px; margin-left:1em;">
                                <div><strong id="total-result"> </strong></div>
                                <div>Status Checked</div>
                            </div>
                        </div>
                        {{-- online --}}
                        <div style="display: flex; margin-bottom:1em">
                            <div style="width:64px;  color:white;border-radius:5px;background-color: #34C759; display:flex;align-items:center; justify-content:center"
                                id="online-percentage">

                            </div>
                            <div style="height 44px; margin-left:1em;">
                                <div><strong id="online-result"> </strong></div>
                                <div>Online status</div>
                            </div>
                        </div>
                        {{-- offline --}}
                        <div style="display: flex;">
                            <div style="width:64px;  color:white;border-radius:5px;background-color: #CB0B00; display:flex;align-items:center; justify-content:center"
                                id="offline-percentage">

                            </div>
                            <div style="height 44px; margin-left:1em;">
                                <div><strong id="offline-result"> </strong></div>
                                <div>Offline status</div>
                            </div>
                        </div>
                        <center>
                            <button class="primary-button" onclick="tracingShow()" type="button" id="runTracert"
                                style="margin-top:4.4em; width:100%; display:flex; justify-content:center">
                                Trace This Device
                            </button>
                        </center>
                    </td>
                </tr>
            </table>

            {{-- Tracing --}}
            <div style="display: none" id="tracing-section">
                <p style="font-size: 22px; font-weight:bold; margin-bottom:0px">Tracking Device</p>
                <p style="margin-block: 0px;">See network path to current device</p>
                <div style="display:flex;">
                    <p style="border: 1px solid rgba(0, 0, 0, 0.3); width: 662px; padding:8px; border-radius:12px;"
                        id="tracert-result">
                        <span id="loading" style="display: none; font-style: italic; color: gray;">Loading...</span>
                    </p>
                    <div style="padding-inline:1em; display:none; margin-top:2em;" id="trace-complete">
                        <img src="{{ asset('img/icons/trace-complete.png') }}" width="33px;">
                        <p style="margin: 0px; font-size:13px;"><strong>Trace Complete</strong></p>
                        <p style="margin: 0px;">Now, you can see this network’s paths here</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

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

        // Menyimpan status terakhir perangkat
        let deviceStatusCache = {};

        // Fungsi untuk mencatat log hanya jika status berubah
        function writeLog(deviceId, status) {
            console.log(`Writing log for device ${deviceId}: Status changed to ${status === 1 ? 'Online' : 'Offline'}`);

            // Kirim permintaan POST untuk menyimpan log
            fetch('/save-log', {
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
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(text);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Log saved:', data);
                })
                .catch(error => console.error('Save log error:', error));
        }

        // Fungsi untuk melakukan ping perangkat
        function pingDevice(ipAddress, deviceId) {
            fetch(`/ping?request_ping=true&ip_address=${ipAddress}`)
                .then(response => response.json())
                .then(data => {
                    const pingResult = data.ping_success;
                    console.log(`Ping result for device ${deviceId}: ${pingResult ? 'Online' : 'Offline'}`);

                    // Cek apakah status perangkat berubah
                    if (pingResult && deviceStatusCache[deviceId] !== 1) {
                        // Status berubah dari Offline ke Online
                        updateDeviceStatus(deviceId, 1); // Update status ke online
                        writeLog(deviceId, 1); // Catat log online
                        deviceStatusCache[deviceId] = 1; // Simpan status terbaru
                    } else if (!pingResult && deviceStatusCache[deviceId] !== 0) {
                        // Status berubah dari Online ke Offline
                        updateDeviceStatus(deviceId, 0); // Update status ke offline
                        writeLog(deviceId, 0); // Catat log offline
                        deviceStatusCache[deviceId] = 0; // Simpan status terbaru
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

        // Modal Log
        const table = document.getElementById('itemTable');
        const modal = document.getElementById('log-modal');
        const detailContent = document.getElementById('log-content');

        // Mendengarkan event double click pada row tabel
        table.addEventListener('dblclick', function(e) {
            const tr = e.target.closest('tr');
            if (tr && tr.dataset.id) {
                const deviceId = tr.dataset.id;

                // Fetch detail device data (Nama perangkat, IP, MAC, dll)
                axios.get(`/device/${deviceId}`)
                    .then(response => {
                        const devices = response.data;
                        const createdAt = new Date(devices.created_at);
                        const CreatedformattedDate = createdAt.toLocaleString('en-GB', {
                            weekday: 'short',
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                        const updatedAt = new Date(devices.updated_at);
                        const UpdatedformattedDate = updatedAt.toLocaleString('en-GB', {
                            weekday: 'short',
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });

                        // Update modal dengan detail perangkat
                        document.querySelector('#log-modal .device-name').textContent = devices
                            .nama;
                        document.querySelector('#log-modal .ip-address').textContent = devices.IP_address;
                        document.querySelector('#log-modal .mac-address').textContent = devices
                            .MAC_address;
                        document.querySelector('#log-modal .created-at').textContent = CreatedformattedDate;
                        document.querySelector('#log-modal .last-modified').textContent = UpdatedformattedDate;

                        // Fetch log data untuk perangkat ini
                        return axios.get(`/${deviceId}/log`);
                    })
                    .then(response => {
                        const logs = response.data.logs;
                        detailContent.innerHTML = ''; // Clear previous content

                        // Hitung status Online dan Offline
                        const statusCount = logs.reduce((count, log) => {
                            if (log.status == 0) {
                                count.offline += 1;
                            } else {
                                count.online += 1;
                            }
                            return count;
                        }, {
                            online: 0,
                            offline: 0
                        });

                        const totalLogs = statusCount.online + statusCount.offline;

                        // Hitung persentase
                        const onlinePercentage = (statusCount.online / totalLogs) * 100;
                        const offlinePercentage = (statusCount.offline / totalLogs) * 100;

                        document.querySelector('#total-result').textContent = `${totalLogs} Result`;
                        document.querySelector('#online-result').textContent = `${statusCount.online} Result`;
                        document.querySelector('#offline-result').textContent = `${statusCount.offline} Result`;
                        document.querySelector('#online-percentage').textContent =
                            totalLogs === 0 ? '0%' : `${onlinePercentage.toFixed(1)}%`;
                        document.querySelector('#offline-percentage').textContent =
                            totalLogs === 0 ? '0%' : `${offlinePercentage.toFixed(1)}%`;

                        // Populate modal dengan log data
                        logs.forEach(log => {
                            const createdAt = new Date(log.created_at);
                            const formattedDate = createdAt.toLocaleString('en-GB', {
                                weekday: 'short',
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit'
                            });

                            document.get

                            const row = `
                        <tr style="display: table;width: 100%;table-layout: fixed;">
                            <td style="padding: 8px">${formattedDate}</td>
                            <td style="padding-block: 8px; color: ${log.status == 0 ? 'red' : 'green'}">
                                <center>
                                    ${log.status == 0 ? 'Offline' : 'Online'}
                                </center>
                            </td>
                        </tr>
                    `;
                            detailContent.insertAdjacentHTML('afterbegin', row);
                        });

                        // Show modal
                        modal.style.display = 'block';
                    })
                    .catch(error => {
                        alert('Failed to load device details or logs');
                    });
            }
        });

        // Function to close modal
        function closeModal() {
            modal.style.display = 'none';
        }

        // Tutup modal jika klik di luar area modal
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        // menampilkan area tracert didalam modal
        function tracingShow() {
            tracingSec = document.getElementById('tracing-section');
            tracingSec.style.display = 'block';
            const tracingSection = document.getElementById('tracing-section');

            tracingSection.scrollIntoView({
                behavior: 'smooth'
            });

            document.getElementById('runTracert').click();
        }

        // Menjalankan tracert
        document.getElementById('runTracert').addEventListener('click', function() {
            const ip = document.getElementById('ip').textContent.trim();
            const loading = document.getElementById('loading');
            const tracertResult = document.getElementById('tracert-result');
            const traceComplete = document.getElementById('trace-complete');

            if (!ip) {
                alert('Please enter an IP address or hostname.');
                return;
            }

            // Tampilkan indikator loading dan kosongkan hasil sebelumnya
            loading.style.display = 'inline';
            tracertResult.innerHTML =
                '<span id="loading" style="font-style: italic; color: gray;">Loading...</span>';
            traceComplete.style.display = 'none';

            axios.get(`/run-tracert/${ip}`)
                .then(response => {
                    // Tampilkan hasil dan sembunyikan loading
                    tracertResult.innerHTML = response.data.output;
                    traceComplete.style.display = 'block';
                })
                .catch(error => {
                    console.error(error);
                    const errorMessage = error.response?.data?.error || 'Error running tracert.';
                    tracertResult.innerHTML = `<span style="color: red;">${errorMessage}</span>`;
                })
                .finally(() => {
                    // Sembunyikan loading setelah selesai
                    loading.style.display = 'none';
                });
        });

        // eksport pdf
        function exportToPDF() {
            const header = document.getElementById("modal-header");
            const logTable = document.getElementById("logTable");
            const detailContent = document.getElementById('log-content');

            // Set height to 'auto' before export
            detailContent.style.height = 'auto';

            const tempContainer = document.createElement("div");
            tempContainer.appendChild(header.cloneNode(true));
            tempContainer.appendChild(logTable.cloneNode(true));

            // Set up options for html2pdf
            const options = {
                margin: 16,
                filename: 'DeviceLog.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 4
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            // Export to PDF
            html2pdf().from(tempContainer).set(options).save().then(() => {
                // Restore height back to 200px after export
                detailContent.style.height = '200px';
            });
        }

        // eksport excel
        function exportToExcel() {
            const logTable = document.getElementById("logTable");
            const anotherElement = document.getElementById("modal-header");

            // Buat kontainer sementara untuk menggabungkan kedua elemen
            const tempContainer = document.createElement("div");
            tempContainer.appendChild(anotherElement.cloneNode(true)); // Elemen pertama
            tempContainer.appendChild(logTable.cloneNode(true)); // Tabel di bawah

            // Mengubah tabel menjadi buku Excel
            const wb = XLSX.utils.table_to_book(tempContainer, {
                sheet: "Sheet1"
            });

            // Mengakses sheet pertama
            const ws = wb.Sheets["Sheet1"];

            // Menghapus semua item di baris pertama (row 1)
            const range = XLSX.utils.decode_range(ws['!ref']);
            for (let col = range.s.c; col <= range.e.c; col++) {
                const cell = ws[XLSX.utils.encode_cell({
                    r: 0,
                    c: col
                })]; // Akses sel di baris pertama (row 1)
                if (cell) {
                    delete ws[XLSX.utils.encode_cell({
                        r: 0,
                        c: col
                    })]; // Hapus konten sel
                }
            }

            // Menyesuaikan lebar kolom secara otomatis berdasarkan konten
            for (let col = range.s.c; col <= range.e.c; col++) {
                let maxWidth = 10; // Set minimum width (menghindari terlalu kecil)
                for (let row = range.s.r + 1; row <= range.e.r; row++) { // Mulai dari baris kedua untuk menghindari header
                    const cell = ws[XLSX.utils.encode_cell({
                        r: row,
                        c: col
                    })];
                    if (cell && cell.v) {
                        maxWidth = Math.max(maxWidth, cell.v.toString().length); // Cari panjang teks terpanjang
                    }
                }
                const colLetter = XLSX.utils.encode_col(col); // Menentukan huruf kolom
                ws['!cols'] = ws['!cols'] || [];
                ws['!cols'][col] = {
                    wch: maxWidth
                }; // Atur lebar kolom
            }

            // Menyimpan file Excel
            XLSX.writeFile(wb, "tabel.xlsx");
        }
    </script>
    </script>

</div>
