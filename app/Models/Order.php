<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    protected $fillable = ['id','nama_pemesan', 'no_hp', 'banyak_orang','tgl_masuk','pkl_masuk','tgl_keluar','pkl_keluar','harga'];

    public function peminjaman(){
        return $this->hasMany("App\Models\Peminjaman", "kode_alat");
    }

    public function jenis_alat(){
        return $this->belongsTo("App\Models\jenis_alat", "kode_jenis_alat");
    }
}
