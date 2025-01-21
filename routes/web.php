<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LogController;

// Main Route
Route::get('/', [DeviceController::class, 'index']);




Route::get('/add-folder', function () {
    return view('add-folder');
});

// Folders
Route::get('/folders/{ID_folder}', [FolderController::class, 'show'])->name('folders.show');
Route::delete('/delete/{ID_folder}', [FolderController::class, 'destroy'])->name('folders.destroy');
Route::post('/save-folder', [FolderController::class, 'store'])->name('folders.store');
Route::post('/update-folder', [FolderController::class, 'rename'])->name('folders.update');

// Device
Route::post('/device/{ID_device}/toggle', [DeviceController::class, 'toggle'])->name('device.toggle');
Route::post('/update-device-status', [DeviceController::class, 'updateStatus'])->name('update.device.status');
Route::get('/folders/{ID_folder}/add-device', [FolderController::class, 'addDeviceForm'])->name('add.device.form');
Route::post('/folders/{ID_folder}/add-device/post', [DeviceController::class, 'store'])->name('device.store');

Route::post('/bulk-delete', [DeviceController::class, 'bulkDelete'])->name('bulkDelete');
Route::post('/bulk-edit', [DeviceController::class, 'bulkEdit'])->name('bulkEdit');
Route::post('/bulk-edit-submit', [DeviceController::class, 'bulkEditSubmit'])->name('bulkEditSubmit');

Route::get('device/{id}', [DeviceController::class, 'showDeviceDetails']);

// Write Log
Route::post('/save-log', [DeviceController::class, 'saveLog']);
Route::get('/{id}/log', [LogController::class, 'showLogs']);


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
