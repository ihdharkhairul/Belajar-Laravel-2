<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gunung extends Model
{
    protected $table = 'gunung';

    protected $fillable = [
        'nama_gunung',
        'lokasi',
        'ketinggian',
        'tingkat_kesulitan',
        'harga_tiket',
        'deskripsi',
        'foto',
    ];

    public function booking()
    {
        return $this->hasMany(Booking::class, 'gunung_id');
    }
}