<?php

namespace App\Models\OTransaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Bg extends Model
{
     use HasFactory;

    protected $table = 'bg';
    protected $primaryKey = 'NO_ID';
    public $timestamps = true;

    protected $fillable = 
    [
        "NO_BUKTI","TGL_SETOR", "PER",
		"JENIS", "SERIES", "PERUSAHAAN",
		"NOREK", "PENERIMA","ALM_PENERIMA",
		"BANK_PENERIMA", "ALM_BANK", "JUMLAH",
		"BIAYA", "REVISI", "JTEMPO",
		"NM_PENGIRIM",
		"ALM_PENGIRIM", "TG_SMP" , 
		"created_by", "updated_by",
		"created_at", "updated_at",		"deleted_by",
		"TELP_PENGIRIM","NOREK_PENGIRIM",
		"PEMBAYARAN", "PAKAI", "TGL",
		
		
    ];
}