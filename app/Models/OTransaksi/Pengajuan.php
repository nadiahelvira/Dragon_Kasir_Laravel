<?php

namespace App\Models\OTransaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


//ganti 1
class Pengajuan extends Model
{
    use HasFactory;

// ganti 2
    protected $table = 'hrd_harga';
    protected $primaryKey = 'ROW_ID';
    public $timestamps = true;

//ganti 3
    protected $fillable = 
    [
        "NO_BUKTI","TGL", "PER","NOTES", "DR", "DEV","USRNM", "E_TGL", "E_PC",
		"ttd_ie", "ie_off", "nm_ttd_ie", "ttd_pr","pr_off", "nm_ttd_pr","tg_ttd_pr","ttd_fm","fm_off","nm_ttd_fm","tg_ttd_fm","ttd_hrd","hrd_off","nm_ttd_hrd","tg_ttd_hrd","ttd_ceo","ceo_off","nm_ttd_ceo","tg_ttd_ceo","print","gambar1","pdf1","ket","ket1","ket2","ket3","ket4","ket5","ket6","ket7","ket8","ket9","ket10","tahun","FLAG"
    ];
}
