<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';

    protected $fillable = [
        'petugas_id',
        'tanggapan',
    ];

    protected $with = ['files'];

    public function petugas()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->morphTo();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'owner');
    }
}
