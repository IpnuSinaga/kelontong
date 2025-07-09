<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['pelanggan_id', 'tanggal', 'total'];
    protected $casts = [
        'tanggal' => 'datetime',
    ];
    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
