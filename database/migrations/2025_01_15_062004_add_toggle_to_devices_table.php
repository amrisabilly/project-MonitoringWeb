<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->boolean('toggle')->default(0);
        });
    }

    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('toggle'); // menghapus kolom jika rollback
        });
    }
};
