<?php

namespace App\Models\FMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// ganti 1
class Sup extends Model
{
    use HasFactory;

// ganti 2
    protected $table = 'SUP';
    protected $primaryKey = 'NO_ID';
    public $timestamps = false;

// ganti 3
    protected $fillable = 
    [
        "KODES","NAMAS","NOREK","USRNM","TG_SMP", "created_by", "updated_by"
    ];
}
