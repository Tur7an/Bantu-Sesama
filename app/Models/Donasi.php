<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donasi extends Model
{
    use HasFactory;
    protected $table = 'donasi';

    protected $fillable = [
        'nama_donatur', 'nominal'
    ];

    public function kampanye(){
        return $this->belongsTo(Kampanye::class);
    }
}
