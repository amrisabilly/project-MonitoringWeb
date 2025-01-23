<?php

namespace App\Http\Controllers;

use App\Models\Log;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function showLogs($id)
    {
        // Ambil data log berdasarkan ID device
        $logs = Log::where('device_id', $id)->get();

        // Kembalikan data log dalam format JSON
        return response()->json(['logs' => $logs]);
    }
}
