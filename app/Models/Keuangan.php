<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'tipe', 'jumlah', 'keterangan'];
}

