<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tingkatan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_tingkatans';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tingkatan_nama',
        'tingkatan_point',
        'tingkatan_visible'
    ];

    protected $casts = [
        'tingkatan_point' => 'integer',
        'tingkatan_visible' => 'boolean'
    ];

    public function lombas(): HasMany
    {
        return $this->hasMany(Lomba::class, 'tingkatan_id', 'id');
    }

    public function penghargaans(): HasMany
    {
        return $this->hasMany(Penghargaan::class, 'tingkatan_id', 'id');
    }
}