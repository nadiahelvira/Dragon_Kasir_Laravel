<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


//ganti 1
class Brg extends Model
{
    use HasFactory;

// ganti 2
    protected $table = 'jl_brg';
    protected $primaryKey = 'NO_ID';
    public $timestamps = false;

//ganti 3
    protected $fillable = 
    [
        "KD_BRG", "NA_BRG", "JENIS", "SATUAN","GOL", "USRNM", "TG_SMP", 
		
    ];
}
