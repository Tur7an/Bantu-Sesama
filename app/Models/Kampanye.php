<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kampanye extends Model
{
    use HasFactory;
    protected $table = 'kampanye';

    protected $fillable = [
        'nama', 'deskripsi', 'batas_nominal', 'batas_tanggal', 'status', 'dana_terkumpul'
    ];

    public function donasi(){
        return $this->hasMany(Donasi::class);
    }

    public function PantauDonasi()
    {
        return $this->hasMany(PantauDonasi::class, 'kampanye_id');
    }

    // Di dalam Model Kampanye
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeNonAktif($query)
    {
        return $query->where('status', 'nonaktif');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }
}
