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

document.addEventListener('click', function (event) {
    const filterButton = document.getElementById('filterButton');
    const filterDropdown = document.getElementById('filterDropdown');
    if (!filterButton.contains(event.target) && !filterDropdown.contains(event.target)) {
        filterDropdown.style.display = 'none';
    }
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


// Toggle dropdown visibility
document.getElementById('optionsButton').addEventListener('click', function () {
    const dropdown = document.getElementById('optionsDropdown');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
});
// Close dropdown when clicking outside
document.addEventListener('click', function (event) {
    const optionsButton = document.getElementById('optionsButton');
    const optionsDropdown = document.getElementById('optionsDropdown');
    if (!optionsButton.contains(event.target) && !optionsDropdown.contains(event.target)) {
        optionsDropdown.style.display = 'none';
    }
});
// Example event listeners for options
document.getElementById('renameOption').addEventListener('click', function () {
    alert('Rename clicked!');
});
document.getElementById('deleteOption').addEventListener('click', function () {
    alert('Delete clicked!');
});

