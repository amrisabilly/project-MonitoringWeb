<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\DeviceController;
use App\Models\Device;
use App\Models\Folder;

// Main Route
Route::get('/', [DeviceController::class, 'index']);


Route::get('/edit-device', function () {
    return view('edit-device');
});

Route::get('/add-folder', function () {
    return view('add-folder');
});

// Folders
Route::get('/folders/{ID_folder}', [FolderController::class, 'show'])->name('folders.show');
Route::delete('/delete/{ID_folder}', [FolderController::class, 'destroy'])->name('folders.destroy');
Route::post('/save-folder', [FolderController::class, 'store'])->name('folders.store');

// Device
Route::post('/device/{ID_device}/toggle', [DeviceController::class, 'toggle'])->name('device.toggle');
Route::post('/update-device-status', [DeviceController::class, 'updateStatus'])->name('update.device.status');
Route::get('/folders/{ID_folder}/add-device', [FolderController::class, 'addDeviceForm'])->name('add.device.form');
Route::post('/folders/{ID_folder}/add-device/post', [DeviceController::class, 'store'])->name('device.store');

Route::post('/device/bulk-delete', [DeviceController::class, 'bulkDelete'])->name('data.bulkDelete');
Route::post('/folders/{ID_folder}/device/edit-device', [DeviceController::class, 'bulkEdit'])->name('device.bulkEdit');



// request untuk melakukan PING
Route::get('ping', function () {
    // Fungsi untuk mengecek status ping
    function cek($ipAddress)
    {
        $pingResult = exec('ping -n 1 ' . escapeshellarg($ipAddress), $output, $status);
        return $status === 0;
    }

    $ipAddress = request('ip_address', '192.168.217.104');
    $pingSuccess = cek($ipAddress);

    // Mengembalikan hasil dalam format JSON
    return response()->json(['ping_success' => $pingSuccess]);
});
