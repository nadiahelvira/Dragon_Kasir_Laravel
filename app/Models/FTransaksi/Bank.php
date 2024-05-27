<?php

namespace App\Models\FTransaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

//ganti 1
class Bank extends Model
{
    use HasFactory;

// ganti 2
    protected $table = 'bank';
    protected $primaryKey = 'NO_ID';
    public $timestamps = true;

//ganti 3
    protected $fillable = 
    [
        "NO_BUKTI","TGL", "PER","BACNO", "BNAMA", "JUMLAH", "TYPE", "FLAG", "KET", "JTEMPO", "BG", 
		"USRNM_KSR", "TG_SMP_KSR", "USRINS", "TG_INS","created_by", "updated_by","FLAG2","KD","BNK"
    ];
}
