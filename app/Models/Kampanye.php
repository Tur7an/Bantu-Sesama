<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kampanye extends Model
{
    use HasFactory;
    protected $table = 'kampanye';

    protected $fillable = [
        'nama', 'deskripsi', 'batas_nominal', 'batas_tanggal', 'status'
    ];

    public function donasi(){
        return $this->hasMany(Donasi::class);
    }
}
