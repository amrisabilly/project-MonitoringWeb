<?php

namespace App\Http\Controllers;

use App\Models\Log;

use Illuminate\Http\Request;

class LogController extends Controller
{
    // public function showLogs($deviceId)
    // {
    //     // Ambil logs berdasarkan device_id
    //     $logs = Log::where('ID_device', $deviceId)->get();

    //     // Mengembalikan partial view dengan data logs
    //     return view('components.log-modal', compact('logs'))->render();
    // }

    public function showLogs($id)
    {
        // Ambil data log berdasarkan ID device
        $logs = Log::where('device_id', $id)->get();

        // Kembalikan data log dalam format JSON
        return response()->json(['logs' => $logs]);
    }
}
