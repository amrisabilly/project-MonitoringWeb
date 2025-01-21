<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';

    // Kolom yang bisa diisi
    protected $fillable = ['device_id', 'status', 'created_at'];

    // Relasi jika diperlukan
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
