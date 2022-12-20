<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
    public function detail(){
        return $this->hasMany(Detail_Pembelian::class, 'id_pembelian', 'id');
    }
    // public function produk()
    // {
    //     return $this->belongsToMany(produk::class,'detail__pembelians','id_pembelian','id_produk');
    // }
}
