<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_sub_spesialis extends Model
{
    use HasFactory;
    protected $table = 'm_sub_spesialis';
    protected $guarded = ['id'];
    public $timestamps = false;
}
