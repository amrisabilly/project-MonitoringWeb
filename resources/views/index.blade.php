<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Root</title>
    <link rel="stylesheet" href="css/root.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Scrollbar styling */
        body::-webkit-scrollbar {
            width: 10px;
        }

        body::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.134);
            border-radius: 5px;
        }

        body::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        body::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .main-content {
            margin-left: 342px;
            padding: 20px 60px 20px 60px;
        }

        .title {
            font-size: 29.3px;
            font-weight: 600;
            margin-top: 8px;
            margin-bottom: 8px;
        }

        .features {
            display: flex;
            gap: 1em;
        }

        .secondary-button {
            all: unset;
            border: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            border-radius: 10px;
            padding: 12px 8px 12px 8px;
            box-shadow: 2px 2px 12px rgba(220, 208, 208, 0.6);
            font-weight: 600;
            cursor: pointer;
        }

        .primary-button {
            all: unset;
            display: flex;
            align-items: center;
            border-radius: 10px;
            padding: 12px 8px 12px 8px;
            box-shadow: 2px 2px 12px rgba(220, 208, 208, 0.6);
            font-weight: 600;
            background-color: #F56E02;
            color: white;
            cursor: pointer;
        }

        .danger-button {
            all: unset;
            display: flex;
            align-items: center;
            border-radius: 10px;
            padding: 12px 8px 12px 8px;
            box-shadow: 2px 2px 12px rgba(220, 208, 208, 0.6);
            font-weight: 600;
            background-color: #CB0B00;
            color: white;
            cursor: pointer;

        }

        /* Search Bar */
        .textfield {
            border: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            border-radius: 10px;
            padding: 8px;
            box-shadow: 2px 2px 12px rgba(220, 208, 208, 0.6);
            background-color: #fff;
        }

        .textfield input {
            border: none;
            outline: none;
            flex: 1;
            padding: 8px;
            font-size: 16px;
        }

        .textfield img {
            width: 24px;
            height: 24px;
            margin-left: 8px;
        }
    </style>
</head>

<body>
    {{-- side nav --}}
    <x-side-nav></x-side-nav>
    {{-- Main Content --}}
    <div class="main-content">
        <div style="display: flex;justify-content:space-between; align-items:center">
            {{-- Title --}}
            <p class="title">
                Root
            </p>
            {{-- Option --}}
            <a href="">
                <div class="secondary-button">
                    <img src="img/icons/ellipsis-h.png" alt="" width="24px" style="margin-right: 8px;">
                    <p style="margin:inherit; margin-right:8px;">Options</p>
                </div>
            </a>
        </div>
        <hr>
        {{-- Subtitle --}}
        <p class="subtitle">
            <strong>Tips</strong> : to see detail information, logs and tracking network double-click on the selected
            device
        </p>
        {{-- Feature --}}
        <div class="features">
            {{-- Search bar --}}
            <div class="textfield" style="flex: 1">
                <input type="text" placeholder="Search Device ..." />
                <img src="img/icons/search-alt.png" alt="Search Icon" />
            </div>

            {{-- Sort --}}
            <a href="javascript:void(0)" id="sortButton">
                <div class="secondary-button">
                    <img src="img/icons/sort-amount-down.png" alt="" width="24px" style="margin-right: 8px;">
                    <p style="margin:inherit; margin-right:8px;">Sort</p>
                </div>
            </a>


            {{--  Filter Button  --}}
            <a href="#" id="filterButton">
                <div class="secondary-button">
                    <img src="img/icons/filter.png" alt="" width="24px" style="margin-right: 8px;">
                    <p style="margin:inherit; margin-right:8px;">Filter</p>
                </div>
            </a>

            {{-- Dropdown Filter  --}}
            <div id="filterDropdown"
                style="display: none; position: absolute;left:1220px; top: 190px; background-color: white; border: 1px solid #ddd; border-radius: 5px; padding: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); z-index: 10;">
                <label for="statusFilter">Select Status:</label>
                <select id="statusFilter" class="textfield" style="width: 100%; padding: 8px;">
                    <option value="">All</option>
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                </select>
            </div>


            {{-- Add Device --}}
            <x-modal modalId="addDevice" triggerId="addDevice" triggerText="Add Device" title="Modal Title"
                content="This is the modal content." class="primary-button" icon="img/icons/plus.png"
                actions="add-device" />
        </div>

        <p>Show 6 devices in this folder</p>

        {{-- Item Table --}}
        <x-item-table />

        {{-- Select All --}}
        <div
            style="display: flex; align-items:center; width:97%; justify-content:space-between; padding: 0px 20px 0px 20px;">
            <div style="display: flex; align-items:center;gap:1em">
                <img src="img/icons/arrow1.png" width="458px">
                <input type="checkbox" name="" id="checkAllButton">
                <p>Check All</p>
            </div>

            <div style="display: flex; align-items:center; gap:1em">
                <p style="color: rgba(0, 0, 0, 0.396); font-style:italic">With selected action</p>
                {{-- Edit --}}
                <x-modal modalId="edit" triggerId="edit" triggerText="Edit" title="Modal Title"
                    content="This is the modal content." class="secondary-button" icon="img/icons/edit.png"
                    actions="#" />
                {{-- Hapus --}}
                <x-modal modalId="delete" triggerId="delete" triggerText="Delete" title="Modal Title"
                    content="This is the modal content." class="danger-button" icon="img/icons/trash-alt.png"
                    actions="#" />
            </div>
        </div>

    </div>




    <script>
        // Variabel untuk melacak arah sort
        let isAscending = true;

        // Fungsi Sorting
        document.getElementById('sortButton').addEventListener('click', function() {
            let table = document.getElementById('itemTable');
            let rows = Array.from(table.rows).slice(1); // Ambil semua row kecuali header

            // Lakukan sort berdasarkan 'Device Name' (kolom kedua)
            rows.sort(function(rowA, rowB) {
                let cellA = rowA.cells[1].innerText.trim().toLowerCase(); // Kolom Device Name
                let cellB = rowB.cells[1].innerText.trim().toLowerCase();

                // Mengurutkan secara ascending atau descending tergantung arah
                if (isAscending) {
                    if (cellA < cellB) return -1;
                    if (cellA > cellB) return 1;
                } else {
                    if (cellA < cellB) return 1;
                    if (cellA > cellB) return -1;
                }
                return 0;
            });

            // Tambahkan kembali row yang sudah diurutkan ke dalam tabel
            rows.forEach(function(row) {
                table.appendChild(row);
            });

            // Toggle nilai isAscending
            isAscending = !isAscending; // Ubah arah sort untuk klik berikutnya
        });

        // Fungsi CheckAll
        const checkAllButton = document.getElementById('checkAllButton');
        const checkBoxes = document.querySelectorAll('.checkBox');

        checkAllButton.addEventListener('click', function() {
            if (checkAllButton.checked) {
                checkBoxes.forEach(function(checkbox) {
                    // Centang checkbox hanya jika row terlihat
                    if (checkbox.closest('tr').style.display !== 'none') {
                        checkbox.checked = true;
                    }
                });
            } else {
                checkBoxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }
        });

        // Fungsi Filter Dropdown
        document.getElementById('filterButton').addEventListener('click', function(event) {
            event.preventDefault();
            const dropdown = document.getElementById('filterDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Fungsi Filter berdasarkan Status
        document.getElementById('statusFilter').addEventListener('change', function() {
            const filterValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('.items-row');

            let isAnyChecked = false; // Variabel untuk menyimpan status apakah ada checkbox yang dicentang

            rows.forEach(function(row) {
                const statusCell = row.querySelector('td:nth-child(4)'); // Kolom status
                const statusText = statusCell ? statusCell.innerText.trim().toLowerCase() : '';

                // Tampilkan baris jika status sesuai filter, sembunyikan jika tidak
                if (filterValue === '' || statusText.includes(filterValue)) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }

                // Periksa apakah ada checkbox yang dicentang setelah filter diterapkan
                const checkbox = row.querySelector('input[type="checkbox"]');
                if (checkbox && checkbox.checked) {
                    isAnyChecked = true;
                }
            });

            // Reset Check All jika filter diterapkan
            document.getElementById('checkAllButton').checked = false;
        });
    </script>

</body>

</html>
