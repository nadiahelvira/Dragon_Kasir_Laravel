<?php

namespace App\Models\FMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// ganti 1
class Wila extends Model
{
    use HasFactory;

// ganti 2
    protected $table = 'wila';
    protected $primaryKey = 'NO_ID';
    public $timestamps = true;

// ganti 3
    protected $fillable = 
    [
        "KODE", "NAMA", "NO_REK", "BANK", "ALAMAT", "KOTA","TELPON", "JENIS",
		"created_by", "updated_by",
		"created_at", "updated_at",	
		
    ];
}
