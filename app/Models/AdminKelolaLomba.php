<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AdminKelolaLomba extends Model
{
    use HasFactory;

    protected $table = 'm_lombas';

    protected $fillable = [
        'tingkatan_id',
        'semester_id',
        'lomba_nama',
        'lomba_penyelenggara',
        'lomba_kategori',
        'lomba_tanggal_mulai',
        'lomba_tanggal_selesai',
        'lomba_link_pendaftaran',
        'lomba_link_poster',
        'lomba_visible',
        'lomba_terverifikasi',
    ];

    protected $casts = [
        'lomba_visible' => 'boolean',
        'lomba_terverifikasi' => 'boolean',
        'lomba_tanggal_mulai' => 'date',
        'lomba_tanggal_selesai' => 'date',
    ];

    public function keahlians(): BelongsToMany
    {
        return $this->belongsToMany(Keahlian::class, 't_keahlian_lombas', 'lomba_id', 'keahlian_id')
            ->withTimestamps();
    }
    public function keahlian(): BelongsTo
    {
        return $this->belongsTo(Keahlian::class, 'keahlian_id');
    }

    public function tingkatan(): BelongsTo
    {
        return $this->belongsTo(Tingkatan::class, 'tingkatan_id');
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function getKeahlianNamesAttribute()
    {
        return $this->keahlians->pluck('keahlian_nama')->join(', ');
    }

    public function getKeahlianIdsAttribute()
    {
        return $this->keahlians->pluck('id')->toArray();
    }
}