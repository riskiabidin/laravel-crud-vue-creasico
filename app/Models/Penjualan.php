<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    public function member(){
        return $this->belongsTo(Member::class, 'id_member');
    }
    public function detail(){
        return $this->hasMany(detail_penjualan::class, 'id_penjualan', 'id');
    }
}
