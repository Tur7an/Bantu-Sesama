<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory;

class PantauDonasi extends Model
{
    protected $table = 'pantau_donasi';

    protected $fillable = [
        'kampanye_id',
        'foto_penyaluran',
        'tgl_penyaluran',
        'deskripsi',
    ];

    public function kampanye()
    {
        return $this->belongsTo(Kampanye::class, 'kampanye_id');
    }
}
