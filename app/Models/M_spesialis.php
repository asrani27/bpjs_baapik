<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_spesialis extends Model
{
    use HasFactory;
    protected $table = 'm_spesialis';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function sub()
    {
        return $this->hasMany(M_sub_spesialis::class, 'spesialis_id');
    }
}
