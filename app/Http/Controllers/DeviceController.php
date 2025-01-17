<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Folder;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    // Menampilkan seluruh device
    public function index()
    {
        $device = Device::all(); // Ambil data perangkat
        return view('index', compact('device')); // Kirim data ke view utama (index.blade.php)
    }

    // Berdasarkan Folder
    public function showDevicesByFolder($id)
    {
        // Mengambil data folder berdasarkan ID
        $folder = Folder::findOrFail($id);

        // Mengambil perangkat yang terkait dengan folder
        $devices = Device::where('ID_folder', $id)->get();

        // Kirim data folder dan perangkat ke view
        return view('components.item-table', compact('folder', 'devices'));
    }

    public function toggle(Request $request, $deviceId)
    {
        $device = Device::find($deviceId);

        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        // Ambil nilai toggle dari permintaan
        $toggle = $request->input('toggle');
        $status = $request->input('status');

        // Perbarui toggle perangkat
        $device->toggle = $toggle;

        // Jika toggle dimatikan (0), ubah status menjadi offline (0)
        if ($toggle == 0) {
            $device->status = 0;  // Status menjadi offline

            // Panggil stopPingIfToggleOff untuk menghentikan ping
            $this->stopPingIfToggleOff($deviceId);
        }

        $device->save();

        return response()->json([
            'message' => 'Device toggle and status updated successfully',
            'toggle' => $device->toggle,
            'status' => $device->status
        ]);
    }

    public function stopPingIfToggleOff($deviceId)
    {
        $device = Device::find($deviceId);

        if (!$device) {
            return response()->json(['error' => 'Device not found'], 404);
        }

        // Hentikan ping perangkat dan set status menjadi offline
        $device->status = 0; // Set status menjadi offline
        $device->save();

        // Kirimkan respon sukses
        return response()->json(['message' => 'Ping stopped and device status set to offline']);
    }

    public function updateStatus(Request $request)
    {
        $device = Device::find($request->device_id);

        if ($device) {
            $device->status = $request->status;
            $device->save();

            return response()->json(['message' => 'Device status updated successfully']);
        }

        return response()->json(['message' => 'Device not found'], 404);
    }

    // Add Device berdasarkan folder
    public function store(Request $request, $folderID)
    {
        // Pastikan folder dengan ID yang diberikan ada
        $folder = Folder::findOrFail($folderID);

        // Validasi input dari request
        $request->validate([
            'IP_address' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'MAC_address' => 'required|string|max:255',
        ]);

        // Buat perangkat baru
        $device = Device::create([
            'ID_folder' => $folderID,
            'IP_address' => $request->IP_address,
            'nama' => $request->nama,
            'MAC_address' => $request->MAC_address,
            'status' => 0, // Set default status ke 0
            'toggle' => 0, // Set default toggle ke 0
            'tanggal_dibuat' => now(),
            'tanggal_diubah' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Ambil semua perangkat di dalam folder untuk ditampilkan
        $devices = Device::where('ID_folder', $folderID)->get();

        // Kembalikan view dengan folder dan perangkat
        return redirect()->route('folders.show', ['ID_folder' => $folderID]);
    }

    // Bulk Delete
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids) {
            Device::whereIn('ID_device', $ids)->delete();
            return back()->with('success', 'Data berhasil dihapus!');
        }
        return back()->with('error', 'Tidak ada data yang dipilih!');
    }

    // Bulk Edit
    public function bulkEdit(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids) {
            $devices = Device::whereIn('ID_device', $ids)->get();
            return view('bulk-edit', compact('devices'));
        }
        return back()->with('error', 'Tidak ada data yang dipilih!');
    }

    // Bulk Edit Submit
    public function bulkEditSubmit(Request $request)
    {
        $ids = $request->input('ID_device');
        $device_names = $request->input('nama');
        $ip_addresses = $request->input('IP_address');
        $mac_addresses = $request->input('MAC_address');

        foreach ($ids as $index => $id) {
            $device = Device::find($id);
            if ($device) {
                $device->update([
                    'nama' => $device_names[$index],
                    'IP_address' => $ip_addresses[$index],
                    'MAC_address' => $mac_addresses[$index],
                ]);
            }
        }

        return redirect('/')->with('success', 'Data perangkat berhasil diupdate!');
    }
}
