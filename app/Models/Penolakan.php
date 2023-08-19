<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penolakan extends Model
{
    use HasFactory;

    protected $table = 'penolakan';

    protected $fillable = [
        'pengaduan_id',
        'alasan'
    ];

    protected $with = ['files', 'tanggapan'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
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
