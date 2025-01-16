<div>
    <style>
        .toggle {
            z-index: -1;
            width: 43px;
            height: 23px;
            background-color: #80808035;
            border: 1px solid #808080;
            border-radius: 50px;
            padding: 3px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .toggle-circle {
            position: absolute;
            left: 3px;
            width: 23px;
            height: 23px;
            border-radius: 50%;
            background-color: #8080807b;
            transition: left 0.3s ease, background-color 0.3s ease;
        }

        .toggle.active {
            background-color: #0960bd38;
            border: 1px solid #095fbd;
        }

        .toggle.active .toggle-circle {
            left: 22px;
            background-color: #095fbd;
        }

        /* Animasi loading */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            display: none;
            /* Tersembunyi secara default */
        }

        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #095fbd;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <!-- Elemen untuk animasi loading -->
    <div class="loading-overlay" id="loadingOverlay">
        <img src="{{ asset('img/icons/preloader.gif') }}" width="68px">
    </div>

    <a onclick="toggleSwitch('{{ $id }}', '{{ $deviceId }}')">
        <div class="toggle {{ $isActive ? 'active' : '' }}" id="{{ $id }}">
            <div class="toggle-circle"></div>
        </div>
    </a>
</div>

<script>
    function toggleSwitch(id, deviceId) {
        var toggle = document.getElementById(id);
        toggle.classList.toggle('active');

        // Tentukan status baru berdasarkan toggle
        var newStatus = toggle.classList.contains('active') ? 1 : 0;

        // Update status toggle perangkat
        updateDeviceToggleStatus(deviceId, newStatus);

        // Tampilkan animasi loading
        document.getElementById('loadingOverlay').style.display = 'flex';

        // Delay refresh halaman selama 2 detik setelah toggle diubah
        setTimeout(function() {
            window.location.reload();
        }, 2000); // 2000 ms = 2 detik
    }

    // Fungsi untuk memperbarui status toggle perangkat
    function updateDeviceToggleStatus(deviceId, toggleStatus) {
        fetch(`/device/${deviceId}/toggle`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    toggle: toggleStatus // Perbarui status toggle perangkat
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Device toggle status updated:', data);
            })
            .catch(error => {
                console.error('Error updating device toggle status:', error);
            });
    }
</script>
