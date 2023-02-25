<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['nama_hotel','kota_id','gambar','harga','alamat','status_publish','status_rekomendasi','deskripsi','rating'];

    // merelasikan tabel hotels dengan tabel kotas
    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id' );
    }
}
