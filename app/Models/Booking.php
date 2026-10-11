<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    protected $fillable = [
        'gunung_id',
        'nama_pendaki',
        'no_hp',
        'tanggal_naik',
        'jumlah_pendaki',
        'status',
    ];

    protected $casts = [
        'tanggal_naik' => 'date',
    ];

    public function gunung()
    {
        return $this->belongsTo(Gunung::class, 'gunung_id');
    }
}