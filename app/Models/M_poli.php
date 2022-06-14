<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_poli extends Model
{
    use HasFactory;
    protected $table = 'm_poli';
    protected $guarded = ['id'];

    public $timestamps = false;
}
