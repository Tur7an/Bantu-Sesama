<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Donasi extends Model
{
    use HasFactory;

    protected $table = 'donasi';

    protected $fillable = [
        'nama_donatur',
        'nominal_donasi',
        'waktu_donasi',
        'kampanye_id'
    ];

    /**
     * Relasi dengan tabel Kampanye
     */
    public function kampanye()
    {
        return $this->belongsTo(Kampanye::class, 'kampanye_id');
    }

    /**
     * Menggunakan event model untuk mengelola dana_terkumpul
     */
    public static function boot()
    {
        parent::boot();

        // Event saat donasi dibuat
        static::created(function ($donasi) {
            DB::table('kampanye')
                ->where('id', $donasi->kampanye_id)
                ->increment('dana_terkumpul', $donasi->nominal);
        });

        // Event saat donasi dihapus
        static::deleted(function ($donasi) {
            DB::table('kampanye')
                ->where('id', $donasi->kampanye_id)
                ->decrement('dana_terkumpul', $donasi->nominal);
        });
    }
}
