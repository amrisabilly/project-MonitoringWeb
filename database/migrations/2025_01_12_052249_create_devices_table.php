<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->bigIncrements('ID_device'); // Primary Key
            $table->unsignedBigInteger('ID_folder'); // Foreign Key
            $table->string('IP_address', 16);
            $table->string('nama', 50);
            $table->string('MAC_address', 20);
            $table->boolean('status');
            $table->dateTime('tanggal_dibuat');
            $table->dateTime('tanggal_diubah');
            $table->timestamps(); // Untuk kolom created_at dan updated_at

            // Relasi Foreign Key
            $table->foreign('ID_folder')->references('ID_folder')->on('folders')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
