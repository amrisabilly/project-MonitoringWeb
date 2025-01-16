<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Folder extends Model
{

    protected $primaryKey = 'ID_folder'; // Primary Key

    protected $table = 'folders'; 

    protected $fillable = ['nama'];

    public function devices()
    {
        return $this->hasMany(Device::class, 'ID_folder');
    }
}
