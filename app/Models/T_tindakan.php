<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_tindakan extends Model
{
    use HasFactory;
    protected $table = 't_tindakan';
    protected $guarded = ['id'];

    public function tind()
    {
        return $this->belongsTo(M_tindakan::class, 'm_tindakan_id');
    }
}
