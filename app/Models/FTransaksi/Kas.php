<?php

namespace App\Models\FTransaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


//ganti 1
class Kas extends Model
{
    use HasFactory;

// ganti 2
    protected $table = 'kas';
    protected $primaryKey = 'NO_ID';
    public $timestamps = true;

//ganti 3
    protected $fillable = 
    [
        "NO_BUKTI","TGL", "PER","BACNO", "BNAMA", "JUMLAH","TYPE", "FLAG", "KET",
		"USRNM_KSR", "TG_SMP_KSR", "USRINS", "TG_INS","created_by", "updated_by","FLAG2"
    ];
}
