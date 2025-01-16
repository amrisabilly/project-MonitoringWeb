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
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id_logs'); // Primary Key
            $table->unsignedBigInteger('id_device'); // Foreign Key
            $table->dateTime('tanggal_log');
            $table->timestamps(); // Untuk kolom created_at dan updated_at

            // Relasi Foreign Key
            $table->foreign('id_device')->references('ID_device')->on('devices')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
