<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $primaryKey = 'id_logs';

    public function device()
    {
        return $this->belongsTo(Device::class, 'id_device');
    }
}
