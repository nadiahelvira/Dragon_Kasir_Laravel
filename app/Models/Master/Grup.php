<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// ganti 1
class Grup extends Model
{
    use HasFactory;

// ganti 2
    protected $table = 'grup';
    protected $primaryKey = 'NO_ID';
    public $timestamps = false;

// ganti 3
    protected $fillable = 
    [
        "NO_ID","KD_GRUP", "NA_GRUP"
    ];
}
