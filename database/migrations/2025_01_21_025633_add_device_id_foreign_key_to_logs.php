<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeviceIdForeignKeyToLogs extends Migration
{
    public function up()
    {
        Schema::table('logs', function (Blueprint $table) {
            // Menambahkan foreign key untuk device_id
            $table->foreign('device_id')
                ->references('ID_device')
                ->on('devices')
                ->onDelete('cascade'); // Atur aksi delete jika perangkat dihapus
        });
    }

    public function down()
    {
        Schema::table('logs', function (Blueprint $table) {
            // Menghapus foreign key jika migrasi dibatalkan
            $table->dropForeign(['device_id']);
        });
    }
}
