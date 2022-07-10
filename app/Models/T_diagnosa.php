<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_diagnosa extends Model
{
    use HasFactory;
    protected $table = 't_diagnosa';
    protected $guarded = ['id'];

    public function diag()
    {
        return $this->belongsTo(M_diagnosa::class, 'm_diagnosa_id');
    }
}
