<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gunung', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gunung');
            $table->string('lokasi');
            $table->integer('ketinggian'); 
            $table->string('tingkat_kesulitan'); 
            $table->integer('harga_tiket');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gunung');
    }
};