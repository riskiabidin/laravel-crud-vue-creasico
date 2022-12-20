<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Pembelian extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_pembelian','id_produk','harga_beli','jumlah','sub_total'];
    
    public function produk(){
        return $this->belongsTo(produk::class, 'id_produk');

    }
}
