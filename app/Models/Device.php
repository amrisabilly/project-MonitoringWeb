<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $primaryKey = 'ID_device';  // Primary Key

    protected $table = 'devices';  // Nama tabel

    protected $fillable = ['ID_folder', 'nama', 'IP_address', 'MAC_address', 'status', 'tanggal_dibuat', 'tanggal_diubah', 'toggle'];


    public function folder()
    {
        return $this->belongsTo(Folder::class, 'ID_folder');
    }
}
