<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->date('tanggalJatuhTempo')->nullable()->after('jumlah');
        });
    }
    
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            //
        });
    }
};
