<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_khusus extends Model
{
    use HasFactory;
    protected $table = 'm_khusus';
    protected $guarded = ['id'];

    public $timestamps = false;
}
