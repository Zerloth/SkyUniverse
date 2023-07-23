<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'penerima',
        'alamat_kirim',
        'nomor_telepon',
        'kurir',
        'metode_pembayaran',
        'total',
        'id_user'
    ];
}
