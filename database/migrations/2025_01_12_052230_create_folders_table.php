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
        Schema::create('folders', function (Blueprint $table) {
            $table->bigIncrements('ID_folder'); // Primary Key
            $table->string('nama', 50);
            $table->timestamps(); // Untuk kolom created_at dan updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folders');
    }
};
