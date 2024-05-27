<?php

namespace App\Models\OTransaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Databkk extends Model
{
     use HasFactory;

    protected $table = 'pemasarankas';
    protected $primaryKey = 'NO_ID';
    public $timestamps = true;

    protected $fillable = 
    [
        "NO_BUKTI","TGL_SETOR", "PER",
		"TOTAL", "WILAYAH", "WILAYAH1", "BANK", "ALAMAT","KOTA",
		"TELPON1", "FLAG", "JTEMPO", "BIAYA", "KOTA_SETOR", "GAJI_OS", "NOREK",
		"USRNM", "TG_SMP" , "created_by", "created_at", 
		"updated_by", 		"updated_at", "TGL", "BIAYA", "NAMA",
		
		
    ];
}