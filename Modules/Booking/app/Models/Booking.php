<?php

namespace Modules\Booking\Models;

use App\Models\Gunung;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    protected $fillable = [
        'gunung_id', 'nama_pendaki', 'no_hp', 'tanggal_naik',
        'jumlah_pendaki', 'status', 'bukti_bayar', 'nama_bukti',
    ];

    protected $casts = [
        'tanggal_naik' => 'date',
    ];

    public function gunung()
    {
        return $this->belongsTo(Gunung::class, 'gunung_id');
    }
}