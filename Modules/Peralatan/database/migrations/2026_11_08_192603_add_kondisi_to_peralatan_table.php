<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peralatan', function (Blueprint $table) {
            $table->string('kondisi')->default('Baik')->after('harga_sewa');
        });
    }

    public function down(): void
    {
        Schema::table('peralatan', function (Blueprint $table) {
            $table->dropColumn('kondisi');
        });
    }
};