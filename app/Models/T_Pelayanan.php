<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_pelayanan extends Model
{
    use HasFactory;
    protected $table = 't_pendaftaran';

    protected $guarded = ['id'];

    public function anamnesa()
    {
        return $this->hasOne(T_anamnesa::class, 't_pendaftaran_id');
    }

    public function diagnosa()
    {
        return $this->hasMany(T_diagnosa::class, 't_pendaftaran_id');
    }

    public function resep()
    {
        return $this->hasMany(T_resep::class, 't_pendaftaran_id');
    }

    public function tindakan()
    {
        return $this->hasMany(T_tindakan::class, 't_pendaftaran_id');
    }
}
