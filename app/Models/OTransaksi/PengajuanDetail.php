<?php

namespace App\Models\OTransaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanDetail extends Model
{
    use HasFactory;

    protected $table = 'hrd_hargad';
    protected $primaryKey = 'ROW_ID';
    public $timestamps = false;

    protected $fillable =
    [
        "REC", "NO_BUKTI", "ID", "DR", "DEV", "PER","TGLD", "ARTICLE", "MODE", "CUTTING", "cutting_t","EMBOS", "embos_t","PSP", "psp_t", "JUKI","juki_t", "JAHIT", "jahit_t", "PACKING","packing_t","INJECT","injek","CAT_SPRAY","cet_spray","PSP_CAT","psp_cet","PSP_FLOCK","psp_flok","FLOCKING","floking","ASSB_FLOCK","ass_flok","COMP","kompon","GILING","geleng","PSP_ASSB","psp_ass","STOCKFIT","stokfit","ASSEMBLING","ass","INJECTION","injektion","ASSB_PACKING","ass_paking","MICRO","mikro","BORDIR","gambar1","pdf1","USRNM","E_TGL","E_PC","tahun","rekharga","FLAG"
    ];
}
