<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_diagnosa extends Model
{
    use HasFactory;
    protected $table = 'm_diagnosa';
    protected $guarded = ['id'];

    public $timestamps = false;
}
