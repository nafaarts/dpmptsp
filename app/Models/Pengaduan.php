<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id',
        'kategori',
        'nomor_referensi',
        'tanggal_kejadian',
        'laporan',
        'alamat',
        'patokan',
        'latitude',
        'longitude',
        'status',
    ];

    protected $with = ['files', 'tanggapan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'owner');
    }

    public function tanggapan()
    {
        return $this->morphOne(Tanggapan::class, 'owner');
    }
}
