<?php

namespace App\Models\FTransaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


//ganti 1
class Memo extends Model
{
    use HasFactory;

// ganti 2
    protected $table = 'memo';
    protected $primaryKey = 'NO_ID';
    public $timestamps = false;

//ganti 3
    protected $fillable = 
    [
        "NO_BUKTI","TGL", "PER","JUMLAH","KET", "DEBET", "KREDIT", "JUMLAH", "FLAG",
		"USRNM", "TG_SMP","USRINS", "TG_INS","created_by", "updated_by","FLAG2"
    ];
}
