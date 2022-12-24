<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_penjualan extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_penjualan','id_produk','harga_jual','jumlah','sub_total'];
    
    public function produk(){
        return $this->belongsTo(produk::class, 'id_produk');

    }
}
