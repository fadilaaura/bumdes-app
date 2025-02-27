<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tagihan', function (Blueprint $table) {
            $table->string('nama')->after('idMasyarakat');
            $table->string('nik')->after('nama');
            $table->string('nomor_hp')->after('nik');
            $table->string('rt_rw')->after('nomor_hp');
        });
    }

    public function down(): void
    {
        Schema::table('tagihan', function (Blueprint $table) {
            $table->dropColumn(['nama', 'nik', 'nomor_hp', 'rt_rw']);
        });
    }
};

