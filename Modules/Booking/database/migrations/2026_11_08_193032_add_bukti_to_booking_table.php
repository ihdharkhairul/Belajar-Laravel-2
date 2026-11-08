<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->string('bukti_bayar')->nullable()->after('status');
            $table->string('nama_bukti')->nullable()->after('bukti_bayar');
        });
    }

    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropColumn(['bukti_bayar', 'nama_bukti']);
        });
    }
};
